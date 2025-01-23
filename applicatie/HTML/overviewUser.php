<?php
include '/applicatie/PHP/createHTMLHead.php';
include '/applicatie/PHP/createHTMLHeader.php';
include '/applicatie/PHP/createHTMLFooter.php';

require_once '/applicatie/PHP/handleOrderUser.php';
require_once '/applicatie/PHP/calculatePrices.php';
require_once '/applicatie/PHP/db_connectie.php';

if (!isset($_SESSION['user'])) {
  $_SESSION['error'] = 'Je moet ingelogd zijn om deze pagina te bekijken.';
  header('Location: /HTML/loginPage.php');
  exit;
}

$username = $_SESSION['user'];

try {
    $db = maakVerbinding();

    $sql = 'SELECT username, email FROM [User ] WHERE username = :username';
    $query = $db->prepare($sql);
    $query->execute([':username' => $username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        session_destroy();
        header('Location: /HTML/loginPage.php');
        exit;
    }

    $displayName = $user['username'];
    $email = $user['email'];

    $sqlOrders = 'SELECT o.order_id, o.datetime, o.status FROM [Pizza_Order] o WHERE o.client_username = :username';
    $queryOrders = $db->prepare($sqlOrders);
    $queryOrders->execute([':username' => $username]);
    $orders = $queryOrders->fetchAll(PDO::FETCH_ASSOC);

    $orderItems = [];
    foreach ($orders as $order) {
        $sqlItems = 'SELECT product_name, quantity FROM Pizza_Order_Product WHERE order_id = :order_id';
        $queryItems = $db->prepare($sqlItems);
        $queryItems->execute([':order_id' => $order['order_id']]);
        $orderItems[$order['order_id']] = $queryItems->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die('Error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
getHeadSection();
getHeader();
?>
<main class="account-page">
    <?php 
    echo renderUserInfo($displayName, $email); 
    echo renderOrderStatus($orders, $db); 
    ?>
</main>
<?php getFooter(); ?>
</body>
</html>

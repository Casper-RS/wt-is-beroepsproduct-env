<?php
include '/applicatie/PHP/createHTMLHead.php';
include '/applicatie/PHP/createHTMLHeader.php';
require_once '/applicatie/PHP/handleOrderPersonnel.php';
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
    // Query voor het ophalen van alle gebruikers.
    $sql = 'SELECT username, email FROM [User ] WHERE username = :username';
    $query = $db->prepare($sql);
    $query->execute([':username' => $username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Laat een gebruiker inloggen mocht er geen sessie zijn.
    if (!isset($_SESSION['user'])) {
      $_SESSION['error'] = 'Je moet ingelogd zijn om deze pagina te bekijken.';
      header('Location: /HTML/loginPage.php');
      exit;
  }

    $displayName = $user['username'];
    $email = $user['email'];

    // Query voor alle orders "Niet verwerkt" of "In behandeling"
    $sqlOrders = 'SELECT o.order_id, o.datetime, o.status, o.address FROM [Pizza_Order] o WHERE o.status = 1 OR o.status = 2';
    $queryOrders = $db->prepare($sqlOrders);
    $queryOrders->execute();
    $orders = $queryOrders->fetchAll(PDO::FETCH_ASSOC);

    // Laat alle items zien voor een specifieke order
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

<html lang="en">
<?php
getHeadSection();
getHeader();
?>
<main class="staff-page">
    <section class="user-info">
        <h2>Welkom terug, <?php echo htmlspecialchars($displayName); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
    </section>
    <?php echo renderOrderSection($orders, $db); // Render the order section ?>
</main>
<?php getFooter(); ?>
</body>
</html>

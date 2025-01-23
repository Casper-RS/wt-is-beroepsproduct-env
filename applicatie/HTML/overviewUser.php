<?php
include '/applicatie/PHP/createHead.php';
include '/applicatie/PHP/createHeader.php';
include '/applicatie/PHP/handleOrderCard.php';
include '/applicatie/PHP/calculatePrices.php';
require_once '/applicatie/PHP/db_connectie.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header('Location: /HTML/inlogUser .php');
    exit;
}

$username = $_SESSION['user'];

try {
    $db = maakVerbinding();

    // Query user details from the database
    $sql = 'SELECT username, email FROM [User ] WHERE username = :username';
    $query = $db->prepare($sql);
    $query->execute([':username' => $username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // If user details are not found, log them out
        session_destroy();
        header('Location: /HTML/loginPage.php');
        exit;
    }

    // Extract user details
    $displayName = $user['username'];
    $email = $user['email'];

    // Fetch orders for the logged-in user
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
    <section class="user-info">
        <h2>Welkom terug, <?php echo htmlspecialchars($displayName); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Laatst ingelogd: 20 november 2024</p>
    </section>
    <section class="order-status">
        <h2>Mijn Bestelling(en)</h2>
        <?php if (empty($orders)): ?>
            <p>Je hebt momenteel geen bestellingen.</p>
        <?php else: ?>
            <div class="order-cards">
                <?php foreach ($orders as $order): ?>
                    <?php 
                    $items = fetchOrderItems($db, $order['order_id']); // Fetch items for each order
                    echo createOrderCard($order, $items); // Create and display the order card
                    ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<footer class="pizzaFooter">
    <p>&copy; 2024 Sole Machina ~ Alle rechten voorbehouden.</p>
    <p><a href="/HTML/privacybeleid.html">Privacy & Voorwaarden</a></p>
</footer>
</body>
</html>

<?php
require_once '/applicatie/PHP/getStatusInfo.php';

//Query om alle orders te tonen
function fetchUserOrders($db, $username) {
    $sql = 'SELECT order_id, datetime, status FROM [Pizza_Order] WHERE client_username = :username';
    $query = $db->prepare($sql);
    $query->execute([':username' => $username]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

//Query om alle items per order te tonen
function fetchOrderItems($db, $orderId) { 
    $sql = 'SELECT product_name, quantity FROM Pizza_Order_Product WHERE order_id = :order_id';
    $query = $db->prepare($sql);
    $query->execute([':order_id' => $orderId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

//Maak een card per order, met de opgevraagde queries.
function createOrderCard($order, $items) {
    $cardHtml = '<div class="order-card">';
    $cardHtml .= '<h3>Bestelling #' . htmlspecialchars($order['order_id']) . '</h3>';
    $cardHtml .= '<p><strong>Besteld op:</strong> ' . htmlspecialchars($order['datetime']) . '</p>';
    $cardHtml .= '<p><strong>Status:</strong> <span class="status ' . htmlspecialchars(getOrderStatusClass($order['status'])) . '">' . htmlspecialchars(getOrderStatusText($order['status'])) . '</span></p>';
    $cardHtml .= '<ul class="order-items">';
    if (!empty($items)) {
        foreach ($items as $item) {
            $itemPrice = calculateItemPrice($item['product_name'], $item['quantity']);
            $cardHtml .= '<li>' . htmlspecialchars($item['product_name']) . ' - Aantal: ' . htmlspecialchars($item['quantity']) . ' - €' . htmlspecialchars($itemPrice) . '</li>';
        }
    } else {
        $cardHtml .= '<li>Geen artikelen gevonden voor deze bestelling.</li>';
    }
    $cardHtml .= '</ul>';

    $totalPrice = calculateTotal($order['order_id']);
    $cardHtml .= '<p><strong>Totaalprijs:</strong> €' . htmlspecialchars($totalPrice) . '</p>';
    $cardHtml .= '</div>';

    return $cardHtml;
}

// Geef gebruikers informatie weer.
function renderUserInfo($displayName, $email) {
    ob_start();
    ?>
    <section class="user-info">
        <h2>Welkom terug, <?php echo htmlspecialchars($displayName); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Laatst ingelogd: 20 november 2024</p>
    </section>
    <?php
    return ob_get_clean();
}

// Zelfde principe als voor personeel, alleen nu de status voor de gebruiker.
function renderOrderStatus($orders, $db) {
    ob_start();
    ?>
    <section class="order-status">
        <h2>Mijn Bestelling(en)</h2>
        <?php if (empty($orders)): ?>
            <p>Je hebt momenteel geen bestellingen.</p>
        <?php else: ?>
            <div class="order-cards">
                <?php foreach ($orders as $order): ?>
                    <?php 
                    $items = fetchOrderItems($db, $order['order_id']);
                    echo createOrderCard($order, $items);
                    ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}

?>
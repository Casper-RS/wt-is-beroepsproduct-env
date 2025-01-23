<?php
include '/applicatie/PHP/getStatusInfo.php';
require_once '/applicatie/PHP/db_connectie.php';

function fetchStaffOrders($db, $username) {
    $sql = 'SELECT order_id, datetime, status FROM [Pizza_Order] WHERE client_username = :username';
    $query = $db->prepare($sql);
    $query->execute([':username' => $username]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


// Query om de items per order te tonen.
function fetchStaffOrderItems($db, $orderId) {
    $sql = 'SELECT product_name, quantity FROM Pizza_Order_Product WHERE order_id = :order_id';
    $query = $db->prepare($sql);
    $query->execute([':order_id' => $orderId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Functie om personeel de juiste informatie te tonen.
function createOrderCardPersonnel($order, $items) {
    $cardHtml = '<div class="order-card">';
    $cardHtml .= '<h3>Bestelling #' . htmlspecialchars($order['order_id']) . '</h3>';
    $cardHtml .= '<p><strong>Besteld op:</strong> ' . htmlspecialchars($order['datetime']) . '</p>';
    $cardHtml .= '<p><strong>Status:</strong> <span class="status ' . htmlspecialchars(getOrderStatusClass($order['status'])) . '">' . htmlspecialchars(getOrderStatusText($order['status'])) . '</span></p>';
    $cardHtml .= '<p><strong>Bezorg adres:</strong> ' . htmlspecialchars($order['address']) . '</p>';

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
    $cardHtml .= '<div class="order-actions">';
    
    // Update de bestaande order via een form. (Dropdown form)
    $cardHtml .= '<form method="post" action="/PHP/orderUpdate.php" style="display:inline;">';
    $cardHtml .= '<input type="hidden" name="order_id" value="' . htmlspecialchars($order['order_id']) . '">';
    $cardHtml .= '<select name="status" onchange="this.form.submit()">';
    $cardHtml .= '<option value="1" ' . ($order['status'] == 1 ? 'selected' : '') . '>Niet verwerkt</option>';
    $cardHtml .= '<option value="2" ' . ($order['status'] == 2 ? 'selected' : '') . '>In behandeling</option>';
    $cardHtml .= '<option value="3" ' . ($order['status'] == 3 ? 'selected' : '') . '>Afgeleverd</option>';
    $cardHtml .= '</select>';
    $cardHtml .= '</form>';

    // Verwijder de bestaande order via een form. (Button form)
    $cardHtml .= '<form method="post" action="/PHP/orderDelete.php" style="display:inline;">';
    $cardHtml .= '<input type="hidden" name="order_id" value="' . htmlspecialchars($order['order_id']) . '">';
    $cardHtml .= '<button type="submit" class="btn delete-order">Bestelling verwijderen</button>';
    $cardHtml .= '</form>';
    $cardHtml .= '</div>';
    $cardHtml .= '</div>';

    return $cardHtml; // Return the complete card HTML
}

// Haal alle orders momenteel op uit de database.
function renderOrderSection($orders, $db) {
    ob_start();
    ?>
    <section class="order-status">
        <h2>Actieve Bestellingen:</h2>
        <?php if (empty($orders)): ?>
            <p>Er zijn momenteel geen bestellingen die niet verwerkt zijn.</p>
        <?php else: ?>
            <div class="order-cards">
                <?php foreach ($orders as $order): ?>
                    <?php 
                    $items = fetchStaffOrderItems($db, $order['order_id']); // Fetch items per order.
                    echo createOrderCardPersonnel($order, $items); // Zet elke order in een card.
                    ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}
?>
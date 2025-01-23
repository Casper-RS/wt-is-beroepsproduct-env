<?php
include '/applicatie/PHP/getStatusInfo.php';
require '/applicatie/PHP/handleOrderCard.php';

// Function to create an order card
// Function to create an order card
function createOrderCardPersonnel($order, $items) {
    global $db; // Ensure the database connection is accessible

    $cardHtml = '<div class="order-card">';
    $cardHtml .= '<h3>Bestelling #' . htmlspecialchars($order['order_id']) . '</h3>';
    $cardHtml .= '<p><strong>Besteld op:</strong> ' . htmlspecialchars($order['datetime']) . '</p>';
    $cardHtml .= '<p><strong>Status:</strong> <span class="status ' . htmlspecialchars(getOrderStatusClass($order['status'])) . '">' . htmlspecialchars(getOrderStatusText($order['status'])) . '</span></p>';
    
    $cardHtml .= '<ul class="order-items">';
    if (!empty($items)) {
        foreach ($items as $item) {
            $itemPrice = calculateItemPrice($item['product_name'], $item['quantity']); // Calculate item price
            $cardHtml .= '<li>' . htmlspecialchars($item['product_name']) . ' - Aantal: ' . htmlspecialchars($item['quantity']) . ' - €' . htmlspecialchars($itemPrice) . '</li>';
        }
    } else {
        $cardHtml .= '<li>Geen artikelen gevonden voor deze bestelling.</li>';
    }
    $cardHtml .= '</ul>';

    // Calculate total price for the order
    $totalPrice = calculateTotal($order['order_id']);
    $cardHtml .= '<p><strong>Totaalprijs:</strong> €' . htmlspecialchars($totalPrice) . '</p>'; // Display total price
    $cardHtml .= '</div>'; // Close the card

    return $cardHtml; // Return the complete card HTML
}
?>
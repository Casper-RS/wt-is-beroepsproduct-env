<?php
function renderBasket($basket, &$total)
{
    if (empty($basket)) {
        return '<p>Je winkelmandje is leeg.</p>';
    }

    $html = '';
    foreach ($basket as $productName => $details) {
        $price = floatval($details['price']);
        $quantity = intval($details['quantity']);
        $lineTotal = $price * $quantity;
        $total += $lineTotal;

        $html .= '<div class="cart-item">';
        $html .= '<img src="' . htmlspecialchars($details['image']) . '" alt="' . htmlspecialchars($productName) . '" class="cart-item-img" />';
        $html .= '<div class="cart-item-details">';
        $html .= '<h3>' . htmlspecialchars($productName) . '</h3>';
        $html .= '<p>Prijs: €' . number_format($price, 2) . '</p>';
        $html .= '<form method="post" action="/PHP/basketUpdate.php">';
        $html .= '<label for="quantity_' . htmlspecialchars($productName) . '">Aantal:</label>';
        $html .= '<div class="quantity-control">';
        $html .= '<input type="hidden" name="product_name" value="' . htmlspecialchars($productName) . '" />';
        $html .= '<input type="number" id="quantity_' . htmlspecialchars($productName) . '_quantity" name="quantity" min="1" max="10" value="' . htmlspecialchars($quantity) . '" class="quantity-input" />';
        $html .= '<button type="submit" name="update_quantity" class="update-btn">Bijwerken</button>';
        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';
        $html .= '<form method="post" action="/PHP/basketRemove.php">';
        $html .= '<input type="hidden" name="product_name" value="' . htmlspecialchars($productName) . '" />';
        $html .= '<button type="submit" class="remove-btn">';
        $html .= '<img src="/Images/recycle-bin.png" alt="trashcan" />';
        $html .= '<i class="removeItem"></i>';
        $html .= '</button>';
        $html .= '</form>';
        $html .= '</div>';
    }

    $html .= '<div class="cart-total">';
    $html .= '<h3>Totaal: €' . number_format($total, 2) . '</h3>';
    $html .= '<button class="checkout-btn" onclick="location.href=\'bestellingAfronden.html\'">Afrekenen</button>';
    $html .= '</div>';

    return $html;
}

<?php
function calculateTotal($orderId){
global $db;
$total = 0;

// Fetch order items for the given order ID
$sqlItems = 'SELECT product_name, quantity FROM Pizza_Order_Product WHERE order_id = :order_id';
$queryItems = $db->prepare($sqlItems);
$queryItems->execute([':order_id' => $orderId]);
$items = $queryItems->fetchAll(PDO::FETCH_ASSOC);

// Calculate total price based on item prices and quantities
foreach ($items as $item) {
    $productName = $item['product_name'];
    $quantity = $item['quantity'];

    // Fetch the price of the product
    $sqlPrice = 'SELECT price FROM [Product] WHERE name = :product_name'; // Assuming a Products table exists
    $queryPrice = $db->prepare($sqlPrice);
    $queryPrice->execute([':product_name' => $productName]);
    $price = $queryPrice->fetchColumn();

    if ($price !== false) {
        $total += $price * $quantity; // Accumulate total
    }
}

return number_format($total, 2); // Return total formatted to 2 decimal places
}

function calculateItemPrice($productName, $quantity) {
    global $db; // Use the global database connection

    // Fetch the price of the product
    $sqlPrice = 'SELECT price FROM [Product] WHERE name = :product_name'; // Assuming a Products table exists
    $queryPrice = $db->prepare($sqlPrice);
    $queryPrice->execute([':product_name' => $productName]);
    $price = $queryPrice->fetchColumn();

    if ($price !== false) {
        return number_format($price * $quantity, 2); // Return total price for the item formatted to 2 decimal places
    }

    return 0; // Return 0 if the product price is not found
}

?>
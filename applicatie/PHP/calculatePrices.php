<?php
require_once '/applicatie/PHP/db_connectie.php';

function calculateTotal($orderId){
$db = maakVerbinding();

$total = 0;

// Query om de items per order te verkrijgen.
$sqlItems = 'SELECT product_name, quantity FROM Pizza_Order_Product WHERE order_id = :order_id';
$queryItems = $db->prepare($sqlItems);
$queryItems->execute([':order_id' => $orderId]);
$items = $queryItems->fetchAll(PDO::FETCH_ASSOC);

// Totaal prijs berekening.
foreach ($items as $item) {
    $productName = $item['product_name'];
    $quantity = $item['quantity'];

    // Fetch per product de prijs uit de database.
    $sqlPrice = 'SELECT price FROM [Product] WHERE name = :product_name';
    $queryPrice = $db->prepare($sqlPrice);
    $queryPrice->execute([':product_name' => $productName]);
    $price = $queryPrice->fetchColumn();

    if ($price !== false) {
        $total += $price * $quantity; // Totaal bedrag.
    }
}
return number_format($total, 2); // Return een getal met 2 achter de komma.
}



function calculateItemPrice($productName, $quantity) {
    global $db;

    // Fetch per product de prijs uit de database.
    $sqlPrice = 'SELECT price FROM [Product] WHERE name = :product_name';
    $queryPrice = $db->prepare($sqlPrice);
    $queryPrice->execute([':product_name' => $productName]);
    $price = $queryPrice->fetchColumn();

    if ($price !== false) {
        return number_format($price * $quantity, 2);
    }
    return 0; // Return 0 als de prijs niet bestaat.
}

?>
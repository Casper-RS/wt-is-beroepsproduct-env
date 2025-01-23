<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'], $_POST['price'], $_POST['image'])) {
    $productName = $_POST['product_name'];
    $price = str_replace(['€', ','], ['', '.'], $_POST['price']); // Voeg een euroteken toe.
    $price = floatval($price); // Moet naar float want kommagetal.
    $image = $_POST['image'];

    // Check of de sessie voor het product toevoegen bestaat.
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    }
    
    if (isset($_SESSION['basket'][$productName])) {
        $_SESSION['basket'][$productName]['quantity'] += 1;
    } else {
        $_SESSION['basket'][$productName] = [
            'price' => $price,
            'quantity' => 1,
            'image' => $image
        ];
    }
}

header('Location: /HTML/basketPage.php');
exit;
?>


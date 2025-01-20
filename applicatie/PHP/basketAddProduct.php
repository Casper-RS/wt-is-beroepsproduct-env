<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'], $_POST['price'], $_POST['image'])) {
    $productName = $_POST['product_name'];
    $price = str_replace(['€', ','], ['', '.'], $_POST['price']); // Remove currency and convert comma to dot
    $price = floatval($price); // Convert to float
    $image = $_POST['image']; // Get the image URL from the form

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


<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'], $_POST['quantity'])) {
    $productName = $_POST['product_name'];
    $quantity = (int) $_POST['quantity'];

    // Ensure the basket exists and the product is valid
    if (isset($_SESSION['basket'][$productName]) && $quantity > 0) {
        $_SESSION['basket'][$productName]['quantity'] = $quantity;
    }
}

// Redirect back to the basket page
header('Location: /HTML/basketPage.php');
exit;
?>

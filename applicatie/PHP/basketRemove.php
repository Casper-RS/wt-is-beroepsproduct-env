<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'])) {
    $productName = $_POST['product_name'];

    // Remove the product from the basket
    if (isset($_SESSION['basket'][$productName])) {
        unset($_SESSION['basket'][$productName]);
    }
}

// Redirect back to the basket page
header('Location: /HTML/basketPage.php');
exit;
?>

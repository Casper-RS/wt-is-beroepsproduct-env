<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'])) {
    $productName = $_POST['product_name'];

    // Haal een product uit het winkelmandje.
    if (isset($_SESSION['basket'][$productName])) {
        unset($_SESSION['basket'][$productName]);
    }
}

// Ga terug naar de winkelmand. Dit heeft de gebruiker niet door (page refresh)
header('Location: /HTML/basketPage.php');
exit;
?>

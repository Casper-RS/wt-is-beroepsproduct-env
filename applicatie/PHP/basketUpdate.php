<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'], $_POST['quantity'])) {
    $productName = $_POST['product_name'];
    $quantity = (int) $_POST['quantity'];

    // Check of het winkelmandje sessie er is, en of het product bestaat in de database.
    if (isset($_SESSION['basket'][$productName]) && $quantity > 0) {
        $_SESSION['basket'][$productName]['quantity'] = $quantity;
    }
}

header('Location: /HTML/basketPage.php');
exit;
?>

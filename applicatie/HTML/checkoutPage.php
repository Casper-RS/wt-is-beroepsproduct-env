<?php
include '/applicatie/PHP/createHTMLFooter.php';
include '/applicatie/PHP/createHTMLHeader.php';
include '/applicatie/PHP/createHTMLHead.php';

require_once '/applicatie/PHP/checkoutProcess.php';
require_once '/applicatie/PHP/checkoutForm.php';
require_once '/applicatie/PHP/db_connectie.php';

if (!isset($_SESSION['user'])) {
  $_SESSION['error'] = 'Je moet ingelogd zijn om deze pagina te bekijken.';
  header('Location: /HTML/loginPage.php');
}
$username = $_SESSION['user'];
$basket = $_SESSION['basket'] ?? [];
$errors = [];

try {
    $db = maakVerbinding();
    $user = getUserData($db, $username);
    if (!$user) {
        $errors[] = "Gebruikersgegevens niet gevonden.";
    }
} catch (PDOException $e) {
    $errors[] = "Fout bij het ophalen van gebruikersgegevens: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $postalCode = trim($_POST['postal_code'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $status = 1; // Default status "Niet verwerkt"
    $datetime = date('Y-m-d H:i:s');
    $personnel = 'pietdikhoofd';

    $errors = array_merge($errors, validateOrderInputs($name, $address, $postalCode, $email, $phone, $basket));

    if (empty($errors)) {
        try {
            $orderId = insertOrder($db, $username, $name, $personnel, $datetime, $status, $address . ', ' . $postalCode);
            insertOrderItems($db, $orderId, $basket);
            $_SESSION['basket'] = [];
            header('Location: /HTML/confirmationPage.php');
            exit;
        } catch (PDOException $e) {
            $errors[] = "Fout bij het plaatsen van je bestelling: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
 getHeadSection();
 getHeader();
?>
<div class="delivery-page">
    <h1>Afrekenen</h1>
    <?php 
    echo renderErrors($errors); 
    echo renderDeliveryForm($user); 
    ?>
</div>
<?php getFooter(); ?>
</body>
</html>
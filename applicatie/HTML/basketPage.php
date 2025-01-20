<?php
include '/applicatie/PHP/head.php';
include '/applicatie/PHP/header.php';
include '/applicatie/PHP/footer.php';
include '/applicatie/PHP/basketConvertionHTML.php';

session_start();
$total = 0; // Initialize total
?>

<!DOCTYPE html>
<html lang="en">
<?php
getHeadSection();
getHeader();
?>
<main class="cart-page">
    <h2>Je Winkelmand</h2>
    <?php echo renderBasket($_SESSION['basket'] ?? [], $total);?>
</main>
<?php getFooter(); ?>
</body>
</html>

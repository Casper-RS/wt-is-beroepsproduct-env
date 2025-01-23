<?php
include '/applicatie/PHP/createHTMLHead.php';
include '/applicatie/PHP/createHTMLHeader.php';
include '/applicatie/PHP/createHTMLFooter.php';

require_once '/applicatie/PHP/basketConvertionHTML.php';

$total = 0; // Initialiseer totaalbedrag.
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
<?php getPizzaFooter(); ?>
</body>
</html>

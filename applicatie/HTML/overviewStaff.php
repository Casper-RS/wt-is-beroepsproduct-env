<?php
include '/applicatie/PHP/createHead.php';
include '/applicatie/PHP/createHeader.php';
include '/applicatie/PHP/handlePizzaCard.php';
include '/applicatie/PHP/createFooter.php';
include ''
?>

<!DOCTYPE html>
<?php
getHeadSection();
getHeader();
?>
<main class="staff-page">
  <section class="order-status">
    <h2>Actieve Bestellingen - Niet Verwerkt</h2>
    <?php if (empty($orders)): ?>
        <p>Er zijn momenteel geen bestellingen die niet verwerkt zijn.</p>
    <?php else: ?>
        <div class="order-cards">
            <?php foreach ($orders as $order): ?>
                <?php 
                $items = fetchOrderItems($db, $order['order_id']); // Fetch items for each order
                echo createOrderCardPersonnel($order, $items); // Create and display the order card
                ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
  </section>
</main>
<footer class="pizzaFooter">
  <p>&copy; 2024 Sole Machina ~ Alle rechten voorbehouden.</p>
  <p><a href="/HTML/privacybeleid.html">Privacy & Voorwaarden</a></p>
</footer>
</body>

</html>
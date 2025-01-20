<?php
function renderBasket($basket, &$total)
{
    if (empty($basket)) {
        echo '<p>Je winkelmandje is leeg.</p>';
        return;
    }

    foreach ($basket as $productName => $details) {
        $price = floatval($details['price']);
        $quantity = intval($details['quantity']);
        $lineTotal = $price * $quantity;
        $total += $lineTotal;
?>

        <div class="cart-item">
            <img src="<?php echo htmlspecialchars($details['image']); ?>" alt="<?php echo htmlspecialchars($productName); ?>" class="cart-item-img" />
            <div class="cart-item-details">
                <h3><?php echo htmlspecialchars($productName); ?></h3>
                <p>Prijs: €<?php echo number_format($price, 2); ?></p>
                <form method="post" action="/PHP/basketUpdate.php">
                    <label for="quantity_<?php echo htmlspecialchars($productName); ?>">Aantal:</label>
                    <div class="quantity-control">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($productName); ?>" />
                        <input type="number" id="quantity_<?php echo htmlspecialchars($productName); ?>_quantity" name="quantity" min="1" max="10" value="<?php echo htmlspecialchars($quantity); ?>" class="quantity-input" />
                        <button type="submit" name="update_quantity" class="update-btn">Bijwerken</button>
                    </div>
                </form>
            </div>
            <form method="post" action="/PHP/basketRemove.php">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($productName); ?>" />
                <button type="submit" class="remove-btn">
                    <img src="/Images/recycle-bin.png" alt="trashcan" />
                    <i class="removeItem"></i>
                </button>
            </form>
        </div>

    <?php
    }

    ?>

    <div class="cart-total">
        <h3>Totaal: €<?php echo number_format($total, 2); ?></h3>
        <form method="post" action="/HTML/checkoutPage.php">
            <button type="submit" class="checkout-btn">Afrekenen</button>
        </form>
    </div>


<?php
}

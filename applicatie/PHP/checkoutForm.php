<?php
function renderErrors($errors) {
    ob_start(); // Start output buffering
    if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif;
    return ob_get_clean(); // Return the buffered content
}

function renderDeliveryForm($user) {
    ob_start(); // Start output buffering
    ?>
    <form class="delivery-form" method="post" action="">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
        <label for="address">Adres:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>" required>
        <label for="postal_code">Postcode:</label>
        <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($_POST['postal_code'] ?? ''); ?>" required>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? $user['email'] ?? ''); ?>" required>
        <label for="phone">Telefoonnummer:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
        <button type="submit" class="payment-btn">Bestel & betaal</button>
    </form>
    <?php
    return ob_get_clean(); // Return the buffered content
}
?>
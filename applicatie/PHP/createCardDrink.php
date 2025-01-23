<?php
function fetchAvailableDrinks($db) {
    $sql = 'SELECT name, price, type_id, image_path FROM [Product] WHERE type_id = :type';
    $query = $db->prepare($sql);
    $query->execute([':type' => 'Drank']); // Fetch products with type "Drank"
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function createDrinkCard($imageSrc, $altText, $titleText, $price) {
    echo '
    <div class="pizzaListItem">
        <form method="post" action="/PHP/basketAddProduct.php">
            <img class="pizzaPic" src="' . htmlspecialchars($imageSrc) . '" alt="' . htmlspecialchars($altText) . '"/>
            <h3>' . htmlspecialchars($titleText) . '</h3>
            <p>€' . htmlspecialchars($price) . '</p>
            <input type="hidden" name="product_name" value="' . htmlspecialchars($titleText) . '">
            <input type="hidden" name="price" value="' . htmlspecialchars($price) . '">
            <input type="hidden" name="image" value="' . htmlspecialchars($imageSrc) . '">
            <button type="submit">Klik om te bestellen</button>
        </form>
    </div>';
}

function showDrinkCards() {
    global $db;
    $drinks = fetchAvailableDrinks($db); // Fetch drinks from the database
    foreach ($drinks as $drink) {
        createDrinkCard(
            $drink['image_path'] ?? '/Images/unknown.png', // Use image_path or default
            $drink['name'],                                // Alt text
            $drink['name'],                                // Title text
            number_format((float)$drink['price'], 2)       // Price
        );
    }
}


?>
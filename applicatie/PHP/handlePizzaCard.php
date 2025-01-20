<?php
include '/applicatie/PHP/button.php';
include '/applicatie/PHP/db_connectie.php';

function fetchAvailablePizzas($db) {
    $sql = 'SELECT name, price, type_id, image_path FROM [Product] WHERE type_id = :type';
    $query = $db->prepare($sql);
    $query->execute([':type' => 'Pizza']); // Bind the "Pizza" value to the :type placeholder
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function fetchIngredients($db, $productName) {
    $sql = 'SELECT ingredient_name FROM [Product_Ingredient] WHERE product_name = :product_name';
    $query = $db->prepare($sql);
    $query->execute([':product_name' => $productName]);
    return $query->fetchAll(PDO::FETCH_COLUMN); // Fetch only the ingredient_name column
}

$db = maakVerbinding();
$pizzas = fetchAvailablePizzas($db);

function showPizzaCards() {
    global $pizzas, $db;
    foreach ($pizzas as $pizza) {
        $ingredients = fetchIngredients($db, $pizza['name']); // Fetch ingredients for the pizza
        createPizzaCard(
            $pizza['image_path'] ?? '/Images/unknown.png', // Use image_path or default
            $pizza['name'],                                // Alt text
            $pizza['name'],                                // Title text
            $ingredients,                                  // Ingredients as description
            number_format((float)$pizza['price'], 2)
        );
    }
}
function createPizzaCard($imageSrc, $altText, $titleText, $ingredients, $price) {
    // Ensure $ingredients is an array
    if (!is_array($ingredients)) {
        $ingredients = [$ingredients]; // Wrap the string in an array
    }

    // Generate ingredients list
    $ingredientsHtml = '';
    if (!empty($ingredients)) {
        $ingredientsHtml = implode(', ', array_map('htmlspecialchars', $ingredients));
    } else {
        $ingredientsHtml = 'Geen ingrediënten beschikbaar';
    }

    echo '
    <div class="pizzaListItem">
        <form method="post" action="/PHP/basketAddProduct.php">
            <img class="pizzaPic" src="' . htmlspecialchars($imageSrc) . '" alt="' . htmlspecialchars($altText) . '"/>
            <h3>' . htmlspecialchars($titleText) . '</h3>
            <p>' . $ingredientsHtml . '</p>
            <p>€' . htmlspecialchars($price) . '</p>
            <input type="hidden" name="product_name" value="' . htmlspecialchars($titleText) . '">
            <input type="hidden" name="price" value="' . htmlspecialchars($price) . '">
            <input type="hidden" name="image" value="' . htmlspecialchars($imageSrc) . '">
            <button type="submit">Klik om te bestellen</button>
        </form>
    </div>';
}

//Card for the homepage, without a price
function createNoButtonCard($imageSrc, $altText, $titleText, $description, $price){
    echo '
    <div class="pizzaListItem">
        <img class="pizzaPic" src="'. htmlspecialchars($imageSrc) .'" alt="' . htmlspecialchars($altText) . '"/>
            <h3>' . htmlspecialchars($titleText) . '</h3>
            <p>' . htmlspecialchars($description) . '</p>
            <p>' . htmlspecialchars($price) . '</p>
    </div>'
    ;}
?>
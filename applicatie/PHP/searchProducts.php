<?php
require_once '/applicatie/PHP/db_connectie.php';

$db = maakVerbinding();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
    $query = htmlspecialchars($_POST['query'], ENT_QUOTES, 'UTF-8'); // Sanitize user input

    try {
        // Search for products matching the query
        $searchQuery = $db->prepare('SELECT name, price, image_path FROM Product WHERE name LIKE :query');
        $searchQuery->execute(['query' => '%' . $query . '%']);
        $results = $searchQuery->fetchAll(PDO::FETCH_ASSOC);

        echo '<h1>Zoekresultaten</h1>';
        if ($results) {
            echo '<ul>';
            foreach ($results as $product) {
                echo '<img src="' . htmlspecialchars($product['image_path']) . '" alt="' . htmlspecialchars($product['name']) . '" style="width:50px; height:50px;">';
                echo '<strong>' . htmlspecialchars($product['name']) . '</strong> - €' . number_format($product['price'], 2);
            }
            echo '</ul>';
        } else {
            echo '<p>Geen producten gevonden voor "' . htmlspecialchars($query) . '".</p>';
        }
    } catch (PDOException $e) {
        echo 'Databasefout: ' . $e->getMessage();
    }
} else {
    echo '<p>Ongeldige zoekopdracht. Gebruik het zoekformulier om producten te vinden.</p>';
}
?>


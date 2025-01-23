<?php
require_once '/applicatie/PHP/db_connectie.php'; // Include your database connection

$db = maakVerbinding();

// Delete een bestaande order uit de database.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'];
    try {
        $sql = 'DELETE FROM [Pizza_Order] WHERE order_id = :order_id';
        $query = $db->prepare($sql);
        $query->execute([':order_id' => $orderId]);
        header('Location: /HTML/overviewStaff.php');
        exit();
    } catch (PDOException $e) {
        die('Error deleting order: ' . $e->getMessage());
    }
} else {
    // Als het geen post is ga je terug naar het overzicht. (Veiligheid)
    header('Location: /HTML/overviewStaff.php');
    exit();
}
?>
<?php
require_once '/applicatie/PHP/db_connectie.php'; // Include your database connection
$db = maakVerbinding();

// Update een bestaande order uit de database.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];
    try {
        $sql = 'UPDATE [Pizza_Order] SET status = :status WHERE order_id = :order_id';
        $query = $db->prepare($sql);
        $query->execute([':status' => $newStatus, ':order_id' => $orderId]);
        header('Location: /HTML/overviewStaff.php');
        exit();
    } catch (PDOException $e) {
        // Handle any errors that occur during the update
        die('Error updating order status: ' . $e->getMessage());
    }
} else {
    header('Location: /HTML/overviewStaff.php');
    exit();
}
?>
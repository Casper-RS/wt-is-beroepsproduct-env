<?php
function getUserData($db, $username) {
    $sql = 'SELECT username, email FROM [User ] WHERE username = :username';
    $query = $db->prepare($sql);
    $query->execute([':username' => $username]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function validateOrderInputs($name, $address, $postalCode, $email, $phone, $basket) {
    $errors = [];
    if (empty($name) || empty($address) || empty($postalCode) || empty($email) || empty($phone)) {
        $errors[] = "Vul alle velden in.";
    }
    if (empty($basket)) {
        $errors[] = "Je winkelmandje is leeg.";
    }
    return $errors;
}

function insertOrder($db, $username, $name, $personnel, $datetime, $status, $address) {
    $sqlOrder = "
        INSERT INTO [Pizza_Order] (client_username, client_name, personnel_username, datetime, status, address)
        VALUES (:client_username, :client_name, :personnel_username, :datetime, :status, :address)
    ";
    $stmtOrder = $db->prepare($sqlOrder);
    $stmtOrder->execute([
        ':client_username' => $username ?: null, // Handle NULL for non-logged-in users
        ':client_name' => $name,
        ':personnel_username' => $personnel,
        ':datetime' => $datetime,
        ':status' => $status,
        ':address' => $address,
    ]);
    return $db->lastInsertId(); // Return the last inserted order ID
}

function insertOrderItems($db, $orderId, $basket) {
    $sqlItem = "
        INSERT INTO Pizza_Order_Product (order_id, product_name, quantity)
        VALUES (:order_id, :product_name, :quantity)
    ";
    $stmtItem = $db->prepare($sqlItem);

    foreach ($basket as $productName => $details) {
        $stmtItem->execute([
            ':order_id' => $orderId,
            ':product_name' => $productName,
            ':quantity' => $details['quantity'],
        ]);
    }
}
?>
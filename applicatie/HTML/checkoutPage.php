<?php
require_once '/applicatie/PHP/db_connectie.php';
include '/applicatie/PHP/createHeader.php';
include '/applicatie/PHP/createHead.php';

if (!isset($_SESSION['user'])) {
  header('Location: /HTML/loginPage.php');
  exit;
}

$username = $_SESSION['user']; // Logged-in user's username
$basket = $_SESSION['basket'] ?? [];
$errors = [];

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
  $db = maakVerbinding();

  // Fetch user details
  $sql = 'SELECT username, email FROM [User] WHERE username = :username';
  $query = $db->prepare($sql);
  $query->execute([':username' => $username]);
  $user = $query->fetch(PDO::FETCH_ASSOC);

  if (!$user) {
    $errors[] = "Gebruikersgegevens niet gevonden.";
  }
} catch (PDOException $e) {
  $errors[] = "Fout bij het ophalen van gebruikersgegevens: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $address = trim($_POST['address'] ?? '');
  $postalCode = trim($_POST['postal_code'] ?? '');
  $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
  $phone = trim($_POST['phone'] ?? '');
  $status = 1; // Default status
  $datetime = date('Y-m-d H:i:s');
  $personnel = 'pietdikhoofd'; // Always assign pietdikhoofd as personnel

  // Validate form inputs
  if (empty($name) || empty($address) || empty($postalCode) || empty($email) || empty($phone)) {
    $errors[] = "Vul alle velden in.";
  }

  if (empty($basket)) {
    $errors[] = "Je winkelmandje is leeg.";
  }

  if (empty($errors)) {
    try {
      // Insert the order into the Pizza_Order table
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
        ':address' => $address . ', ' . $postalCode,
      ]);

      $orderId = $db->lastInsertId(); // Get the last inserted order ID

      // Insert products into Pizza_Order_Product table
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

      $_SESSION['basket'] = []; // Clear the basket after successful order
      header('Location: /HTML/confirmationPage.php');
      exit;
    } catch (PDOException $e) {
      $errors[] = "Fout bij het plaatsen van je bestelling: " . $e->getMessage();
    }
  }
}

?>

<!DOCTYPE html>
<html>
<?php
getHeader();
getHeadSection();
?>
<div class="delivery-page">
  <h1>Afrekenen</h1>

  <?php if (!empty($errors)): ?>
    <div class="errors">
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

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
</div>
<footer class="pizzaFooter">
  <p>&copy; 2024 Sole Machina ~ Alle rechten voorbehouden.</p>
  <p><a href="/HTML/privacybeleid.html">Privacy & Voorwaarden</a></p>
</footer>
</body>

</html>
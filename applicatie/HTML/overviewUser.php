<?php
include '/applicatie/PHP/head.php';
include '/applicatie/PHP/header.php';
require_once '/applicatie/PHP/db_connectie.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
  // Redirect to login page if not logged in
  header('Location: /HTML/inlogUser.php');
  exit;
}

$username = $_SESSION['user'];

try {
  $db = maakVerbinding();

  // Query user details from the database
  $sql = 'SELECT username, email FROM [User] WHERE username = :username';
  $query = $db->prepare($sql);
  $query->execute([':username' => $username]);
  $user = $query->fetch(PDO::FETCH_ASSOC);

  if (!$user) {
    // If user details are not found, log them out
    session_destroy();
    header('Location: /HTML/loginPage.php');
    exit;
  }

  // Extract user details
  $displayName = $user['username'];
  $email = $user['email'];
} catch (PDOException $e) {
  die('Error: ' . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<?php
getHeadSection();
getHeader();
?>
<main class="account-page">
  <section class="user-info">
    <h2>Welkom terug, <?php echo htmlspecialchars($displayName); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>
    <p>Laatst ingelogd: 20 november 2024</p>
  </section>
  <section class="order-status">
    <h2>Mijn Bestelling(en)</h2>
    <div class="order">
      <h3>Bestelling #12345</h3>
      <p><strong>Besteld op:</strong> 20 november 2024</p>
      <p>
        <strong>Status:</strong>
        <span class="status in-progress">In behandeling</span>
      </p>
      <p><strong>Totaalbedrag:</strong> €25,50</p>
      <ul class="order-items">
        <li>Pizza Margherita - €10,00</li>
        <li>Pizza Pepperoni - €12,00</li>
        <li>Cola - €3,50</li>
      </ul>
    </div>
    <div class="order">
      <h3>Bestelling #12344</h3>
      <p><strong>Besteld op:</strong> 18 november 2024</p>
      <p>
        <strong>Status:</strong>
        <span class="status delivered">Afgeleverd</span>
      </p>
      <p><strong>Totaalbedrag:</strong> €20,00</p>
      <ul class="order-items">
        <li>Pizza Vegetariana - €12,00</li>
        <li>Focaccia - €4,00</li>
        <li>Sprite - €4,00</li>
      </ul>
    </div>
  </section>
</main>
<footer>
  <p>&copy; 2024 Sole Machina. Alle rechten voorbehouden.</p>
  <p><a href="/HTML/privacybeleid.html">Privacy & Voorwaarden</a></p>
</footer>
</body>

</html>
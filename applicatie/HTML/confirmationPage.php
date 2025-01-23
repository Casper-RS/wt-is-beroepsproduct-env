<?php
session_start();

include '/applicatie/PHP/createHead.php';
include '/applicatie/PHP/createHeader.php';
include '/applicatie/PHP/createFooter.php';

if (!isset($_SESSION['user'])) {
    header('Location: /HTML/loginPage.php');
    exit;
}

// Logged-in user
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<?php getHeadSection(); ?>
<body>
    <?php getHeader(); ?>
    <main>
        <div class="confirmation-container">
            <h1>Bedankt voor je bestelling!</h1>
            <p>Je bestelling is succesvol geplaatst, <?php echo htmlspecialchars($username); ?>.</p>
            <p>We zijn bezig met de bereiding en bezorgen deze zo snel mogelijk!</p>
            <a href="/HTML/homePage.php" class="home-button">Terug naar Home</a>
        </div>
    </main>
    <?php getFooter(); ?>
</body>
</html>

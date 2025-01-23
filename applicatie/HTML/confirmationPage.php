<?php
include '/applicatie/PHP/createHTMLHead.php';
include '/applicatie/PHP/createHTMLHeader.php';
include '/applicatie/PHP/createHTMLFooter.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'Je moet ingelogd zijn om deze pagina te bekijken.';
    header('Location: /HTML/loginPage.php');
    exit;
}
$username = $_SESSION['user'];
?>


<!DOCTYPE html>
<?php
getHeadSection();
getHeader();
?>
<body>
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
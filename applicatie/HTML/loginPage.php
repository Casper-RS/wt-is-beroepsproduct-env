<?php
include '/applicatie/PHP/createHead.php';
include '/applicatie/PHP/createHeader.php';
include '/applicatie/PHP/handlePizzaCard.php';
include '/applicatie/PHP/createFooter.php';

require_once '/applicatie/PHP/db_connectie.php';

$melding = ''; // Error message
$usertype = $_POST['usertype'] ?? ''; // Default to empty

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $personnelID = $_POST['personnelID'] ?? '';

    $db = maakVerbinding();

    if ($usertype === 'Client') {
        // Check if the user is registered as Personnel
        $sql = 'SELECT role, password FROM [User] WHERE username = :username';
        $query = $db->prepare($sql);
        $query->execute([':username' => $username]);

        if ($rij = $query->fetch()) {
            if ($rij['role'] === 'Personnel') {
                $melding = 'Fout: Dit account is geregistreerd als personeel. Log in via de personeel-optie.';
            } elseif (password_verify($password, $rij['password'])) {
                session_start();
                $_SESSION['user'] = $username;
                header('location: overviewUser.php');
                exit;
            } else {
                $melding = 'Fout: Incorrect wachtwoord!';
            }
        } else {
            $melding = 'Fout: Gebruikersnaam niet gevonden!';
        }
    } elseif ($usertype === 'Personnel') {
        // Handle personnel login
        $sql = 'SELECT password, personnelID FROM [User] WHERE username = :username';
        $query = $db->prepare($sql);
        $query->execute([':username' => $username]);

        if ($rij = $query->fetch()) {
            if ($personnelID == $rij['personnelID'] && password_verify($password, $rij['password'])) {
                session_start();
                $_SESSION['user'] = $username;
                $_SESSION['personnelID'] = $personnelID;
                header('location: overviewStaff.php');
                exit;
            } else {
                $melding = 'Fout: Incorrect personeel ID of wachtwoord!';
            }
        } else {
            $melding = 'Fout: Gebruikersnaam niet gevonden!';
        }
    } else {
        $melding = 'Fout: Ongeldig type login!';
    }
}
?>


<!DOCTYPE html>
<?php getHeadSection(); ?>
<body class="inlogScherm">
    <?php getHeader(); ?>
    <main>
        <div class="login-container">
            <form class="login-form" method="post" action="">
                <h2>Inloggen</h2>
                <?php if ($melding): ?>
                    <div class="error-box">
                        <?php echo htmlspecialchars($melding); ?>
                    </div>
                <?php endif; ?>
                <label for="user-type">Type login:</label>
                <select id="user-type" name="usertype" onchange="this.form.submit()">
                    <option value="Client" <?php echo $usertype === 'Client' ? 'selected' : ''; ?>>Klant</option>
                    <option value="Personnel" <?php echo $usertype === 'Personnel' ? 'selected' : ''; ?>>Personeel</option>
                </select>
                <?php if ($usertype === 'Personnel'): ?>
                    <label for="personnelID">Personeel ID</label>
                    <input
                        type="number"
                        id="personnelID"
                        name="personnelID"
                        placeholder="Geef personeel ID op"
                        value="<?php echo htmlspecialchars($_POST['personnelID'] ?? ''); ?>"
                    />
                <?php endif; ?>
                <label for="username">Gebruikersnaam</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Voer je gebruikersnaam in"
                    required
                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                />
                <label for="password">Wachtwoord</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Voer je wachtwoord in"
                    required
                />
                <button type="submit" name="submit-login" value="submit-login">Inloggen</button>
                <div class="andereLoginKeuze">
                    <a href="/HTML/registeryPage.php">Nog geen account? Registreer hier</a>
                </div>
            </form>
        </div>
    </main>
    <?php getFooter(); ?>
</body>
</html>

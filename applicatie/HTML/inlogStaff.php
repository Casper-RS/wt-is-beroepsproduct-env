<?php
    include '/applicatie/PHP/head.php';
    include '/applicatie/PHP/header.php';
    include '/applicatie/PHP/pizzaCard.php';
    include '/applicatie/PHP/footer.php';

    require_once '/applicatie/PHP/db_connectie.php';

    $melding = ''; //De melding voor de error.

    if(isset($_POST['inloggenStaff'])) { // <- Keycheck
        $melding = "Er is op de knop geklikt!";

        $username   = $_POST['usernameStaff'];
        $password = $_POST['WachtwoordStaff'];
        // Verbinding maken met onze database.
        $db = maakVerbinding();

        $sql = 'SELECT password FROM [User] WHERE username = :username';
        //Nu stoppen we de query in de database om uit te voeren.
        $query = $db->prepare($sql);
        //Check of de gebruikersnaam in de database zit.
        $data_array = [':username' => $username];
        $query->execute($data_array);
        if ($rij = $query->fetch()) {
            //wachtwoord checken
            $passwordhash = $rij['password'];
            if (password_verify($password, $passwordhash)) {
                session_start();
                header('location: overviewStaff.php');
                $_SESSION['user'] = $username;
                $melding = 'Gebruiker is ingelogd';
            } else {
                $melding = 'Fout: incorrecte inloggegevens!!';
            }
        } else {
            $melding = 'Incorrecte inloggegevens';
        }       
    }
?>

<!DOCTYPE html>
  <?php getHeadSection();?>
  <body class="inlogScherm">
  <?php getHeader();?>
    <main>
      <div class="login-container">
        <form
          class="login-form"
          method="get"
          action="/HTML/accountPaginaStaff.html">
          <div class="loginTitle">
            <h1>Pizzaria Sola Machina</h1>
            <button id="homeButton" onclick="location.href='home.html'" type="button">Ga naar home pagina</button>
          </div>
          <h2>Inloggen</h2>
          <label for="user-type">Type login:</label>
          <select id="user-type" name="user-type" size="1">
            <option value="staff">Personeel</option>
          </select>
          <label for="staffID">Personeel ID</label>
          <input
            type="number"
            id="PersoneelID"
            name="PersoneelID"
            placeholder="Geef personeel ID op"
            required/>
          <label for="usernameStaff">Gebruikersnaam</label>
          <input
            type="text"
            id="usernameStaff"
            name="usernameStaff"
            placeholder="Voer je gebruikersnaam in"
            pattern="{6-20}"
            required/>
          <label for="passwordStaff">Wachtwoord</label>
          <input
            type="password"
            id="passwordStaff"
            name="WachtwoordStaff"
            placeholder="Voer je wachtwoord in"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            required/>
          <button type="submit" name="inloggenStaff" value="inloggenStaff">>Inloggen</button>
          <div class="andereLoginKeuze">
            <a href="/HTML/registeryPage.php">Nog geen account? Registreer hier</a>
          </div>
        </form>
      </div>
    </main>
    <?php getFooter("$brandname") ?>
  </body>
</html>

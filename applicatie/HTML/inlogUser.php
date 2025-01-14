<?php
    include '/applicatie/PHP/head.php';
    include '/applicatie/PHP/header.php';
    include '/applicatie/PHP/pizzaCard.php';
    include '/applicatie/PHP/footer.php';

    require_once '/applicatie/PHP/db_connectie.php';

    $melding = ''; //De melding voor de error.

    if(isset($_POST['inloggenUser'])) { // <- Keycheck
        $melding = "Er is op de knop geklikt!";

        $username   = $_POST['username'];
        $password = $_POST['password'];
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
                header('location: overviewUser.php');
                $_SESSION['user'] = $username;
                $melding = 'Gebruiker is ingelogd';
            } else {
                $melding = 'Fout: Incorrecte inloggegevens!!';
            }
        } else {
            $melding = 'Fout: Incorrecte inloggegevens';
        }       
    }


    /*
        Keycheck (van de form)
        Speciale karakters moeten er uit
        Business rules (juiste range)
        Spaties of soort gelijke dingen
        Juiste datatype moet gecheckt worden

        Dit moet in een functie gecheckt worden.

        htmlspecialchars kan helpen

        empty functie zoeken in documentatie
        PHP validate (filter var) opzoeken

        PHP front to back video 14

        Beviliging tegen underposting en overposting maken
        Array maken met keys die in de form staan

        passwordhas maken, dit wil zeggen dat je het wachtwoord wel gebruikt, maar niet opslaat.
        Een passwordhash is een bytereeks (willekeurig aantal) en genereerd een password met een vaste bytereeks.
        password_hash(); 
    */ 
?>

<!DOCTYPE html>
    <?php
        getHeadSection();
        getHeader();
    ?>
    <main>
      <div class="login-container">
        <form class="login-form" method="post" action="/HTML/inlogUser.php">
          <div class="loginTitle">
            <h1>Pizzaria Sola Machina</h1>
            <button id="homeButton" onclick="location.href='home.html'" type="button"> Ga naar home pagina</button>
          </div>
          <h2>Inloggen</h2>
          <label for="user-type">Type login:</label>
          <select id="user-type" name="usertype">
            <option value="Client">Klant</option>        
          </select>
          <label for="usernameUser">Gebruikersnaam</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Voer je gebruikersnaam in"
            pattern="{6-20}"
            required/>
          <label for="passwordUser">Wachtwoord</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Voer je wachtwoord in"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            required/>
            <?php $melding ?>
          <button type="submit" name="inloggenUser" value="inloggenUser">Inloggen</button>
          <div class="andereLoginKeuze">
            <a href="/HTML/registeryPage.php">Nog geen account? Registreer hier</a>
          </div>
          <h2>Personeel?</h2>
        </form>
        <button class="staffLogin" onclick="location.href='inlogStaff.php'" type="button">
          Klik hier om in te loggen
        </button>
      </div>
    </main>
    <?php getFooter() ?>
  </body>
</html>

<?php
/*
Met een foreach loop door alle keys heen lopen, om te kijken of er niet teveel (overpost tag) of te weinig (underposting tags) zijn
Via $_POST (superglobal) dit testen in de URL

empty gebruiken of de ingevulde velden van de keys niet leeg zijn.


*/
?>
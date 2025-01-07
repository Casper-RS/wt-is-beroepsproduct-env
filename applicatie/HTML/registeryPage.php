<?php
  include '/applicatie/PHP/head.php';
  include '/applicatie/PHP/header.php';
  include '/applicatie/PHP/pizzaCard.php';
  include '/applicatie/PHP/footer.php';

  require_once '/applicatie/PHP/db_connectie.php';
$notification = '';

if(isset($_POST['registerUser'])) {
    $errorMessage = [];
    $naam       = $_POST['createUsername'];
    $wachtwoord = $_POST['createPassword'];
    $email      = $_POST['createEmail'];
    $phone      = $_POST['createPhone'];

    // Check of de string lengte een minimaal aantal is. 
    if(strlen($naam) < 4) {
        $errorMessage[] = 'Gebruikersnaam moet minimaal 4 karakters zijn.';
    }
    if(strlen($wachtwoord) < 8) {
        $errorMessage[] = 'Wachtwoord moet minimaal 8 karakters zijn.';
    }
    if(strlen($email) < 10) {
        $errorMessage[] = 'Emailadres moet minimaal 10 karakters zijn.';
    }
    if(strlen($phone) < 11) {
        $errorMessage[] = 'Telefoonnummer moet minimaal 11 karakters zijn.';
    }    
    // 3. opslaan van de gegevens
    if(count($errorMessage) > 0) {
        $notification = "Check of de usernaam 4 en de password 8 karakters is.<ul>";
        foreach($errorMessage as $fout) {
            $notification .= "<li>$fout</li>";
        }
        $notification .= "</ul>";
    } else {
        // Voordat het wachtwoord opgeslagen wordt hashen we het.
        $passwordhash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        
        $db = maakVerbinding();
        $sql = 'INSERT INTO User([username], [password], [first_name], [last_name])
                values (:naam, :passwordhash, :email, :phone)';
        $query = $db->prepare($sql);

        $data_array = ['naam' => $naam, 'passwordhash' => $passwordhash, 'email' => $email, 'phone' => $phone];
        $succes = $query->execute($data_array);

        // Check results
        if($succes) {
            $melding = 'Gebruiker is geregistreerd.';
        } else {
            $melding = 'Registratie is mislukt.';
        }
    }
}
?>


<!DOCTYPE html>
  <?php getHeadSection(); ?>
  <body class="inlogScherm">
    <?php getHeader(); ?>
    <div class="login-container">
      <form class="login-form" method="get" action="/HTML/inlogUser.php">
        <div class="loginTitle">
          <h1>Pizzaria Sola Machina</h1>
          <button id="homeButton" onclick="location.href='home.html'" type="button">Ga naar home pagina</button>
        </div>
        <h2>Registreer Account</h2>
        <label for="createUsername">Gebruikersnaam</label>
        <input
          type="text"
          id="createUsername"
          name="username"
          placeholder="Kies een gebruikersnaam" 
          pattern="{6, 20}"
          required/>
        <label for="createPassword">Wachtwoord</label>
        <input
          type="password"
          id="createPassword"
          name="Wachtwoord"
          placeholder="Kies een wachtwoord"
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
          required/>
        <label for="createEmail">Emailadres</label>
        <input
          autocomplete="email"
          type="email"
          id="createEmail"
          name="Emailadres"
          placeholder="Voer emailadres in"
          required/>
        <label for="createPhone">TelefoonNummer</label>
        <input
          type="tel"
          id="createPhone"
          name="Telefoonnummer"
          placeholder="Geef uw telefoon nummer op"
          pattern="[0-9]{2}-[0-9]{8}"/>
        <button type="submit" name="registerUser" value="registerUser">Registreer</button>
        <div class="andereLoginKeuze">
          <a href="/HTML/inlogUser.php">Ben je al een gebruiker? <br />Klik om in te loggen</a>
        </div>
      </form>
    </div>
    <?php getFooter("$brandname") ?>
  </body>
</html>

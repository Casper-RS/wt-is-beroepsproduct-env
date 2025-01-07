<?php
    include '/applicatie/PHP/head.php';
    include '/applicatie/PHP/header.php';
    include '/applicatie/PHP/pizzaCard.php';
    include '/applicatie/PHP/footer.php';

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
            id="staffID"
            name="Personeel ID"
            placeholder="Geef personeel ID op"
            required/>
          <label for="usernameStaff">Gebruikersnaam</label>
          <input
            type="text"
            id="usernameStaff"
            name="username"
            placeholder="Voer je gebruikersnaam in"
            pattern="{6-20}"
            required/>
          <label for="passwordStaff">Wachtwoord</label>
          <input
            type="password"
            id="passwordStaff"
            name="Wachtwoord"
            placeholder="Voer je wachtwoord in"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            required/>
          <button type="submit">Inloggen</button>
          <div class="andereLoginKeuze">
            <a href="/HTML/registeryPage.php">Nog geen account? Registreer hier</a>
          </div>
        </form>
      </div>
    </main>
    <?php getFooter("$brandname") ?>
  </body>
</html>

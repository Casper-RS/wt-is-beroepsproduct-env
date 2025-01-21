<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bezorggegevens | Pizzeria Bella Italia</title>
    <link rel="stylesheet" href="/CSS/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  </head>
  <body>
    <header>
      <div class="logo">
        <h1>Sole Machina</h1>
        <p>Elke dag vers bereid!</p>
      </div>
      <nav>
        <ul>
          <li><a href="/HTML/home.html">Home</a></li>
          <li><a href="/HTML/pizza.html">Pizza's</a></li>
          <li><a href="/HTML/inlogScherm.html">Account</a></li>
          <li>
            <a href="/HTML/winkelmand.html">
              <span class="cart-icon">
                <i class="fa fa-shopping-cart"></i>
              </span>
            </a>
          </li>
        </ul>
      </nav>
    </header>
    <main class="delivery-page">
      <h2>Bezorggegevens</h2>
      <form class="delivery-form">
        <label for="name">Naam:</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Voor- en achternaam"
          required/>
        <label for="address">Adres:</label>
        <input
          type="text"
          id="address"
          name="address"
          placeholder="Straatnaam en huisnummer"
          required/>
        <label for="postcode">Postcode:</label>
        <input
          type="text"
          id="postcode"
          name="postcode"
          placeholder="1234 AB"
          required/>
        <label for="city">Woonplaats:</label>
        <input
          type="text"
          id="city"
          name="city"
          placeholder="Woonplaats"
          required/>
        <label for="phone">Telefoonnummer:</label>
        <input
          type="tel"
          id="phone"
          name="phone"
          placeholder="06-12345678"
          required/>
        <button class="payment-btn" type="submit">Doorgaan naar betalen</button>
      </form>
    </main>
    <footer>
      <p>&copy; 2024 Sole Machina. Alle rechten voorbehouden.</p>
      <p><a href="/HTML/privacybeleid.html">Privacy & Voorwaarden</a></p>
    </footer>
  </body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mijn Account | Pizzeria Bella Italia</title>
    <link rel="stylesheet" href="/CSS/style.css" />
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
          <li><a href="/HTML/accountPaginaUser.html">Mijn bestellingen</a></li>
          <li><a href="/HTML/inlogScherm.html">Uitloggen</a></li>
        </ul>
      </nav>
    </header>
    <main class="account-page">
      <section class="user-info">
        <h2>Welkom terug, John Doe!</h2>
        <p>Email: johndoe@example.com</p>
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

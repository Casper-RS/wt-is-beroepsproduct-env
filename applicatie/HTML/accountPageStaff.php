<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Personeel Dashboard | Sole Machina</title>
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
          <li><a href="/HTML/home.html">Bestellingen</a></li>
          <li><a href="/HTML/accountPaginaUser.html">Gebruikersbeheer</a></li>
          <li><a href="/HTML/inlogScherm.html">Uitloggen</a></li>
        </ul>
      </nav>
    </header>
    <main class="staff-page">
      <section class="order-status">
        <h2>Actieve Bestellingen</h2>
        <div class="order">
          <h3>Bestelling #12345</h3>
          <p><strong>Gebruiker:</strong> John Doe</p>
          <p><strong>Besteld op:</strong> 20 november 2024</p>
          <p>
            <strong>Status:</strong>
            <span class="status in-progress">In behandeling</span>
          </p>
          <p><strong>Totaalbedrag:</strong> €25,50</p>
          <br>
          <h3><strong>Bezorg gegevens:</strong></h3>
          <p><strong>Adres:</strong> Beltrumseweg 4, 7271NB Borculo</p>
          <br>
          <h3><strong>Bestelde items:</strong></h3>
          <ul class="order-items">
            <li>Pizza Margherita - €10,00</li>
            <li>Pizza Pepperoni - €12,00</li>
            <li>Cola - €3,50</li>
          </ul>
          <div class="order-actions">
            <button class="btn update-status">Status wijzigen</button>
            <button class="btn edit-order">Bestelling bewerken</button>
            <button class="btn delete-order">Bestelling verwijderen</button>
          </div>
        </div>
        <div class="order">
          <h3>Bestelling #12344</h3>
          <p><strong>Gebruiker:</strong> Jane Smith</p>
          <p><strong>Besteld op:</strong> 18 november 2024</p>
          <p>
            <strong>Status:</strong>
            <span class="status delivered">Afgeleverd</span>
          </p>
          <p><strong>Totaalbedrag:</strong> €20,00</p>
          <br>
          <h3><strong>Bezorg gegevens:</strong></h3>
          <p><strong>Adres:</strong> Beltrumseweg 4, 7271NB Borculo</p>
          <br>
          <h3><strong>Bestelde items:</strong></h3>
          <ul class="order-items">
            <li>Pizza Vegetariana - €12,00</li>
            <li>Focaccia - €4,00</li>
            <li>Sprite - €4,00</li>
          </ul>
          <div class="order-actions">
            <button class="btn update-status">Status wijzigen</button>
            <button class="btn edit-order">Bestelling bewerken</button>
            <button class="btn delete-order">Bestelling verwijderen</button>
          </div>
        </div>
      </section>
    </main>
    <footer>
      <p>&copy; 2024 Sole Machina. Alle rechten voorbehouden.</p>
      <p><a href="/HTML/privacybeleid.html">Privacy & Voorwaarden</a></p>
    </footer>
  </body>
</html>

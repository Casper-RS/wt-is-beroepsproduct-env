<?php
include '/applicatie/PHP/header.php';
include '/applicatie/PHP/footer.php';
include '/applicatie/PHP/imageText.php';

$brandname = 'Pizzeria Sole Machina'
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php $brandname ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"+/>
    <style>
    <?php include '/applicatie/CSS/style.css'; ?>
    </style>
  </head>
  <body>
    <?php getHeader("Sole Machina") ?>
    <main>
      <section class="homePage">
        <h2>Welkom bij Sole Machina</h2>
        <p></p>
        <a href="/HTML/pizza.html" class="btn">Bekijk het menu</a>
      </section>
      <section class="popular-pizzas">
        <h2>Populaire Pizza's</h2>
        <div class="pizza-list">
          <div class="pizzaListItem">
            <img class="pizzaPic" src="/Images/margerita.png" alt="Margherita"/>
              <?php imageText("Pizza Margherita", "Krokante korst, verse tomatensaus en kaas.") ?>
            </div>
          <div class="pizzaListItem">
            <img class="pizzaPic" src="/Images/salami.png" alt="Pepperoni" />
              <?php imageText("Pizza Pepperoni", "Pikante salami en gesmolten kaas.") ?>
          </div>
          <div class="pizzaListItem">
            <img class="pizzaPic" src="/Images/hawaii.png" alt="Hawaii" />
              <?php imageText("Pizza Hawaii", "Frisse ananas en een verse ham.") ?>
          </div>
        </div>
      </section>
    </main>
    <?php getFooter("Sole Machina") ?>
  </body>
</html>

<?php
include '/applicatie/PHP/createHTMLHead.php';
include '/applicatie/PHP/createHTMLHeader.php';
include '/applicatie/PHP/createCardPizza.php';
include '/applicatie/PHP/createHTMLFooter.php';
?>

<!DOCTYPE html> 
    <?php
      getHeadSection();
      getHeader();
    ?>
    <main>
      <section class="homePage">
        <h2>Welkom bij <?php echo $brandname?></h2>
        <p></p>
        <a href="/HTML/pizzaPage.php" class="btn">Bekijk het menu</a>
      </section>
      <section class="popular-pizzas">
        <h2>"Populaire Pizza's"</h2>
        <div class="pizza-list">
          <?php
            createNoButtonCard("/Images/margerita.png", "Margherita", "Pizza Margherita", 'Krokante korst, verse tomatensaus en kaas.', '');
            createNoButtonCard("/Images/salami.png", "Pepperoni", "Pizza Pepperoni", 'Pikante salami en gesmolten kaas.', '');
            createNoButtonCard("/Images/hawaii.png", "Hawaii", "Pizza Hawaii", 'Frisse ananas en een verse ham.', '');
          ?>
        </div>
      </section>
    </main>
    <?php getFooter() ?>
  </body>
</html>


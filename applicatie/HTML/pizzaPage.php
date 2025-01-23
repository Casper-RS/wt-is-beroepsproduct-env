<?php
include '/applicatie/PHP/createHTMLHead.php';
include '/applicatie/PHP/createHTMLHeader.php';
include '/applicatie/PHP/createHTMLFooter.php';

require_once '/applicatie/PHP/createCardPizza.php';
require_once '/applicatie/PHP/createCardDrink.php';

$popPizza = "Populaire Pizza's";
?>
<!DOCTYPE html>
<?php
getHeadSection();
getHeader();
?>
<main>
    <div class="popup">
        <div class="popup-content">
            <h2>Speciale Korting!</h2>
            <p>
                Ontvang vandaag 20% korting op je favoriete pizza's! <br> Gebruik code
                <strong>PIZZA20</strong> bij het afrekenen.
            </p>
            <a href="#" class="close-btn">&times;</a>
        </div>
    </div>
    <div class="pizzaMenu">
        <h2>Pizza's</h2>
        <div class="pizza-list">
            <?php showPizzaCards() ?>
        </div>
        <h2>Dranken</h2>
        <div class="pizza-list">
            <?php showDrinkCards() ?>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.querySelector('.popup');
        const closeBtn = document.querySelector('.close-btn');

        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            popup.classList.add('hidden');
        });
    });
</script>
<?php getPizzaFooter(); ?>
</body>

</html>
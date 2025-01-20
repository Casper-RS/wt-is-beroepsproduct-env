<?php
include '/applicatie/PHP/head.php';
include '/applicatie/PHP/header.php';
include '/applicatie/PHP/pizzaCard.php';
include '/applicatie/PHP/footer.php';

$popPizza = "Populaire Pizza's";

/*
De pizzacard moet een form worden zodat er een button en post gemaakt kan worden.

*/
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
                    <?php
                    showPizzaCards();
                    ?>
                </div>
                <h2>Salades & Dranken</h2>
                <div class="pizza-list">
                    <?php
                    createPizzaCard("/Images/margerita.png", "Margherita", "Pizza Margherita", 'Krokante korst, verse tomatensaus en kaas.', '€10,00');
                    createPizzaCard("/Images/margerita.png", "Margherita", "Pizza Margherita", 'Krokante korst, verse tomatensaus en kaas.', '€10,00');
                    createPizzaCard("/Images/margerita.png", "Margherita", "Pizza Margherita", 'Krokante korst, verse tomatensaus en kaas.', '€10,00');
                    ?>
                </div>
            </div>
        </main>
        <?php getFooter() ?>
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
    </body>
</html>
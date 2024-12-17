<?php
include '/applicatie/PHP/button.php';

function createPizzaCard($imageSrc, $altText, $titleText, $description, $price){
    echo '
    <div class="pizzaListItem">
        <img class="pizzaPic" src="'. htmlspecialchars($imageSrc) .'" alt="' . htmlspecialchars($altText) . '"/>
            <h3>' . htmlspecialchars($titleText) . '</h3>
            <p>' . htmlspecialchars($description) . '</p>
            <p>' . htmlspecialchars($price) . '</p>
            <button>Klik om te bestellen</button>
    </div>'
    ;}

function createNoButtonCard($imageSrc, $altText, $titleText, $description, $price){
    echo '
    <div class="pizzaListItem">
        <img class="pizzaPic" src="'. htmlspecialchars($imageSrc) .'" alt="' . htmlspecialchars($altText) . '"/>
            <h3>' . htmlspecialchars($titleText) . '</h3>
            <p>' . htmlspecialchars($description) . '</p>
            <p>' . htmlspecialchars($price) . '</p>
    </div>'
    ;}
?>
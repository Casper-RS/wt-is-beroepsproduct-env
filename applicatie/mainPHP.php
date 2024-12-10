<?php
$menukaart = array(
    'Eten' => array(
        'Pizza 1' => 10.95,
        'Pizza 2' => 10.95,
        'Pizza 3' => 10.95
    ),
    'Drinken' => array(
        'Drankje 1' => 3.95,
        'Drankje 2' => 3.95, 
        'Drankje 3' => 3.95
    )
);

$titel = 'Menukaart';
echo "<h1>$titel</h1>";

foreach($menukaart as $menuSectie => $gerechten) {
    echo "<h2>$menuSectie</h2>";
    //Op deze manier pakken we de array van Menukaart en voegen we een associative array toe
    //die secties maakt voor alles binnen het array van de Menukaart.
    //In andere woorden maken we "categorien" binnen de menukaart.
    echo '<ul>';
    foreach($gerechten as $gerecht => $prijs) {
        echo "<li>$gerecht - $prijs</li>";
        //Op deze manier pakken we de "categorieen" van de menukaart en voegen we met een
        //2e associative array items to aan elke categorie, samen met de prijs.
        //
        //Daardoor wordt de site dynamisch en kan je simpel aan het menukaart array nieuwe items toevoegen.
    }
    echo '</ul>';
}

?>
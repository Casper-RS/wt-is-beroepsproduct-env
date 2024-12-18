<?php

require_once 'db_connectie.php';
/*
Over het algemeen is require_once altijd voldoende. Require_once zorgt voor een unieke copy van een ander bestand,
zonder de includes en excludes mee te nemen van andere bestanden.
*/

$db = maakVerbinding();
$query = 'SELECT * FROM Product';

$data = $db->query($query);

$html_table = '<table>';
$html_table = $html_table . '<tr><th>Producten</th></td><th>Prijs</th></td><th>Type</th></td>';

while($rij = $data->fetch()){
    $Producten = $rij['name'];
    $Prijs = $rij['price'];
    $Type = $rij['type_id'];
    $html_table = $html_table . "<tr><td>$Producten</td><td>$Prijs</td><td>$Type</td></tr>";
}

$html_table = $html_table . "</table>";

/*
Foreach is een simpele loop die gebruikt kan worden zodra alle condities hetzelfde "behandeld" kunnen worden.
Bijvoorbeeld als je uit een tabel alle kolommen wilt laten zien, kun je zeggen met een foreach dat elke kolom van een tabel getoont mag worden

Wanneer je specifiek een bepaalde kolom wilt, of alle oneven kolommen, wordt er nog steeds een forloop zoals in processing gebruikt.

Ook wanneer er arrays zijn en alles hetzelfde moet zijn is een foreach lus handig.
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo ($html_table);
    ?>
</body>
</html>


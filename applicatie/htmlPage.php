<?php

include 'phpFunctions.php';
//Include zorgt voor bestanden of libraries importeren die buiten de file zijn.
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

$pageInfo = createMenuHTML($menukaart)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= $pageInfo ?>
</body>

</html>
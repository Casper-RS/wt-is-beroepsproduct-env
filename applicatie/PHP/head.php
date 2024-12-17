<?php
$brandname = 'Sole Machina';

function getHeadSection()
{
    global $brandname; // Use the global variable inside the function
    echo '
    <html lang="nl"> 
        <head>  
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>' . $brandname . '</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
            <style>';
                include '/applicatie/CSS/style.css';
    echo    '</style>
        </head>';
}

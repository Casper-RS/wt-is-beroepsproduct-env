<?php
$brandname = 'Sole Machina';

function getFooter()
{
    global $brandname;
    echo '
    <footer>
        <p>&copy; 2024 '. $brandname .' ~ Alle rechten voorbehouden.</p>
        <p><a href="/HTML/privacybeleid.html">Privacy & Voorwaarden</a></p>
    </footer>';
};
?>
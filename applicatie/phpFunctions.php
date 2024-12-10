<?php
function createMenuHTML($menuArray)
{
    $titel = 'Menukaart';
    $html = "<h1>$titel</h1>";
    foreach ($menuArray as $menuSectie => $gerechten) {
        $html .= "<h2>$menuSectie</h2>";
        $html .= '<ul>';
        foreach ($gerechten as $gerecht => $prijs) {
            $html .= "<li>$gerecht - $prijs</li>";
        }
        $html .= '</ul>';
    }
    return $html;
}
?>
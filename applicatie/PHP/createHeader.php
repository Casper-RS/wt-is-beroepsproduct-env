<?php
$brandname = 'Sole Machina';

function getHeader()
{
    global $brandname;
    echo '
    <body>
    <header>
        <div class="logo">
            <h1>' . $brandname . '</h1>
            <p>Elke dag vers bereid!</p>
        </div>
        <nav>
            <ul>
                <li><a href="/HTML/homePage.php">Home</a></li>
                <li><a href="/HTML/pizzaPage.php">Pizza\'s</a></li>
                <li><a href="/HTML/loginPage.php">Account</a></li>
                <li>
                    <a href="/HTML/basketPage.php">
                        <span class="cart-icon">
                            <i class="fa fa-shopping-cart"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>';
}

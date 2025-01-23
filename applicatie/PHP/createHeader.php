<?php
$brandname = 'Sole Machina';
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if not already started
}

function getHeader()
{
    global $brandname;

    $isLoggedInStaff = isset($_SESSION['personnelID']);
    $isLoggedInUser  = isset($_SESSION['user']); // Check if the user session variable exists

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
                <li><a href="/HTML/pizzaPage.php">Pizza\'s</a></li>';

    // Show appropriate links based on user or staff login
    if ($isLoggedInUser ) {
        echo '
                <li><a href="/HTML/overviewUser.php">Mijn Account</a></li>
                <li>
                    <form method="post" action="/PHP/functionLogout.php" style="display:inline;">
                        <button type="submit" class="logout-btn">Uitloggen</button>
                    </form>
                </li>';
    } elseif ($isLoggedInStaff) {
        echo '
                <li><a href="/HTML/overviewStaff.php">Mijn Account</a></li>
                <li>
                    <form method="post" action="/PHP/functionLogout.php" style="display:inline;">
                        <button type="submit" class="logout-btn">Uitloggen</button>
                    </form>
                </li>';
    } else {
        echo '
                <li><a href="/HTML/loginPage.php">Account</a></li>';
    }

    echo '
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
?>
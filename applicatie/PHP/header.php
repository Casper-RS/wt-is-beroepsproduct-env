<?php
function getHeader($brandName) {
    echo '
    <header>
        <div class="logo">
            <h1>' . $brandName . '</h1>
            <p>Elke dag vers bereid!</p>
        </div>
        <nav>
            <ul>
                <li><a href="/HTML/home.html">Home</a></li>
                <li><a href="/HTML/pizza.html">Pizza\'s</a></li>
                <li><a href="/HTML/inlogScherm.html">Account</a></li>
                <li>
                    <a href="/HTML/winkelmand.html">
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
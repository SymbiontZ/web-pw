<?php

define('HOME_DIR', "/web-pw/index.php");

function render_navbar() {
    echo '
    <div class="navbar color-4 d-flex align-center justify-between">
        <div class="nav-left">
            <a href="'.HOME_DIR.'" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
        </div>
        <div class="nav-center">
            <form method="POST" action="busqueda.php">
                <input type="text" name="busqueda" placeholder="Buscar por título, autor, editorial..." class="search-input">
                <button type="submit" name="buscar" class="search-btn color-4">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="nav-right">';
    
    if (!$_SESSION["logged_in"]) {
        echo '<a href="login.php" class="nav-btn raleway-regular color-4 no-link-style">Login</a>';
    } else {
        echo '<a href="perfil.php" class="nav-btn raleway-regular color-4 no-link-style">Perfil</a>';
    }

    echo '
            <a href="carrito.php" class="nav-btn raleway-regular color-4 no-link-style" style="position: relative;">
                <i class="fas fa-shopping-cart"></i>';
                
    $total_items = 0;
    if (!empty($_SESSION["carrito"]) && is_array($_SESSION["carrito"])) {
        foreach ($_SESSION["carrito"] as $item) {
            $total_items += $item["cantidad"];
        }
    }
    if ($total_items > 0) {
        echo '
                <span style="
                    position: absolute; 
                    top: -5px; 
                    right: -5px; 
                    background-color: red; 
                    color: white; 
                    border-radius: 50%; 
                    width: 15px; 
                    height: 15px; 
                    display: flex; 
                    align-items: center; 
                    justify-content: center; 
                    font-size: 12px;">
                    ' . $total_items . '
                </span>';
    }
    echo '
            </a>
        </div>
    </div>';
}
?>
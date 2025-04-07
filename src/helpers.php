<?php
function mostrarMensaje(string $mensaje, bool $accion): void {
    $color = $accion ? 'green' : 'red';
    $icono = $accion ? '✔️' : '❌';

    echo "
    <div id='mensaje-flash' class='mensaje-flash' style='background-color: $color;'>
        <span>$icono $mensaje</span>
        <button class='cerrar-mensaje'>✖</button>
    </div>
    <script src='./mensaje.js'></script>
    ";
}

function render_navbar() {
    echo '
    <div class="navbar color-4 d-flex align-center justify-between">
        <div class="nav-left">
            <a href="./" class="nav-btn raleway-regular color-4 no-link-style">WANNABOOK</a>
        </div>
        <div class="nav-center">
            <form method="POST" action="busqueda.php">
                <input type="text" name="busqueda" placeholder="Buscar por título, autor, editorial..." class="search-input">
                <button type="submit" name="buscar" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="nav-right">
            <?php if (!$_SESSION["logged_in"]): ?>
                <a href="login.php" class="nav-btn raleway-regular color-4 no-link-style">Login</a>
            <?php else: ?>
                <a href="perfil.php" class="nav-btn raleway-regular color-4 no-link-style">Perfil</a>
            <?php endif; ?>
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
    </div>
    ';
}
?>
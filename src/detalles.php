<?php

include ('./src/CRUD.php');

if(isset($_GET['id_libro'])){
    $id_libro = $_GET['id_libro'];
    $libro = obtenerLibroPorId($id_libro);

    if($libro){
        echo "<div class='product-container justify-center max-w'>";
        echo "  <img class = 'justify-center d-flex max-w' src='./data/". $libro->get_url()."' alt='".$libro->get_titulo()."-".$libro->get_autor()."'>";
        echo "  <hr>";
        
        echo "  <div>";
        echo "      <a class='size-28 bold no-link-style' href='https://example.com'>" . htmlspecialchars(strtoupper($libro->get_titulo())) . "</a>";
        echo "      <p class='size-20 low-margin-v'>" . htmlspecialchars($libro->get_autor()) . "</p>";
        echo "      <p>" . number_format($libro->get_precio(), 2) . "€ </p>";
        echo "  </div>";
        echo "</div>";
    }

}else {
    echo "No se ha encontrado el libro buscado.";
}

?>
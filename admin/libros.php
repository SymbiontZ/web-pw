<?php
session_start();
include('../src/CRUD.php');
include('../src/helpers.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] or !isAdmin($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_libro']) && isset($_POST['accion'])) {
        $id_libro = (int)$_POST['id_libro'];
        $accion = $_POST['accion'] === 'habilitar' ? 1 : 0;

        cambiarEstadoLibro($id_libro, $accion);
    }
}

$libros = devolverLibros();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Libros</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php render_navbar(); ?>
    <div class="container" style="margin-top: 60px; margin-left: 20px;">
        <h1>Administrar Libros</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($libros)): ?>
                    <tr>
                        <td colspan="5">No hay libros registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($libro->get_titulo() ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($libro->get_autor() ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($libro->get_fecha() ?? 'N/A'); ?></td>
                        <td><?php echo $libro->get_disponible() ? 'Disponible' : 'No disponible'; ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id_libro" value="<?php echo $libro->get_id(); ?>">
                                <?php if ($libro->get_disponible()): ?>
                                    <button type="submit" name="accion" value="deshabilitar">Deshabilitar</button>
                                <?php else: ?>
                                    <button type="submit" name="accion" value="habilitar">Habilitar</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

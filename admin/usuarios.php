<?php
session_start();
include('../src/CRUD.php');
include('../src/helpers.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] or !isAdmin($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_usuario']) && isset($_POST['accion'])) {
        $id_usuario = (int)$_POST['id_usuario'];
        $accion = $_POST['accion'] === 'habilitar' ? 1 : 0;

        cambiarEstadoUsuario($id_usuario, $accion); 
    }
}

$usuarios = devolverUsuariosCorrientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php render_navbar(); ?>
    <div class="container" style="margin-top: 60px; margin-left: 20px;">
        <h1>Administrar Usuarios</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="4">No hay usuarios registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                        <td><?php echo $usuario['esActivo'] ? 'Habilitado' : 'Deshabilitado'; ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id']; ?>">
                                <?php if ($usuario['esActivo']): ?>
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

<?php
include 'conexion_be.php'; // Conexión a la base de datos

// Verificar si se ha proporcionado el ID de usuario
if (!isset($_GET['idUsuario'])) {
    echo 'ID de usuario no especificado.';
    exit();
}

$idUsuario = $_GET['idUsuario'];

// Obtener los detalles del usuario para prellenar el formulario
$sql = "SELECT * FROM usuario WHERE idUsuario = '$idUsuario'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 0) {
    echo 'Usuario no encontrado.';
    exit();
}

$row = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Usuario</h2>
    <form action="actualizar_usuario.php" method="POST">
        <input type="hidden" name="idUsuario" value="<?php echo $row['idUsuario']; ?>">
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" name="usuario" value="<?php echo $row['usuario']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" name="password">
            <small class="form-text text-muted">Deja en blanco si no deseas cambiar la contraseña.</small>
        </div>
        
        <div class="mb-3">
            <label for="idRol" class="form-label">Rol:</label>
            <select name="idRol" class="form-select">
                <option value="1" <?php echo $row['idTipousuario'] == 1 ? 'selected' : ''; ?>>Admin</option>
                <option value="2" <?php echo $row['idTipousuario'] == 2 ? 'selected' : ''; ?>>Usuario</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Actualizar Usuario</button>
    </form>
</div>

<!-- Bootstrap JS (Necesario para algunos componentes) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
mysqli_close($conexion);
?>

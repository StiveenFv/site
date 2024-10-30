
<?php
include 'conexion_be.php';

// Verificar si se ha pasado un idLeccion a través de la URL
if (isset($_GET['idLeccion'])) {
    $idLeccion = $_GET['idLeccion'];

    // Obtener los datos de la lección que se va a editar
    $sql = "SELECT * FROM lecciones WHERE idLeccion = '$idLeccion'";
    $resultado = mysqli_query($conexion, $sql);

    if ($row = mysqli_fetch_assoc($resultado)) {
        $nombreLeccion = $row['nombreLeccion'];
    } else {
        echo 'Lección no encontrada';
        exit();
    }
} else {
    echo 'No se especificó una lección para editar';
    exit();
}

// Si se envía el formulario para editar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreLeccionEditado = $_POST['nombreLeccion'];

    // Actualizar la lección en la base de datos
    $sqlActualizar = "UPDATE lecciones SET nombreLeccion = '$nombreLeccionEditado' WHERE idLeccion = '$idLeccion'";

    if (mysqli_query($conexion, $sqlActualizar)) {
        echo '
        <script>
        alert("Lección actualizada correctamente");
        window.location = "../crud_nivel.php";
        </script>
        ';
    } else {
        echo 'Error al actualizar la lección: ' . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lección</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Lección</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombreLeccion" class="form-label">Nombre de la Lección</label>
                <input type="text" class="form-control" id="nombreLeccion" name="nombreLeccion" value="<?php echo htmlspecialchars($nombreLeccion); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Lección</button>
            <a href="../crud_nivel.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>

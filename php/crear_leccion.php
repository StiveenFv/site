<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombreLeccion = $_POST['nombreLeccion'];

    // Validar que el nombre de la lección no esté vacío
    if (empty($nombreLeccion)) {
        echo '
        <script>
            alert("El nombre de la lección no puede estar vacío");
            window.location = "../crud_lecciones.php"; // Ajusta la ubicación según tu estructura
        </script>
        ';
        exit();
    }

    // Insertar los datos en la base de datos
    $query = "INSERT INTO lecciones (nombreLeccion) VALUES ('$nombreLeccion')";

    if (mysqli_query($conexion, $query)) {
        echo '
        <script>
            alert("Lección registrada exitosamente");
            window.location = "../crud_lecciones.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Error al registrar la lección: ' . mysqli_error($conexion) . '");
            window.location = "../crud_lecciones.php";
        </script>
        ';
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>

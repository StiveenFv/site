<?php
include 'conexion_be.php';

// Verificar si se ha pasado un idLeccion a través de la URL
if (isset($_GET['idLeccion'])) {
    $idLeccion = $_GET['idLeccion'];

    // Eliminar la lección de la base de datos
    $sqlEliminar = "DELETE FROM lecciones WHERE idLeccion = '$idLeccion'";

    if (mysqli_query($conexion, $sqlEliminar)) {
        echo '
        <script>
        alert("Lección eliminada correctamente");
        window.location = "../crud_nivel.php";
        </script>
        ';
    } else {
        echo 'Error al eliminar la lección: ' . mysqli_error($conexion);
    }
} else {
    echo 'No se especificó una lección para eliminar';
    exit();
}
?>

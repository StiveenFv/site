<?php
include 'conexion_be.php';

// Verificar si 'idUsuario' está presente en la URL y es un número entero válido
if (isset($_GET['idUsuario']) && is_numeric($_GET['idUsuario'])) {
    $idUsuario = intval($_GET['idUsuario']); // Convertir a entero para mayor seguridad

    // Preparar la consulta SQL para evitar inyecciones SQL
    $delete_query = "DELETE FROM usuario WHERE idUsuario = $idUsuario";

    if (mysqli_query($conexion, $delete_query)) {
        header('Location: ../crud_admin.php');
        exit();
    } else {
        // Manejar el error si ocurre
        echo "Error al eliminar el usuario: " . mysqli_error($conexion);
    }
} else {
    // Mensaje de error si 'idUsuario' no está presente o no es válido
    echo "ID de usuario no especificado o no válido.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<?php
include 'conexion_be.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idRol = $_POST['idRol'];

    if (!empty($password)) {
        $password = hash('sha512', $password);
        $query = "UPDATE usuario SET nombre='$nombre', usuario='$usuario', email='$email', password='$password', idTipousuario='$idRol' WHERE idUsuario='$idUsuario'";
    } else {
        $query = "UPDATE usuario SET nombre='$nombre', usuario='$usuario', email='$email', idTipousuario='$idRol' WHERE idUsuario='$idUsuario'";
    }

    if (mysqli_query($conexion, $query)) {
        echo '
        <script>
            alert("Usuario actualizado correctamente.");
            window.location = "../crud_admin.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Error al actualizar usuario: ' . mysqli_error($conexion) . '");
            window.location = "../crud_admin.php";
        </script>
        ';
    }

    mysqli_close($conexion);
}
?>

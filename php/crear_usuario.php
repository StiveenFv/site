<?php
include 'conexion_be.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['password'];
    $idRol = $_POST['idRol']; // Asegúrate de que este nombre coincida con el del formulario

    // Encriptar la contraseña
    $contrasena = hash('sha512', $contrasena);

    // Verificar si el email ya está registrado
    $verfi_correo = mysqli_query($conexion, "SELECT * FROM usuario WHERE email='$email'");
    if (mysqli_num_rows($verfi_correo) > 0) {
        echo '
        <script>
            alert("Este correo ya está registrado");
            window.location = "../crud_admin.php";
        </script>
        ';
        exit();
    }

    // Verificar si el usuario ya está registrado
    $verfi_usuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$usuario'");
    if (mysqli_num_rows($verfi_usuario) > 0) {
        echo '
        <script>
            alert("Este usuario ya está registrado");
            window.location = "../crud_admin.php";
        </script>
        ';
        exit();
    }

    // Insertar los datos en la base de datos
    $query = "INSERT INTO usuario (nombre, usuario, email, password, idTipousuario) VALUES ('$nombre', '$usuario', '$email', '$contrasena', '$idRol')";
    if (mysqli_query($conexion, $query)) {
        echo '
        <script>
            alert("Registro exitoso");
            window.location = "../crud_admin.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Error en el registro: ' . mysqli_error($conexion) . '");
            window.location = "../crud_admin.php";
        </script>
        ';
    }

    mysqli_close($conexion);
}
?>

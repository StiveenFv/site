<?php
include 'conexion_be.php'; // Asegúrate de que este archivo existe y se conecta correctamente a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Encriptar la contraseña
    $contrasena = hash('sha512', $contrasena);

    // Verificar si el email ya está registrado
    $verfi_correo = mysqli_query($conexion, "SELECT * FROM usuario WHERE email='$email'");
    if (mysqli_num_rows($verfi_correo) > 0) {
        echo '
        <script>
            alert("Este correo ya está registrado");
            window.location = "../registro.php";
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
            window.location = "../registro.php";
        </script>
        ';
        exit();
    }
    $query = "INSERT INTO usuario (nombre, usuario, email, password, idTipousuario) VALUES ('$nombre', '$usuario', '$email', '$contrasena', 2)";
    if (mysqli_query($conexion, $query)) {
        echo '
        <script>
            alert("Registro exitoso");
            window.location = "../login.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Error en el registro: ' . mysqli_error($conexion) . '");
            window.location = "../registro.php";
        </script>
        ';
    }
}
?>

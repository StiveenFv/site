<?php

session_start();

include 'conexion_be.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

// Consulta para verificar las credenciales del usuario
$validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$usuario' AND password='$contrasena'");

if(mysqli_num_rows($validar_login) > 0){
    $row = mysqli_fetch_array($validar_login);
    $rol = $row['idTipousuario'];
    
    // Almacenar el ID del usuario en la sesión
    $_SESSION['idUsuario'] = $row['idUsuario']; // Asegúrate de que el campo en la base de datos se llame idUsuario
    $_SESSION['usuario'] = $usuario;

    if ($rol == '1') {
        header("Location: ../index_admin.php");
    } else if ($rol == '2') { 
        header("Location: ../index.php");
    }
    exit();
} else {
    echo '
    <script>
    alert("Usuario no existe, por favor verifica los datos");
    window.location = "../login.php";
    </script>
    ';
    exit();
}

mysqli_close($conexion);

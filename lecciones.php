<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo '
    <script>
    alert("Por favor inicie sesión");
    window.location = "login.php";
    </script>
    ';
    session_destroy();
    die();
}
$nombre_usuario = $_SESSION['usuario'];

// Conectar a la base de datos
include('php/conexion_be.php');

// Verificación de conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta de las lecciones
$query = "SELECT * FROM Lecciones";
$result = mysqli_query($conexion, $query);

// Verificación de la consulta
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">

    <title>Lecciones</title>
    <link rel="icon" type="imagenes/dino.jpeg" href="imagenes/dino.jpeg" />
    <style>
        body {
        background-image: url('https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExdnBkbXl0YzNubDFmbDBhMG1vOTNkNXhwcWs5eHRkdHA3M3F2ZXg5NCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3o6ZtcUJcZo4fWotTW/giphy.gif'); /* Ruta local del GIF */
        background-size: cover; /* Asegura que el GIF cubra toda la pantalla */
        background-repeat: no-repeat; /* Evita que el GIF se repita */
        background-attachment: fixed; /* Fija el fondo para que no se desplace con el scroll */
        height: 100vh; 
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
    }
        .contenedor__lecciones {
            background-color: #6A5ACD; /* Fondo morado claro */
            padding: 40px;
            border-radius: 40px;
            margin-top: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contenedor__lecciones img {
            max-width: 15%; /* Ajusta la imagen al contenedor */
            height: auto; /* Mantiene la proporción de la imagen */
            border-radius: 15px; /* Redondear esquinas de la imagen */
        }

        h1 {
            font-size: 3rem; /* Aumenta el tamaño del título */
            margin-bottom: 30px; /* Espaciado debajo del título */
            color: #fff; /* Color del título */
        }

        .btn-leccion {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #F4A460; /* Color de fondo */
            color: black; /* Color del texto */
            font-size: 1.5rem; /* Tamaño de fuente más grande */
            font-weight: bold; /* Texto en negrita */
            text-align: center;
            text-decoration: none; /* Quita el subrayado */
            border-radius: 12px; /* Bordes redondeados */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Transición suave */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Añade sombra a los botones */
        }

        .btn-leccion:hover {
            background-color: #FFD700; /* Fondo más claro al pasar el cursor */
            transform: translateY(-5px); /* Efecto de elevación al pasar el cursor */
        }

        .btn-leccion:active {
            transform: translateY(0px); /* Efecto al hacer clic */
        }

        .btn-leccion:focus {
            outline: none; /* Elimina el borde azul predeterminado en el foco */
            box-shadow: 0px 0px 12px rgba(255, 255, 0, 0.6); /* Resplandor cuando está enfocado */
        }

        /* Flex container to center the buttons */
        .contenedor__lecciones div {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* Espaciado entre los botones */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Asegúrate de incluir SweetAlert -->
</head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12 text-center contenedor__lecciones">
            <img src="imagenes/dino.jpeg" alt="dinoIngles">
                <h1>Lecciones Disponibles</h1>
                <div>
                <?php
                // Iterar sobre los resultados y mostrar las lecciones como botones
                    while ($row = mysqli_fetch_assoc($result)) {
                // Utilizar el nombre de la lección en el enlace
                    echo '<a href="javascript:void(0);" class="btn-leccion" onclick="startGame(\'' . htmlspecialchars($row['nombreLeccion']) . '\')">'; 
                    echo htmlspecialchars($row['nombreLeccion']); // Mostrar el nombre de la lección
                    echo '</a>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main5.js"></script> <!-- Asegúrate de que este archivo existe y está en la carpeta js -->
</body>
</html>

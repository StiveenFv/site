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
include('php/conexion_be.php'); // Asegúrate de que este archivo existe y tiene la configuración correcta

// Verificación de conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta de los niveles
$query = "SELECT * FROM niveles";
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
    <title>Juego de Inglés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="imagenes/dino.jpeg" href="imagenes/dino.jpeg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">

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

        .btn-info {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .level-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .formulario__index button {
            margin-top: 20px;
            width: 100%;
        }

        .contenedor__index {
            background-color: #6A5ACD; /* Fondo morado claro */
            padding: 60px;
            border-radius: 40px;
        }

        .contenedor__index img {
            max-width: 100%; /* Ajusta la imagen al contenedor */
            height: auto; /* Mantiene la proporción de la imagen */
            border-radius: 15px; /* Opcional: redondea las esquinas de la imagen */
        }

        a {
            color: white;
            text-decoration: underline;
        }

        a:hover {
            color: #F4A460; /* Color claro para el enlace al pasar el cursor */
        }

        /* Estilo personalizado para el botón */
        .btn-custom {
            background-color: #FFA500; /* Fondo naranja */
            color: #000; /* Texto negro */
            border: 2px solid #FFA500; /* Borde naranja */
            border-radius: 25px; /* Bordes redondeados */
            padding: 10px 10px; /* Espaciado interno */
            font-size: 23px; /* Tamaño de fuente */
            font-family: 'Nerko One', cursive; /* Fuente personalizada */
            transition: all 0.2s ease; /* Transición suave para efectos */
            width: 100%; /* Ancho completo del contenedor */
            display: block; /* Asegura que el ancho del 100% funcione */
        }

        /* Estilo cuando el botón está en hover */
        .btn-custom:hover {
            background-color: #FFD700; /* Fondo amarillo claro al pasar el cursor */
            border-color: #FFD700; /* Borde amarillo claro */
            color: #000; /* Texto negro */
        }

        /* Estilo cuando el botón está en foco (cuando se hace clic o se selecciona) */
        .btn-custom:focus {
            outline: none; /* Quita el borde de enfoque predeterminado */
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.5); /* Sombra de enfoque */
        }
        
        /* Estilo para el contenedor de los botones */
        .level-buttons {
            display: flex; /* Utiliza Flexbox para alinear los botones */
            flex-direction: column; /* Alinea los botones en una columna */
            gap: 10px; /* Espacio entre los botones */
        }

        .styled-heading {
            font-family: 'Nerko One', cursive; /* Fuente personalizada */
            color: #333; /* Color del texto */
            font-size: 25px; /* Tamaño de fuente */
        }

        /* Estilo personalizado para el botón de ayuda */
        .btn-help-custom {
            background-color: #6A5ACD;
            color: white; 
            border: 2px solid #6A5ACD; 
            border-radius: 50px; /* Bordes redondeados */
            padding: 10px 20px; /* Espaciado interno */
            font-size: 20px; /* Tamaño de fuente */
            transition: background-color 0.3s ease, border-color 0.3s ease; /* Transición suave */
            position: fixed; /* Fija la posición en la esquina inferior derecha */
            bottom: 20px;
            right: 20px;
        }

        /* Estilo cuando el botón está en hover */
        .btn-help-custom:hover {
            background-color: #FFD700; 
            border-color: #FFD700; 
        }

        .btn-help-custom:focus {
            outline: none; /* Quita el borde de enfoque predeterminado */
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2); /* Sombra de enfoque */
        }

    </style>
</head>
<body>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-5 text-center contenedor__index">
                <br><br><br><br><br><br><br>
                <img src="imagenes/dino.jpeg" alt="dinoIngles">
                <br>
                <p class="styled-heading">Welcome, <?php echo htmlspecialchars($nombre_usuario); ?>!</p>
                <h1 style="font-family: 'Nerko One', cursive; color: #333; font-size: 50px;">Games</h1>
                <div class="level-buttons mt-3">
                    <?php
                    // Mostrar los niveles como botones dinámicamente
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<button type="submit" class="btn btn-custom" onclick="startGame(\'' . $row['dificultad'] . '\')">';
                        echo htmlspecialchars($row['nombreNivel']);
                        echo '</button>';
                    }
                    ?>
                    <button type="submit" class="btn btn-custom" onclick="startGame('lecciones')">Ir al menú de lecciones</button>
                </div>
                <br>
                <nav>
                    <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
                </nav>
            </div>
            <div class="col-md-4">
                <button class="btn-help-custom" onclick="showHelp()">
                    <i class="bi bi-question-circle"></i>
                </button>
            </div>
        </div>
    </div>

    <script src="js/main1.js"></script>
</body>
</html>

<?php
session_start();

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

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="icon" type="imagenes/dino.jpeg" href="imagenes/dino.jpeg" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            background-color: #000;
            font-family: 'Nerko One', cursive; /* Fuente personalizada */
            padding-top: 60px;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #6A5ACD;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Estilo personalizado para el botón */
        .btn-custom {
            background-color: #6A5ACD;
            color: #000; /* Texto negro */
            border: 2px solid #6A5ACD; /* Borde naranja */
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

        
    </style>
</head>
<body>

    <!-- Barra Lateral -->
    <div class="sidebar">
        <h4>Menú Administrativo</h4>
        <a href="crud_usuario.php">Gestión Usuarios</a>
        <a href="crud_nivel.php">Gestión Niveles</a>
        <a href="crud_lecciones.php">Gestión Lecciones</a>
    </div>

    <!-- Botón de cerrar sesión -->
    <form action="php/cerrar_sesion.php" method="POST" class="logout-btn">
        <button type="submit" class="btn btn-custom">Cerrar sesión</button>
    </form>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container-fluid">
            <h1 style="font-family: 'Nerko One', cursive; color: #333; font-size: 30px;">Bienvenido al Panel de Administración</h1>
            <p style="font-family: 'Nerko One', cursive; color: #333; font-size: 25px;">Utiliza el menú a la izquierda para gestionar los usuarios y los niveles del juego.</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
session_start();
// Asegúrate de que el usuario esté autenticado antes de acceder a esta página
if (!isset($_SESSION['idUsuario'])) {
    header('Location: login.php'); // Redirigir si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz de Inglés</title>
    <link rel="icon" type="imagenes/dino.jpeg" href="imagenes/dino.jpeg" />
    <!-- Enlaza Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">

    <style>

body {
    background-image: url('https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExdnBkbXl0YzNubDFmbDBhMG1vOTNkNXhwcWs5eHRkdHA3M3F2ZXg5NCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3o6ZtcUJcZo4fWotTW/giphy.gif'); /* URL directa del GIF */
    background-size: cover; /* Asegura que el GIF cubra toda la pantalla */
    background-repeat: no-repeat; /* Evita que el GIF se repita */
    background-attachment: fixed; /* Fija el fondo para que no se desplace con el scroll */
    font-family: 'Nerko One', cursive; /* Fuente personalizada */
    height: 100vh;
    margin: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center; /* Centra el texto de los encabezados */
}


        .container {
            background-color: #6A5ACD; /* Fondo morado para el contenido */
            color: white; /* Color de texto para mejorar la legibilidad */
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra suave */
            max-width: 600px; /* Ancho máximo del contenedor */
            width: 100%; /* Para que sea responsive */
        }

        /* Ajustes para centrar y redimensionar la imagen */
        #question-container img,
        #result-container img {
            max-width: 150px; /* Ajusta la imagen a un tamaño fijo */
            height: auto; /* Mantiene la proporción de la imagen */
            border-radius: 15px; /* Redondear esquinas de la imagen */
            display: block; /* Para asegurarse que la imagen actúe como un bloque */
            margin: 0 auto 20px; /* Centra la imagen y agrega margen inferior */
        }

        h1 {
            font-size: 3rem; /* Aumenta el tamaño del título */
            margin-bottom: 30px; /* Espaciado debajo del título */
            color: white; /* Color del título */
        }

        #question-container {
            margin-bottom: 20px;
        }

        #question {
            font-size: 1.5rem;
            font-weight: bold;
            color: white; /* Color de la pregunta */
            margin-bottom: 15px; /* Espacio entre la pregunta y las opciones */
            font-family: 'Nerko One', cursive; /* Aplicar fuente a las preguntas */
        }

        .btn-group-vertical .btn {
            margin-bottom: 20px; /* Espacio entre los botones de respuesta */
            background-color: #F4A460;
            color: black; /* Color del texto */
            border: black; /* Sin bordes para un diseño limpio */
            padding: 15px 25px; /* Relleno interno para hacer los botones más grandes */
            font-size: 1.2rem; /* Tamaño de texto más grande */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Transición suave en el hover */
            border-radius: 10px; /* Bordes redondeados */
            width: 150px;
            font-family: 'Nerko One', cursive; /* Aplicar fuente a los botones de respuesta */
        }

        /* para elevar el botón al pasar el cursor */
        .btn-group-vertical .btn:hover {
            background-color: #FFD700; /* Color amarillo al pasar el ratón */
            transform: translateY(-5px); /* Efecto de elevación al pasar el cursor */
        }

        #next-button, #finish-button {
            background-color: #F4A460; /* Color del botón de siguiente/finalizar */
            border: none; /* Sin bordes */
            color: #333; /* Color del texto */
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 10px; /* Bordes redondeados */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            display: block; /* Para que se alineen de manera responsiva */
            margin: 0 auto; /* Centrarlos horizontalmente */
            margin-top: 20px; /* Espacio superior para separar de las respuestas */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Añade sombra */
            font-family: 'Nerko One', cursive; /* Aplicar fuente a los resultados */
        }

        #next-button:hover, #finish-button:hover {
            background-color: #FFD700; /* Color amarillo en hover */
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3); /* Sombra más intensa en hover */
        }

        #result-container {
            margin-top: 60px;
            background-color: #F4A460; /* Fondo para los resultados */
            color: white;
            padding: 50px;
            border-radius: 10px; /* Bordes redondeados */
            display: none; /* Ocultar inicialmente */
        }

        #result {
            font-size: 1.5rem; /* Tamaño de texto grande para los resultados */
            font-family: 'Nerko One', cursive; /* Aplicar fuente a los resultados */
        }
    </style>
</head>
<body>
<div class="container text-center" style="margin-top: 120px;">
    <div id="question-container" class="col-md-12 text-center">
        <img src="imagenes/dino.jpeg" alt="dinoIngles"/>

        <h1 class="text-center">Quiz de Inglés</h1>

        <div id="question-container">
            <div id="question" class="mb-3"></div>
            <div id="answer-buttons" class="btn-group-vertical mb-3"></div>
            <button id="next-button" class="btn btn-custom" style="display:none;">Siguiente</button>
            <button id="finish-button" class="btn btn-custom" style="display:none;">Finalizar</button>
        </div>
    </div>

    <!-- Mueve el contenedor de resultados fuera del question-container -->
    <div id="result-container" style="display:none;"> <!-- Oculto inicialmente -->
    <img src="imagenes/dino.jpeg" alt="dinoIngles"/>

        <h2>Resultados</h2>
        <p id="result"></p>
    </div>
</div>


    <!-- Definir el ID del usuario en JavaScript -->
    <script>
        const idUsuario = <?php echo json_encode($_SESSION['idUsuario']); ?>;
    </script>

    <!-- Enlazar el archivo JavaScript externo -->
    <script src="js/quiz2.js"></script>
    <!-- Enlazar Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
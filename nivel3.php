<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Significado Ingles - Nivel 3</title>
    <link rel="icon" type="imagenes/dino.jpeg" href="imagenes/dino.jpeg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .formulario__tercerjuego button {
            margin-top: 10px;
            width: 100%;
        }

        .contenedor__tercerjuego {
            background-color: #6A5ACD; /* Fondo morado claro */
            padding: 40px;
            border-radius: 40px;
            margin-top: 20px;
        }
        .contenedor__tercerjuego img {
            max-width: 15%; /* Ajusta la imagen al contenedor */
            height: auto; /* Mantiene la proporción de la imagen */
            border-radius: 15px; /* Opcional: redondea las esquinas de la imagen */
        }
        .contenedor__tercerjuego {
            position: relative;
            padding-top: -30px; /* Ajusta el valor según sea necesario */
        }

        .styled-heading {
            font-family: 'Nerko One', cursive; /* Fuente personalizada */
            color: #333; /* Color del texto */
            font-size: 25px; /* Tamaño de fuente */
        }

        .formulario__tercerjuego input {
            background: #F4A460; /* Elimina cualquier fondo aplicado */
            border: 1px solid #000; /* Define un borde gris claro */
            border-radius: 50px; /* Bordes redondeados */
            color: #000; /* Color del texto */
            padding: 20px; /* Espaciado interno */
        }
        .formulario__tercerjuego input:focus {
            border-color: #6A5ACD; /* Borde morado claro cuando está en foco */
            outline: none; /* Elimina el borde de enfoque predeterminado del navegador */
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
            width: 30%; /* Ancho completo del contenedor */
            display: block; /* Asegura que el ancho del 100% funcione */
            margin: 0 auto; /* Centrando horizontalmente */
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
        
        

        #wordDisplay {
            font-size: 2rem;
            letter-spacing: 0.5rem; /* Espacio entre letras */
        }

        #attemptsDisplay {
            font-size: 1.5rem;
        }
        /* Estilo para centrar y ajustar el tamaño de los botones */
.option-button {
    margin: 10px auto; /* Margen arriba y abajo, centrado horizontalmente */
    padding: 8px 15px; /* Ajusta el tamaño del botón para hacerlo más pequeño */
    width: 60%; /* Ancho reducido */
    display: block; /* Asegura que el margen auto funcione para centrar */
    font-size: 1rem; /* Ajusta el tamaño de la fuente para hacer el botón más compacto */
}


    </style>
</head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col md-12 contenedor__tercerjuego">
            <img src="imagenes/dino.jpeg" alt="dinoIngles">

                <h1 style="font-family: 'Nerko One', cursive; color: #333; font-size: 50px;">Adivina Cómo se dice esta palabra en inglés</h1>
                <div id="game">
                    <p id="wordDisplay">Cargando palabra...</p>
                    <p id="attemptsDisplay" class="styled-heading">Intentos restantes: 5</p>
                    <div id="options" class="mt-3">
                    <!-- Opciones de traducción -->
                    </div>
                    <button id="exitButton" class="btn btn-custom mt-3">Volver</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main4.js"></script>
</body>
</html>

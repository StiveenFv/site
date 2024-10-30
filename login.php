<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Iniciar Sesión</title>
    <link rel="icon" type="imagenes/dino.jpeg" href="imagenes/dino.jpeg" />

    <meta name='viewport' content='width=device-width, initial-scale=1'>
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
        .formulario__login button {
            margin-top: 20px;
            width: 100%;
        }
        .contenedor__login-register {
            background-color: #6A5ACD; /* Fondo morado claro */
            padding: 60px;
            border-radius: 40px;
        }
        .contenedor__login-register img {
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
        .formulario__login input {
            background: #F4A460; /* Elimina cualquier fondo aplicado */
            border: 1px solid #000; /* Define un borde gris claro */
            border-radius: 50px; /* Bordes redondeados */
            color: #000; /* Color del texto */
            padding: 20px; /* Espaciado interno */
        }
        .formulario__login input:focus {
            border-color: #6A5ACD; /* Borde morado claro cuando está en foco */
            outline: none; /* Elimina el borde de enfoque predeterminado del navegador */
        }
        .formulario__login input {
            background-color: #F4A460; /* Fondo naranja claro */
            color: #000; /* Texto negro */
            border: 1px solid #000; /* Borde gris claro para mayor visibilidad */
            border-radius: 50px; /* Bordes redondeados */
            padding: 10px; /* Espaciado interno */
            font-size: 10px; /* Tamaño de fuente */
        }
        .formulario__login input:focus {
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-5 text-center">
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                        <img src="imagenes/dino.jpeg" alt="dinoIngles">
                        <br>
                        <h1 style="font-family: 'Nerko One', cursive; color: #333; font-size: 50px;">LinguiPro</h1>
                        <h3 style="font-family: 'Nerko One', cursive; color: #333; font-size: 20px; color: white;">Iniciar Sesión</h3>
                        <input class="mt-3 form-control email;" id="txt_Email" type="text" placeholder="Usuario" name="usuario">
                        <input class="mt-3 form-control contrasena" id="txt_Contrasena" type="password" placeholder="Contraseña" name="contrasena">
                        <br>
                        <button type="submit" class="btn btn-custom mt-2">Entrar</button>
                    </form>
                    <br> 
                    <a href="registro.php" >¿No estás Registrado?</a>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>

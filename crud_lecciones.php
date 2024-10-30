<?php
include 'php/conexion_be.php';

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consultar las lecciones
$sql = "SELECT * FROM lecciones";
$resultado = mysqli_query($conexion, $sql);

// Consultar resultados de usuario en las lecciones
$sql2 = "SELECT ul.idUsuario, ul.idLeccion, ul.fechaRealizacion, ul.puntuacionObtenida, ul.aprobada, u.email 
         FROM usuarioleccion ul
         JOIN usuario u ON ul.idUsuario = u.idUsuario";
$resultado2 = mysqli_query($conexion, $sql2);

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestión de Lecciones</title>
    <link rel="icon" type="imagenes/dino.jpeg" href="imagenes/dino.jpeg" />
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">


    <style>
        
       body {
            background-color: #F4A460; 
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
            border-radius: 20px; /* Bordes redondeados */
            padding: 10px 10px; /* Espaciado interno */
            font-size: 20px; /* Tamaño de fuente */
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
            gap: 5px; /* Espacio entre los botones */
        }

        .styled-heading {
            font-family: 'Nerko One', cursive; /* Fuente personalizada */
            color: #333; /* Color del texto */
            font-size: 20px; /* Tamaño de fuente */
        }

        .custom-label {
            font-family: 'Nerko One', cursive;
            color: black;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Menu Administrativo</h4>
        <a href="index_admin.php">Inicio</a>
        <a href="crud_usuario.php">Gestión Usuarios</a>
        <a href="crud_nivel.php">Gestión Niveles</a>
    </div>

    <div class="content">
        <form action="php/cerrar_sesion.php" method="POST" class="logout-btn">
            <button type="submit" class="btn btn-custom">Cerrar sesión</button>
        </form>

        <div class="main-content">
    <div class="container mt-5">
        <h2 style="font-family: 'Nerko One', cursive; color: #333; font-size: 50px;">Gestión de Lecciones</h2>

        <!-- Botón para abrir el modal de Crear Lección -->
        <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#crearLeccionModal">Crear Nueva Lección</button>
        <br>

        <!-- Botones para listar lecciones -->
        <button class="btn btn-custom" onclick="mostrarLecciones()">Listar lecciones</button>
        <br>
        <!-- Botones para listar aprobados o no aprobados -->
        <button class="btn btn-custom" onclick="mostrarAprobados()">Listar Aprobados</button>
        <br>
        <button class="btn btn-custom" onclick="mostrarNoAprobados()">Listar No Aprobados</button>

        <div id="tablaLecciones" style="display:none; font-family: 'Nerko One', cursive; color: #333; font-size: 15px;">
            <h2>Lecciones</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Lección</th>
                        <th>Nombre Lección</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $row['idLeccion']; ?></td>
                        <td><?php echo $row['nombreLeccion']; ?></td>
                        <td>
                        <a href="php/editar_leccion.php?idLeccion=<?php echo htmlspecialchars($row['idLeccion']); ?>" class="btn btn-custom">Editar</a>
                        <br>
                        <a href="php/eliminar_leccion.php?idLeccion=<?php echo htmlspecialchars($row['idLeccion']); ?>" class="btn btn-custom" onclick="return confirm('¿Estás seguro de eliminar este nivel?')">Eliminar</a>
                        <br>
                    </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div id="tablaResultados" style="display:none;">
            <h2>Resultados</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Correo</th>
                        <th>ID Lección</th>
                        <th>Fecha Realización</th>
                        <th>Puntuación Obtenida</th>
                        <th>Aprobada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row2 = mysqli_fetch_assoc($resultado2)) { ?>
                    <tr>
                        <td><?php echo $row2['idUsuario']; ?></td>
                        <td><?php echo $row2['email']; ?></td>
                        <td><?php echo $row2['idLeccion']; ?></td>
                        <td><?php echo $row2['fechaRealizacion']; ?></td>
                        <td><?php echo $row2['puntuacionObtenida']; ?></td>
                        <td><?php echo ($row2['aprobada'] == 1) ? 'Sí' : 'No'; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Crear Lección -->
    <div class="modal fade" id="crearLeccionModal" tabindex="-1" aria-labelledby="crearLeccionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearLeccionModalLabel"style="font-family: 'Nerko One', cursive; color: #333; font-size: 50px;">Crear Nueva Lección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="php/crear_leccion.php" method="POST">
                        <div class="mb-3">
                            <label for="nombreLeccion" class="custom-label">Nombre de la Lección</label>
                            <input type="text" class="form-control" id="nombreLeccion" name="nombreLeccion" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Agregar Lección</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarLecciones() {
            document.getElementById('tablaLecciones').style.display = 'block';
            document.getElementById('tablaResultados').style.display = 'none';
        }

        function mostrarAprobados() {
            let rows = document.querySelectorAll('#tablaResultados tbody tr');
            rows.forEach(row => {
                let aprobada = row.querySelector('td:nth-child(6)').innerText.trim(); // Columna de Aprobada
                if (aprobada === 'Sí') {
                    row.style.display = ''; // Mostrar
                } else {
                    row.style.display = 'none'; // Ocultar
                }
            });
            document.getElementById('tablaLecciones').style.display = 'none';
            document.getElementById('tablaResultados').style.display = 'block';
        }

        function mostrarNoAprobados() {
            let rows = document.querySelectorAll('#tablaResultados tbody tr');
            rows.forEach(row => {
                let aprobada = row.querySelector('td:nth-child(6)').innerText.trim(); // Columna de Aprobada
                if (aprobada === 'No') {
                    row.style.display = ''; // Mostrar
                } else {
                    row.style.display = 'none'; // Ocultar
                }
            });
            document.getElementById('tablaLecciones').style.display = 'none';
            document.getElementById('tablaResultados').style.display = 'block';
        }
    </script>
</body>
</html>

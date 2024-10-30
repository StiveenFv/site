<?php
include 'php/conexion_be.php'; // Asegúrate de que este archivo existe y tiene la configuración correcta

// Verificación de conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$sql = "SELECT * FROM niveles";
$resultado = mysqli_query($conexion, $sql); 

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
    <title>CRUD Niveles</title>
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

<!-- Barra lateral -->
<div class="sidebar">
    <h4>Menú Administrativo</h4>
    <a href="index_admin.php">Inicio</a>
    <a href="crud_usuario.php">Gestión Usuarios</a>
    <a href="crud_lecciones.php">Gestión Lecciones</a>
</div>

<!-- Contenido principal -->
<div class="content">
    <!-- Botón de cerrar sesión -->
    <form action="php/cerrar_sesion.php" method="POST" class="logout-btn">
        <button type="submit" class="btn btn-custom">Cerrar sesión</button>
    </form>

    <h1 style="font-family: 'Nerko One', cursive; color: #333; font-size: 50px;">Gestión de Niveles</h1>

    <!-- Botón para abrir la ventana modal para crear nuevo nivel -->
    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#crearNivelModal">
        Crear Nuevo Nivel
    </button>
        <br>
    <!-- Botón para listar niveles -->
    <button type="button" class="btn btn-custom" id="listarNivelesBtn">
        Listar Niveles
    </button>

    <!-- Tabla para listar los niveles, inicialmente oculta -->
    <div class="mt-3" id="listarNiveles" style="display: none; font-family: 'Nerko One', cursive; color: #333; font-size: 15px;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Nivel</th>
                    <th>Dificultad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irán los datos dinámicos de los niveles -->
                <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['idNivel']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombreNivel']); ?></td>
                    <td><?php echo htmlspecialchars($row['dificultad']); ?></td>
                    <td>
                        <a href="php/editar_nivel.php?idNivel=<?php echo htmlspecialchars($row['idNivel']); ?>" class="btn btn-custom">Editar</a>
                        <br>
                        <a href="php/eliminar_nivel.php?idNivel=<?php echo htmlspecialchars($row['idNivel']); ?>" class="btn btn-custom" onclick="return confirm('¿Estás seguro de eliminar este nivel?')">Eliminar</a>
                        <br>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para crear nivel -->
<div class="modal fade" id="crearNivelModal" tabindex="-1" aria-labelledby="crearNivelModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearNivelModalLabel" style="font-family: 'Nerko One', cursive; color: #333; font-size: 30px;">Crear Nuevo Nivel</h5>
                <button type="button" class="btn-custom" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para crear nuevo nivel -->
                <form action="php/crear_nivel.php" method="POST">
                    <div class="mb-3">
                        <label for="nombreNivel" class="custom-label">Nombre Nivel:</label>
                        <input type="text" class="form-control" name="nombreNivel" required>
                    </div>
                    <div class="mb-3">
                        <label for="dificultad" class="custom-label">Dificultad:</label>
                        <select name="dificultad" class="form-select" required>
                            <option value="Fácil">Fácil</option>
                            <option value="Medio">Medio</option>
                            <option value="Difícil">Difícil</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-custom">Crear Nivel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Necesario para el modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript para mostrar/ocultar la lista de niveles -->
<script>
    document.getElementById('listarNivelesBtn').addEventListener('click', function() {
        var listarNiveles = document.getElementById('listarNiveles');
        if (listarNiveles.style.display === 'none') {
            listarNiveles.style.display = 'block';
        } else {
            listarNiveles.style.display = 'none';
        }
    });
</script>

</body>
</html>

<?php
include 'conexion_be.php'; // Asegúrate de que este archivo tiene la configuración correcta de conexión

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $idNivel = $_POST['idNivel'];
    $nombreNivel = $_POST['nombreNivel'];
    $dificultad = $_POST['dificultad'];

    // Validar los datos (esto es solo un ejemplo, puedes hacer validaciones adicionales)
    if (empty($idNivel) || empty($nombreNivel) || empty($dificultad)) {
        echo '
        <script>
        alert("Todos los campos son requeridos.");
        window.history.back();
        </script>
        ';
        exit();
    }

    // Actualizar el nivel en la base de datos
    $sql = "UPDATE niveles SET nombreNivel=?, dificultad=? WHERE idNivel=?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssi', $nombreNivel, $dificultad, $idNivel);
        if (mysqli_stmt_execute($stmt)) {
            echo '
            <script>
            alert("Nivel actualizado exitosamente.");
            window.location = "../crud_nivel.php";
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Error al actualizar el nivel.");
            window.history.back();
            </script>
            ';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '
        <script>
        alert("Error en la preparación de la consulta.");
        window.history.back();
        </script>
        ';
    }

    mysqli_close($conexion);
} else {
    echo '
    <script>
    alert("Método de solicitud no válido.");
    window.history.back();
    </script>
    ';
}
?>

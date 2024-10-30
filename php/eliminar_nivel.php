<?php
include 'conexion_be.php';

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

if (isset($_GET['idNivel'])) {
    $idNivel = $_GET['idNivel'];

    // Preparar la consulta para eliminar el nivel
    $sql = "DELETE FROM niveles WHERE idNivel = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idNivel);

    if ($stmt->execute()) {
        echo '
        <script>
        alert("Nivel eliminado correctamente");
        window.location = "../crud_nivel.php";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Error al eliminar el nivel");
        window.location = "../crud_nivel.php";
        </script>
        ';
    }

    $stmt->close();
} else {
    echo '
    <script>
    alert("ID de nivel no recibido");
    window.location = "../crud_nivel.php";
    </script>
    ';
}

$conexion->close();
?>

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

$idNivel = $_GET['idNivel'];
$sql = "SELECT * FROM niveles WHERE idNivel = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idNivel);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Nivel no encontrado.";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nivel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Nivel</h2>
    <form action="actualizar_nivel.php" method="POST">
        <input type="hidden" name="idNivel" value="<?php echo htmlspecialchars($row['idNivel']); ?>">
        
        <div class="mb-3">
            <label for="nombreNivel" class="form-label">Nombre Nivel:</label>
            <input type="text" class="form-control" name="nombreNivel" value="<?php echo htmlspecialchars($row['nombreNivel']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="dificultad" class="form-label">Dificultad:</label>
            <select name="dificultad" class="form-select" required>
                <option value="Fácil" <?php echo $row['dificultad'] == 'Fácil' ? 'selected' : ''; ?>>Fácil</option>
                <option value="Medio" <?php echo $row['dificultad'] == 'Medio' ? 'selected' : ''; ?>>Medio</option>
                <option value="Difícil" <?php echo $row['dificultad'] == 'Difícil' ? 'selected' : ''; ?>>Difícil</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Actualizar Nivel</button>
    </form>
</div>

<!-- Bootstrap JS (Necesario para algunos componentes) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>

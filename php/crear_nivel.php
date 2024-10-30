<?php
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreNivel = $_POST['nombreNivel'];
    $dificultad = $_POST['dificultad'];

    $verifi_nombre = mysqli_query($conexion,"SELECT * FROM niveles where nombreNivel='$nombreNivel'");
    if (mysqli_num_rows($verifi_nombre) > 0) {
        echo '
        <script>
            alert("Este nombre del Nivel ya esta registrado);
            window.location = "../crud_nivel.php";
        </script>
        ';
        exit(); 
    }

    $query = "INSERT INTO niveles(nombreNivel,dificultad) VALUES ('$nombreNivel','$dificultad')";
    if (mysqli_query($conexion,$query)) {
        echo '
        <script>
            alert("Registro exitoso");
            window.location = "../crud_nivel.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Error en el registro: ' . mysqli_error($conexion) . '");
            window.location = "../crud_nivel.php";
        </script>
        ';
    }
    mysqli_close($conexion);
}

?>

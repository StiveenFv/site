<?php
session_start();
include 'conexion_be.php';

$data = json_decode(file_get_contents("php://input"), true);
$idUsuario = $data['idUsuario'];
$idLeccion = $data['idLeccion'];
$puntuacion = $data['resultado'];
$fecha = date("Y-m-d H:i:s");

// Verificar si ya existe un registro con el mismo idUsuario y idLeccion
$query = "SELECT * FROM usuarioleccion WHERE idUsuario = ? AND idLeccion = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $idUsuario, $idLeccion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Registro existe, puedes actualizarlo o enviar un mensaje de error
    echo json_encode(["success" => false, "message" => "Ya existe un resultado para esta lección."]);
} else {
    // Insertar nuevo registro
    $insert_query = "INSERT INTO usuarioleccion (idUsuario, idLeccion, fechaRealizacion, puntuacionObtenida, aprobada) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conexion->prepare($insert_query);
    $aprobada = $puntuacion >= 5? 1 : 0;
    $stmt_insert->bind_param("iissi", $idUsuario, $idLeccion, $fecha, $puntuacion, $aprobada);

    if ($stmt_insert->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al insertar el resultado."]);
    }
}

$stmt->close();
$stmt_insert->close();
$conexion->close();
?>

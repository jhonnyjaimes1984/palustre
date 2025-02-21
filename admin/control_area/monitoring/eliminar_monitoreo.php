<?php
include_once "../../../conf/Config.php";

// Habilitar CORS (si es necesario)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Obtener el valor de `id_monitoring` desde la solicitud
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['id_monitoring'])) {
    $id_monitoring = $data['id_monitoring'];

    // Ejecutar la consulta DELETE
    try {
        $sentencia = $base_de_datos->prepare("DELETE FROM monitoring WHERE id_monitoring = :id_monitoring");
        $sentencia->bindParam(':id_monitoring', $id_monitoring, PDO::PARAM_INT);
        $sentencia->execute();

        // No se envía una respuesta, ya que sendBeacon no la puede recibir
    } catch (PDOException $e) {
        // No se envía una respuesta, ya que sendBeacon no la puede recibir
    }
} else {
    // No se envía una respuesta, ya que sendBeacon no la puede recibir
}
?>
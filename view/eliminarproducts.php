<?php
require '../model/configuracion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$db = new Conexion();
$con = $db->conectar();

$comm = $con->prepare("CALL EliminarProducto(:id)");

$resul = $comm->execute(['id' => $id]);

if ($resul) {
    header("Location: products.php");
    exit();
} else {
    echo "Error al eliminar registro";
}
?>
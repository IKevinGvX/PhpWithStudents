<?php
require '../model/configuracion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$db = new Conexion();
$con = $db->conectar();

$comm = $con->prepare("CALL EliminarLibro(:id)");

$resul = $comm->execute(['id' => $id]);

if ($resul) {
    header("Location: books.php");
    exit();
} else {
    echo "Error al eliminar registro";
}
?>
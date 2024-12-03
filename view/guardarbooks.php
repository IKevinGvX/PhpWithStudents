<?php
require '../model/configuracion.php';
$db = new Conexion();
$con = $db->conectar();
$isox = false;
$titulo = $_POST['titulo'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$query = $con->prepare(" call InsertarLibro(:titulo,:cantidad,:precio)");
$result = $query->execute([
    'titulo' => $titulo,
    'cantidad' => $cantidad,
    'precio' => $precio,
]);
if ($result) {
    $isox = true;
}
?>
<html>

<head>
</head>

<body>
    <?php
    if ($isox) {
        ?>
        <h1> Congratulations, Books Send Successfull</h1>
        <a href="books.php">List Books</a>
        <?php
    } else {
        ?>
        <h1>Falla en el registro de notas</h1>
        <?php
    }
    ?>
</body>

</html>
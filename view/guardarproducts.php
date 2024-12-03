<?php
require '../model/configuracion.php';
$db = new Conexion();
$con = $db->conectar();
$isox = false;
$descripcion = $_POST['descripcion'];
$codigo = $_POST['codigo'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$query = $con->prepare(" call InsertarProducto(:descripcion,:codigo,:cantidad,:precio)");
$result = $query->execute([
    'descripcion' => $descripcion,
    'codigo' => $codigo,
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
        <h1> Congratulations, products Send Successfull</h1>
        <a href="products.php">List products</a>
        <?php
    } else {
        ?>
        <h1>Falla en el registro de notas</h1>
        <?php
    }
    ?>
</body>

</html>
<?php
require '../model/configuracion.php';
$db = new Conexion();
$con = $db->conectar();
$isox = false;
$alumno = $_POST['alumno'];
$nota1 = $_POST['nota1'];
$nota2 = $_POST['nota2'];
$nota3 = $_POST['nota3'];
$nota4 = $_POST['nota4'];
$query = $con->prepare(" call InsertarNota(:alumno,:nota1,:nota2,:nota3,:nota4)");
$result = $query->execute([
    'alumno' => $alumno,
    'nota1' => $nota1,
    'nota2' => $nota2,
    'nota3' => $nota3,
    'nota4' => $nota4
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
        <h1> Congratulations, Notas Existoso</h1>
        <a href="../index.php">Lista Alumnos</a>
        <?php
    } else {
        ?>
        <h1>Falla en el registro de notas</h1>
        <?php
    }
    ?>
</body>

</html>
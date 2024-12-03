<?php
require 'model/configuracion.php';

// Conexión a la base de datos
$db = new Conexion();
$con = $db->conectar();

if ($con) {
    $comm = $con->prepare("CALL ListarNotas();");  // Llamamos al procedimiento almacenado
    $comm->execute();
    $result = $comm->fetchAll(PDO::FETCH_ASSOC);  // Obtenemos los resultados
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: url('img.webp') no-repeat center center fixed;
            la imagen sea correcta */ background-size: cover;
            margin: 0;
            color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            padding: 20px;
            max-width: 900px;
            width: 100%;
            margin-top: 50px;
        }

        h1 {
            color: #ff4500;
            text-align: center;
            text-shadow: 0 0 20px #ff4500;
        }

        .table {
            border: 1px solid #ff4500;
        }

        .table thead {
            background: rgba(50, 0, 0, 0.8);
            color: #ff4500;
            text-shadow: 0 0 10px #ff4500;
        }

        .btn-primary {
            background-color: #ff6b6b;
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            background-color: #cc5252;
            transform: scale(1.05);
            box-shadow: 0 0 10px #ff6b6b;
        }

        .btn-warning {
            background-color: #ffa500;
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-warning:hover {
            background-color: #cc8400;
            transform: scale(1.05);
            box-shadow: 0 0 10px #ffa500;
        }

        .btn-danger {
            background-color: #ff4c4c;
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-danger:hover {
            background-color: #cc0000;
            transform: scale(1.05);
            box-shadow: 0 0 10px #ff4c4c;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>List Students</h1>

        <!-- Botón para nuevo registro -->
        <div class="mb-3">
            <a href="view/nuevo.php" class="btn btn-primary">New Student</a>
            <a href="view/books.php" class="btn btn-primary">View Books</a>
            <a href="view/products.php" class="btn btn-primary">View Products</a>

        </div>

        <!-- Tabla de notas -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Nota 3</th>
                    <th>Nota 4</th>
                    <th>Promedio Final</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Alumno']); ?></td>
                        <td><?php echo htmlspecialchars($row['nota1']); ?></td>
                        <td><?php echo htmlspecialchars($row['nota2']); ?></td>
                        <td><?php echo htmlspecialchars($row['nota3']); ?></td>
                        <td><?php echo htmlspecialchars($row['nota4']); ?></td>
                        <td><?php echo number_format($row['Promedio'], 2); ?></td>
                        <td>
                            <!-- Botones de acción para editar y eliminar -->
                            <a href="view/edit.php?id=<?php echo $row['Id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="view/eliminar.php?id=<?php echo $row['Id']; ?>"
                                onclick="return confirm('¿Está seguro de eliminar este registro?');"
                                class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
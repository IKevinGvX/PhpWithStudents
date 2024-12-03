<?php
require '../model/configuracion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $codigo = $_POST['codigo'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    if (
        is_numeric($cantidad) && $cantidad >= 0 && $cantidad <= 100
    ) {
        $db = new Conexion();
        $con = $db->conectar();

        $stmt = $con->prepare("CALL ActualizarProducto(:id, :descripcion, :codigo,:cantidad,:precio )");
        $stmt->execute([
            ':id' => $id,
            ':descripcion' => $descripcion,
            ':codigo' => $codigo,
            ':cantidad' => $cantidad,
            ':precio' => $cantidad
        ]);

        header("Location: products.php");
        exit();
    } else {
        echo "Por favor, ingrese Cantidad maximas válidas entre 0 y 20.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Conexion();
    $con = $db->conectar();

    $stmt = $con->prepare("SELECT id_producto, descripcion, codigo, cantidad, precio,total FROM Productos WHERE id_producto = :id_producto");
    $stmt->execute([':id_producto' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Notas</title>
    <style>
        /* Diseño general */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            background: linear-gradient(45deg, #ff9a9e, #fad0c4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: glow 3s infinite alternate;
        }

        @keyframes glow {
            0% {
                text-shadow: 0 0 10px #ff9a9e, 0 0 20px #ff6a88, 0 0 30px #ff99b8;
            }

            100% {
                text-shadow: 0 0 20px #ff99b8, 0 0 30px #ff5e9e, 0 0 40px #ff759c;
            }
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            font-size: 1rem;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }

        button {
            width: 100%;
            padding: 10px 15px;
            background: linear-gradient(90deg, #ff758c, #ff7eb3);
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            background: linear-gradient(90deg, #ff5e9e, #ff9a9e);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Books </h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_producto']); ?>">

            <div>
                <label for="Descriptions">Descriptions </label>
                <input type="text" id="descripcion" name="descripcion"
                    value="<?php echo htmlspecialchars($row['descripcion']); ?>" required>
            </div>

            <div>
                <label for="Codigo">Codigo</label>
                <input type="text" id="codigo" name="codigo" value="<?php echo htmlspecialchars($row['codigo']); ?>"
                    required>
            </div>
            <div>
                <label for="Cantidad">
                    Cantidad</label>
                <input type="number" id="cantidad" name="cantidad"
                    value="<?php echo htmlspecialchars($row['cantidad']); ?>" step="0.01" min="0" max="20" required>
            </div>

            <div>
                <label for="Precio">Precio</label>
                <input type="text" id="precio" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>"
                    step="0.01" min="0" max="20" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>
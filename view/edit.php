<?php
require '../model/configuracion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $alumno = $_POST['alumno'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];
    $nota4 = $_POST['nota4'];

    if (
        is_numeric($nota1) && $nota1 >= 0 && $nota1 <= 20 &&
        is_numeric($nota2) && $nota2 >= 0 && $nota2 <= 20 &&
        is_numeric($nota3) && $nota3 >= 0 && $nota3 <= 20 &&
        is_numeric($nota4) && $nota4 >= 0 && $nota4 <= 20
    ) {
        $db = new Conexion();
        $con = $db->conectar();

        $stmt = $con->prepare("CALL ActualizarNota(:id, :alumno, :nota1, :nota2, :nota3, :nota4)");
        $stmt->execute([
            ':id' => $id,
            ':alumno' => $alumno,
            ':nota1' => $nota1,
            ':nota2' => $nota2,
            ':nota3' => $nota3,
            ':nota4' => $nota4
        ]);

        header("Location: ../index.php");
        exit();
    } else {
        echo "Por favor, ingrese notas válidas entre 0 y 20.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Conexion();
    $con = $db->conectar();

    $stmt = $con->prepare("SELECT Id, alumno, nota1, nota2, nota3, nota4, promedio FROM ciclov_notas WHERE id = :id");
    $stmt->execute([':id' => $id]);
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
        <h1>Actualizar Notas del Alumno</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['Id']); ?>">

            <div>
                <label for="alumno">Nombre del Alumno</label>
                <input type="text" id="alumno" name="alumno" value="<?php echo htmlspecialchars($row['alumno']); ?>"
                    required>
            </div>

            <div>
                <label for="nota1">Nota 1</label>
                <input type="number" id="nota1" name="nota1" value="<?php echo htmlspecialchars($row['nota1']); ?>"
                    step="0.01" min="0" max="20" required>
            </div>

            <div>
                <label for="nota2">Nota 2</label>
                <input type="number" id="nota2" name="nota2" value="<?php echo htmlspecialchars($row['nota2']); ?>"
                    step="0.01" min="0" max="20" required>
            </div>

            <div>
                <label for="nota3">Nota 3</label>
                <input type="number" id="nota3" name="nota3" value="<?php echo htmlspecialchars($row['nota3']); ?>"
                    step="0.01" min="0" max="20" required>
            </div>

            <div>
                <label for="nota4">Nota 4</label>
                <input type="number" id="nota4" name="nota4" value="<?php echo htmlspecialchars($row['nota4']); ?>"
                    step="0.01" min="0" max="20" required>
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>

</html>
<?php
session_start();

// Comprobar si se ha llegado a esta página mediante un POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.php"); // Redirigir si no se accede correctamente
    exit;
}

// Obtener los datos del formulario
$total = $_POST['total'];
$usuario = $_POST['usuario'];
$productos = $_POST['productos'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .producto {
            margin-bottom: 10px;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <h1>Confirmación de Compra</h1>
    <p>Gracias por tu compra, <strong><?php echo htmlspecialchars($usuario); ?></strong>!</p>
    <h2>Detalles de la Compra:</h2>

    <div>
        <?php
        foreach ($productos as $producto) {
            echo '<div class="producto">' . htmlspecialchars($producto) . '</div>';
        }
        ?>
    </div>
    <div class="total">Total a Pagar: $<?php echo htmlspecialchars($total); ?></div>
    
    <p><a href="index.php">Volver a la página principal</a></p>
</body>
</html>
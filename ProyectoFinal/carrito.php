<?php
session_start();

// Lógica para reiniciar el carrito
if (isset($_POST['reiniciar'])) {
    unset($_SESSION['carrito']); // Eliminar el carrito de la sesión
    header("Location: carrito.php"); // Redirigir a la misma página
    exit;
}

// Lógica para quitar 1 producto o eliminar todos
if (isset($_POST['accion'])) {
    $idProducto = $_POST['idProducto'];
    
    if ($_POST['accion'] === 'quitar') {
        // Quitar 1 producto
        if (isset($_SESSION['carrito'][$idProducto]) && $_SESSION['carrito'][$idProducto]['cantidad'] > 1) {
            $_SESSION['carrito'][$idProducto]['cantidad'] -= 1; // Restar 1
        } elseif (isset($_SESSION['carrito'][$idProducto]) && $_SESSION['carrito'][$idProducto]['cantidad'] === 1) {
            unset($_SESSION['carrito'][$idProducto]); // Quitar producto si es el último
        }
    } elseif ($_POST['accion'] === 'eliminar') {
        // Eliminar todos los productos de ese tipo
        unset($_SESSION['carrito'][$idProducto]);
    }

    header("Location: carrito.php"); // Redirigir a la misma página
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <!-- <link rel = "stylesheet" href = "css/care.css"> -->
    <link rel = "stylesheet" href = "css/pruebas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    </style>
</head>
<body>
    <h1>Tu Carrito</h1>
    
    <?php
    $totalPrecio = 0; // Inicializar el total
    
    // Mostrar productos en el carrito
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $id => $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad']; // Calcular subtotal para el producto
            $totalPrecio += $subtotal; // Sumar al total general
            echo "<p> - {$producto['nombre']} - Cantidad: {$producto['cantidad']} - Precio: \$$subtotal</p>";
            echo '<form method="POST" style="display:inline;">
                    <input type="hidden" name="idProducto" value="' . $id . '">
                    <button type="submit" name="accion" value="quitar" class="btn btn-warning">Quitar 1 producto</button>
                  </form>';
            echo '<form method="POST" style="display:inline;">
                    <input type="hidden" name="idProducto" value="' . $id . '">
                    <button type="submit" name="accion" value="eliminar" class="btn btn-danger">Eliminar todos</button>
                  </form>';
            echo "<hr>"; // Línea separadora
        }
        
        // Mostrar el total y el botón de finalizar compra
        echo '<div class="total-container">';
echo "<h3>Total a Pagar: \$$totalPrecio</h3>";
echo '<form method="POST" action="finalizar_compra.php">
        <input type="hidden" name="total" value="' . $totalPrecio . '">
        <input type="hidden" name="usuario" value="' . $_SESSION['usuario'] . '">
        <button type="submit" class="btn btn-success">Finalizar Compra</button>
      </form>';
echo '</div>'; // Cierre de la div total-container
    } else {
        echo "<p>No hay productos en el carrito.</p>";
    }
    ?>

    <!-- Botón para reiniciar el carrito -->
    <form method="POST" style="margin-top: 20px;">
        <button type="submit" class="btn btn-secondary">Reiniciar Carrito</button>
    </form>
    <!-- Botón para regresar al menú -->
    <form action="menu.php" method="get" style="margin-top: 20px;">
        <button type="submit" class="btn btn-secondary">Volver al Menú</button>
    </form>

    <script>
    const numParticles = 100; // Número de partículas
    const body = document.body;

    // Crear estrellas
    for (let i = 0; i < numParticles; i++) {
        const star = document.createElement("div");
        star.classList.add("star");
        // Posicionamiento aleatorio
        star.style.left = Math.random() * 100 + "vw";
        star.style.animationDuration = Math.random() * 3 + 2 + "s"; // Duración aleatoria entre 2 y 5 segundos
        star.style.opacity = Math.random(); // Opacidad aleatoria
        body.appendChild(star);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

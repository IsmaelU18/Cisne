<?php
session_start();
$mensaje = "";

// Simular base de datos con un archivo JSON
$usuariosArchivo = 'usuarios.json';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Leer usuarios existentes
    $usuarios = json_decode(file_get_contents($usuariosArchivo), true);

    // Verificar si el usuario existe y la contraseña es correcta
    if (isset($usuarios[$usuario]) && password_verify($password, $usuarios[$usuario]['password'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: menu.php"); // Redirigir al menú del sistema
        exit;
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 50px;
            text-align: center;
        }
        input {
            padding: 10px;
            margin: 10px;
            width: 200px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <p style="color: red;"><?= $mensaje ?></p>
    <form method="POST">
        <input type="text" name="usuario" placeholder="Nombre de usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p><a href="index.php">Volver a la página principal</a></p>
</body>
</html>
<?php
session_start();
$mensaje = "";

// Simular base de datos con un archivo JSON
$usuariosArchivo = 'usuarios.json';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    // Leer usuarios existentes
    $usuarios = json_decode(file_get_contents($usuariosArchivo), true);

    // Verificar si el usuario ya existe
    if (isset($usuarios[$usuario])) {
        $mensaje = "El usuario ya está registrado.";
    } else {
        // Agregar nuevo usuario
        $usuarios[$usuario] = ['password' => $password];
        file_put_contents($usuariosArchivo, json_encode($usuarios));
        $mensaje = "Registro exitoso. Ahora puede iniciar sesión.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
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
    <h2>Registrarse</h2>
    <p style="color: red;"><?= $mensaje ?></p>
    <form method="POST">
        <input type="text" name="usuario" placeholder="Nombre de usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <button type="submit">Registrarse</button>
    </form>
    <p><a href="index.php">Volver a la página principal</a></p>
</body>
</html>
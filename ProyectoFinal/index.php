<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        button {
            padding: 15px 30px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Bienvenido al Sistema de Compras</h1>
    <div class="container">
        <form action="registro.php">
            <button type="submit">Registrarse</button>
        </form>
        <form action="login.php">
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
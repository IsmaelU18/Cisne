<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $localhost="localhost";
        $user="root";
        $password="";
        $nombre_bd="escuela";

        $miconexion = mysql_connect($localhost, $user, $password, $nombre_bd);

        if($miconexion){
            echo 'conexion exitosa';
        }else{
            echo 'error de conexion';
        }

    ?>
</body>
</html>
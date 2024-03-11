<?php
session_start();
include("passwd/conf.php");
if (isset($_POST["acceder"])) {
        if ($psswd == $_POST["passwd"] and $usuario == $_POST["user"]) {
            $_SESSION["user"] = $_POST["user"];
            header("Location: /comandas/cocina"); 
            exit(); 
        }else {
            echo "<div class='contrasenaFail'>"; 
            echo "Usuario o contraseña incorrectos";
            echo "</div>";
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postigo Arévalo Javier</title>
    <link rel="stylesheet" href="../../Config/css/style3.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            flex-direction: column;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ff6347;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff473d;
        }

        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }

        a:hover {
            color: #ff6347;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user" required>
        <br>
        <label for="passwd">Contraseña</label>
        <input type="password" name="passwd" id="passwd" required>
        <br>
        <input type="submit" value="Acceder" name="acceder">
    </form>
    <a href="/index">Volver a la tienda</a>
</body>
</html>

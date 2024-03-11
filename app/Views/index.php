<?php
/**
 * 
 * Enunciado: Este programa simula una tienda de venta de pizzas, bebidas y postres.
 * author: Javier Arévalo
 * fecha: 15-12-2023
 */
require("../app/Config/config.php");
session_start();


if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
}

if (isset($_POST["individual"]) || isset($_POST["media"]) || isset($_POST["familiar"])) {
    $pedidoArray = array();

    if (isset($_POST["individual"])) {
        $pedidoArray["tipo"] = $_POST["individual"];
        $pedidoArray["precio"] = 7.99;
        $pedidoArray["isPizza"] = true;
        array_push($_SESSION["carrito"], $pedidoArray);
    }

    if (isset($_POST["media"])) {
        $pedidoArray["tipo"] = $_POST["media"];
        $pedidoArray["precio"] = 8.99;
        $pedidoArray["isPizza"] = true;
        array_push($_SESSION["carrito"], $pedidoArray);
    }

    if (isset($_POST["familiar"])) {
        $pedidoArray["tipo"] = $_POST["familiar"];
        $pedidoArray["precio"] = 9.99;
        $pedidoArray["isPizza"] = true;
        array_push($_SESSION["carrito"], $pedidoArray);
    }

    header("Location: /index"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postigo Arévalo Javier</title>
    <style>
        /* style.css */

body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    color: #333;
}

.center-container {
    text-align: center;
    margin-top: 50px;
}

.center-top {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

h1 {
    color: #e44d26;
    text-align: center;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

nav {
    background-color: #333;
    padding: 10px;
    text-align: center;
}

nav a {
    margin: 0 15px;
    color: #fff;
    font-weight: bold;
    transition: color 0.3s ease;
}

nav a:hover {
    text-decoration: underline;
    color: #e44d26;
}

form {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

form:hover {
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

p {
    color: #777;
    margin-bottom: 15px;
    text-align: justify;
}

img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

img:hover {
    transform: scale(1.1);
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #e44d26;
    color: #fff;
    border: none;
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 15px 0;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #ff6347;
}

/* Responsive Styles */
@media screen and (max-width: 600px) {
    nav a {
        margin: 0 10px;
    }
    
    form {
        max-width: 90%;
    }
}

    </style>
    <link rel="stylesheet" href="../app/Config/css/style1.css">
</head>
<body>
<div class="center-top">
    
    <h1>faMia</h1>
    <a href="/index">Pizzas |</a>
    <a href="/bebidas">Bebidas | </a>
    <a href="/postres">Postres | </a>
    <a href="/carrito">Carrito | </a>
    <p>Elige tu pizza</p>
    <p>. . .</p>
</div>

    <form action='' method='post'>
    <?php
    foreach($productos["pizzas"] as $pizza){
        echo "<p>".$pizza["nombre"]."</p>";
// Suponiendo que $pizza["imagen"] contiene el nombre de la imagen
echo "<img src='/imagen/{$pizza["imagen"]}'>";
        echo "<br/>";
        echo "<label> Pequeña: 7,99€ </label>";
        echo '<input type="submit" value="'.$pizza["nombre"].'" name="individual">';
        echo "<label> Mediana: 8,99€ </label>";
        echo '<input type="submit" value="'.$pizza["nombre"].'" name="media">';
        echo "<label> Familiar: 9,99€ </label>";
        echo '<input type="submit" value="'.$pizza["nombre"].'" name="familiar">';
        echo "<p>. . .</p>";
    }
    ?>
    </form>
</body>
</html>

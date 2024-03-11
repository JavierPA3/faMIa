<?php
session_start();
$importeTotal = 0;


foreach ($_SESSION["carrito"] as $pedido) {
    $importeTotal = $importeTotal + $pedido["precio"];
    echo "<p>".$pedido["tipo"]." | Precio: ". $pedido["precio"] ." | Total: ". $importeTotal."</p>";
}
echo "<div>";
if ($importeTotal == 0) {
    echo "<p>El carrito está vacío.</p>";
}

echo "<p>Importe total: ".$importeTotal."</p>";
echo "</div>";
if (isset($_POST["enviar"])) {
    echo "tonto1";
    $ticketDirectory = '../app/Views/tickets/';
    require("../app/Config/config.php");

    $ticket = $ticketDirectory . 'ticket'. getdate()[0] .'.txt';
    echo $ticket;
    $fp = fopen($ticket, "a");
    echo "tonto2";

    foreach ($_SESSION["carrito"] as $pedido) {
        fwrite($fp, $pedido["tipo"]." | Precio: ". $pedido["precio"] . "\n");
    }

    fwrite($fp, "Importe total: ".$importeTotal);
    fclose($fp);

    $comandasDirectory = '../app/Views/comandas/';
    echo "tonto3";
    $comanda = $comandasDirectory . 'comanda_'. getdate()[0] .'_pendiente.txt';
    echo $comanda;
    $fp = fopen($comanda, "a");

 

    foreach ($_SESSION["carrito"] as $pedido) {
        if ($pedido["isPizza"] == true) {
            fwrite($fp, $pedido["tipo"]." | Precio: ". $pedido["precio"] ."\n");
        }
    }
    echo "tonto4";
    fclose($fp); 
    session_destroy();
    echo $ticket;
    $nombreDelTicket = basename($ticket);

    echo "tojnto5";
    header("Location: /compra_completada?ticket=$nombreDelTicket");
    exit;
}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postigo Arévalo Javier</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.contenedor {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    padding: 20px;
    max-width: 400px;
    text-align: center;
}

p {
    margin: 0;
    padding: 10px;
}

form {
    margin-top: 20px;
}

input[type="submit"] {
    background-color:  #ff6347;
    color: #fff;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    font-size: 16px;
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

.imagen {
    margin-top: 20px;
}

.imagen img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
    </style>

</head>
<body>
<form action="" method="post">
    <input type="submit" value="Tramitar pedido" name="enviar">
</form>

    <a href="/cancelarPedido">Cancelar pedido</a>
    <a href="/index">Volver a la tienda</a>
    <div class="imagen">
        <img src="../app/Config/img/istockphoto-1206806317-612x612.jpg" alt="">
</div> 
</body>
</html>

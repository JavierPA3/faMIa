<?php
session_start();


if (isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];
    $fullTicket = realpath('../app/Views/tickets/' . $ticket);

    if (file_exists($fullTicket)) {
        if (isset($_GET['descargar'])) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($fullTicket) . '"');
            header('Content-Length: ' . filesize($fullTicket));

            readfile($fullTicket);

            exit;
        } else {
            echo '<p>El ticket se ha generado correctamente.</p>';
            echo '<a href="/compra_completada?ticket=' . $ticket . '&descargar">Descargar ticket</a>';
        }
    } else {
        echo 'El archivo no se encontró.';
    }
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
    </style></head>
<body>
    <h1>Pedido Completado con exito!</h1>
    <a href="/cancelarPedido">Volver a la tienda</a>
</body>
</html>

<?php
require_once "../vendor/autoload.php";
use App\Core\Router;
use App\Controllers\IndexController;
require "../bootstrap.php";

if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil'] = "invitado";
}

$router = new Router();
$router->add(
    array(
        "name" => "home",
        "path" => "/^\/$/",
        "action" => [IndexController::class, "IndexAction"],
        "auth" => ["invitado", "usuario", "admin"]
    )
);
$router->add(
    array(
        "name" => "home",
        "path" => "/^\/index$/",
        "action" => [IndexController::class, "IndexAction"],
        "auth" => ["invitado", "usuario", "admin"]
    )
);
$router->add(
    array(
        "name" => "carrito",
        "path" => "/^\/carrito$/",
        "action" => [IndexController::class, "carritoAction"],
        "auth" => ["invitado", "usuario", "admin"]

    )
);
$router->add(
    array(
        "name" => "comandas",
        "path" => "/^\/comandas\/?$/",  // Ahora, la barra es opcional al final
        "action" => [IndexController::class, "comandasAction"],
        "auth" => ["invitado", "usuario", "admin"]
    )
);

$router->add(
    array(
        "name" => "cocina",
        "path" => "/^\/comandas\/cocina$/",  // Agregué una barra invertida antes de "cocina"
        "action" => [IndexController::class, "cocinaAction"],
        "auth" => ["invitado", "usuario", "admin"]
    )
);

$router->add(
    array(
        "name" => "comandas",
        "path" => "/^\/imagen\/([a-zA-Z0-9_\-]+\.(jpg|jpeg|png|gif))$/",
        "action" => [IndexController::class, "mostrarImagen"],
        "auth" => ["invitado", "usuario", "admin"]
    )
);
$router->add(
    array(
        "name" => "compraCompletada",
        "path" => "/^\/compra_completada\?ticket=([a-zA-Z0-9_-]+)\.txt$/",
        "action" => [IndexController::class, "compraCompletadaAction"],
        "auth" => ["invitado", "usuario", "admin"]
    )
);

$router->add(
    array(
        "name" => "bebidas",
        "path" => "/^\/bebidas$/",
        "action" => [IndexController::class, "bebidasAction"],
        "auth" => ["invitado", "usuario", "admin"]

    )
);
$router->add(
    array(
        "name" => "postres",
        "path" => "/^\/postres$/",
        "action" => [IndexController::class, "postresAction"],
        "auth" => ["invitado", "usuario", "admin"]
    )
);

$router->add(
    array(
        "name" => "saludo",
        "path" => "/^\/cancelarPedido$/",
        "action" => [IndexController::class, "cancelarPedidoAction"],
        "auth" => ["invitado", "usuario", "admin"]

    )
);
$router->add(
    array(
        "name" => "saludo",
        "path" => "/^\/cancelarPedido$/",
        "action" => [IndexController::class, "cancelarPedidoAction"],
        "auth" => ["invitado", "usuario", "admin"]

    )
);
$router->add(
    array(
        "name" => "comandasTicket",
        "path" => "/^\/comandas\/comandasTickets$/",
        "action" => [IndexController::class, "comandasTicketAction"],
        "auth" => ["invitado", "usuario", "admin"]

    )
);
$router->add(
    array(
        "name" => "saludo",
        "path" => "/^\/compraCompletada$/",
        "action" => [IndexController::class, "compraCompletadaAction"],
        "auth" => ["invitado", "usuario", "admin"]

    )
);
$router->add(
    array(
        "name" => "saludo",
        "path" => "/^\/compra_completada\?ticket=(\w+\.txt)&descargar$/",
        "action" => [IndexController::class, "compraCompletadaAction"],
        "auth" => ["invitado", "usuario", "admin"]

    )
);
$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if ($route) {
    if (in_array($_SESSION['perfil'], $route['auth'])) {
        $className = $route['action'][0];
        $classMethod = $route['action'][1];
        $object = new $className;
        $object->$classMethod($request);
    } else {
        exit(http_response_code(401));
    }
} else {
    exit(http_response_code(404));
}
?>

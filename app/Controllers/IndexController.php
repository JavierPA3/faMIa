<?php
namespace App\Controllers;

class IndexController extends BaseController
{
    public function IndexAction()
    {
    $this->renderHTML('../app/Views/index.php');

    }
    public function carritoAction()
    {
    $this->renderHTML('../app/Views/carrito.php');
    }
    public function bebidasAction()
    {
    $this->renderHTML('../app/Views/bebidas.php');
    }
    public function postresAction()
    {
    $this->renderHTML('../app/Views/postres.php');
    }
    public function cancelarPedidoAction()
{
    $this->renderHTML('../app/Views/cancelarpedido.php');
}
public function compraCompletadaAction()
{
    $this->renderHTML('../app/Views/compra_completada.php');
}
public function mostrarImagen()
{
    $uri = $_SERVER['REQUEST_URI'];
    $nombreImagen = basename($uri);

    $rutaImagen = "../public/img/" . $nombreImagen;

    if (file_exists($rutaImagen)) {
        $extension = pathinfo($rutaImagen, PATHINFO_EXTENSION);
        header('Content-Type: image/' . $extension);
        header('Content-Length: ' . filesize($rutaImagen));

        readfile($rutaImagen);
        exit;
    } else {
        echo 'Imagen no encontrada.';
    }
}

public function comandasAction()
{
    $this->renderHTML('../app/Views/ComandaAcceso/comanda.php');
}
public function cocinaAction()
{
    $this->renderHTML('../app/Views/ComandaAcceso/cocina.php');
}
public function comandasTicketAction()
    {
        $comandasDirectory = __DIR__ . '/../../Views/comandas/';
        $files = scandir($comandasDirectory);
        $comandas = [];
        $txtFiles = array_filter($files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'txt';
        });

        foreach ($txtFiles as $txtFile) {
            $comandas[] = [
                'nombre' => $txtFile,
                'ruta' => $comandasDirectory . $txtFile,
            ];
        }

        $this->renderHTML('../app/Views/ComandaAcceso/cocina.php', ['comandas' => $comandas]);
    }
}

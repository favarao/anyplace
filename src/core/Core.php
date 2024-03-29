<?php
class Core
{
    public function run($routes)
    {
        $url = '/';

        isset($_GET['url']) ? $url .= $_GET['url'] : '';
        if($url == '/banco')
            require_once('banco.php');

        if (isset($_SESSION['idUsuario']) && $url=='/login')
            $url = '/';
        if(!isset($_SESSION['idUsuario']) && $url!='/logar')
            $url = '/login';
        ($url != '/') ? $url = rtrim($url, '/') : $url;

        $routerFound = false;

        foreach ($routes as $path => $controller) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+|\d+)', $path) . '$#';
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $routerFound = true;


                [$currentController, $action] = explode('@', $controller);

                require_once __DIR__ . "/../controllers/$currentController.php";

                $newController = new $currentController();
                $newController->$action($matches[0]??'');
            }
        }

        if(!$routerFound){
                require_once __DIR__ . "/../controllers/NotFoundController.php";
                $controller = new NotFoundController();
                $controller->index();
        }
    }
}

function allow($grupos){
    $grupos = explode(',',$grupos);
    return in_array($_SESSION['grupo'],$grupos);
}

function idUsuario(){
    $usuario = new stdClass();
    $usuario->idUsuario = $_SESSION['idUsuario'];
    $usuario->nome = $_SESSION['nome'];

    return $usuario;
}
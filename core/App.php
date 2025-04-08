<?php

namespace Formacom\Core;

class App {
    protected $controller = "Formacom\\controllers\\MainController"; // Espacio de nombres correcto
    protected $method = "index";
    protected $params = [];
    protected $middlewares = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Verificar si el archivo del controlador existe
        $controllerFile = './controllers/' . ucfirst($url[0]) . 'Controller.php';
        if (file_exists($controllerFile)) {
            $this->controller = "Formacom\\controllers\\" . ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Instanciar el controlador
        if (class_exists($this->controller)) {
            $this->controller = new $this->controller;
        } else {
            die("El controlador {$this->controller} no se encuentra.");
        }

        // Verificar el método dentro del controlador
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Parámetros
        $this->params = $url ? array_values($url) : [];

        // Ejecutar el controlador y método
        // call_user_func_array([$this->controller, $this->method], $this->params); (comenta esto si usas middleware)
    }

    // Agregar middlewares
    public function addMiddleware($middleware) {
        $this->middlewares[] = $middleware;
    }

    // Ejecutar la aplicación y middlewares
    public function run() {
        $request = $_SERVER;
        $request['controller'] = get_class($this->controller);

        $this->applyMiddlewares($request, function($request) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        });
    }

    // Aplicar middlewares en cascada
    protected function applyMiddlewares($request, $next, $index = 0) {
        if (isset($this->middlewares[$index])) {
            $middleware = $this->middlewares[$index];
            $middleware->handle($request, function($request) use ($next, $index) {
                $this->applyMiddlewares($request, $next, $index + 1);
            });
        } else {
            $next($request);
        }
    }

    // Parsear la URL
    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return ['main', 'index']; // Controlador y método por defecto
    }
}

?>
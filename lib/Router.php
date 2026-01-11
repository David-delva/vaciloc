<?php
/**
 * Classe Router - Gestion du routage des URLs
 */

class Router {
    private $routes = [];
    
    public function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Route par défaut
        if ($requestUri === '' || $requestUri === '/') {
            $requestUri = '/';
        }
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                $controllerName = $route['controller'];
                $actionName = $route['action'];
                
                require_once __DIR__ . "/../src/controllers/{$controllerName}.php";
                
                $controller = new $controllerName();
                $controller->$actionName();
                return;
            }
        }
        
        // 404 - Page non trouvée
        http_response_code(404);
        include __DIR__ . '/../src/views/public/404.php';
    }

}
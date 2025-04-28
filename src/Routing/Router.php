<?php

namespace App\Routing;

use App\Configs\Config;
use ReflectionClass;
use Exception;

class Router
{
    private array $routes = [];

    /**
     * Register a new route.
     *
     * @param string $method
     * @param string $path
     * @param string $handler
     */
    public function add(string $method, string $path, string $handler): void
    {
        list($controller, $action) = explode('@', $handler);

        $pathPattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'pathPattern' => '#^' . $pathPattern . '$#',
            'controller' => $controller,
            'action' => $action,
        ];
    }

    /**
     * Dispatch the incoming request to the appropriate controller and action.
     *
     * @param string $method
     * @param string $uri
     * @return void
     */
    public function dispatch(string $method, string $uri): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pathPattern'], $uri, $matches)) {
                $controllerClass = "App\\Controllers\\{$route['controller']}";

                try {
                    if (!class_exists($controllerClass)) {
                        throw new Exception("Controller '{$route['controller']}' not found.");
                    }

                    $controller = new $controllerClass();

                    if (!method_exists($controller, $route['action'])) {
                        throw new Exception("Action '{$route['action']}' not found in controller '{$route['controller']}'");
                    }

                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $method = new ReflectionClass($controller);

                    $actionMethod = $method->getMethod($route['action']);
                    $actionMethod->invoke($controller, ...array_values($params));
                    return;

                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    return;
                }
            }
        }

        $this->handleNotFound();
    }

    /**
     * Handle 404 errors when no route matches.
     *
     * @return void
     */
    private function handleNotFound(): void
    {
        $notFoundPath = rtrim(Config::get('paths.views'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '404.php';

        if (file_exists($notFoundPath)) {
            include $notFoundPath;
        } else {
            echo "404: Not found!";
        }
    }
}

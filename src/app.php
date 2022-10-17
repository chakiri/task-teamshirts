<?php

require_once('../vendor/autoload.php');

// Useful paths
define('TEMPLATES_DIR', __DIR__ . '/../templates/');
define('SRC_DIR', __DIR__ . '/');
define('PUBLIC_DIR', __DIR__ . '/../public/');

/**
 * This array links paths with methods of controller
 */
$routes = [
    '/' => [
        'GET' => 'App\Controller\HomeController@index',
    ],
    '/start-game' => [
        'GET' => 'App\Controller\GameController@start',
    ],
];

//Get current path and HTTP method
$path = $_SERVER['REQUEST_URI'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    // If current path doesn't exist in the array
    if (!array_key_exists($path, $routes)) {
        throw new Exception("There is no page corresponding to this url `$path`");
    }

    // Otherwise, we get information from the array
    $route = $routes[$path];
    [$className, $methodName] = getControllerForRoute($route, $method);

    // If class doesn't exist
    if (!class_exists($className)) {
        throw new Exception("This class <strong>$className</strong> doesn't exist in the paths array");
    }

    // We initiate the controller
    $controller = new $className();

    // If method doesn't exist
    if (!method_exists($controller, $methodName)) {
        throw new Exception("This class <strong>$className</strong> doesn't exist in the paths array");
    }

    // We call the method of the controller
    call_user_func([$controller, $methodName]);

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require_once(TEMPLATES_DIR . "error.html.php");
}


/**
 * Return array with the class name and the method to call for à given path and a HTTP method
 *
 * @param array $route
 * @param string $httpMethod
 *
 * @return array
 */
function getControllerForRoute(array $route, string $httpMethod = 'GET'): array
{
    $controller = $route[$httpMethod];
    $className = substr($controller, 0, strpos($controller, '@'));
    $methodName = substr($controller, strpos($controller, '@') + 1);

    return [$className, $methodName];
}

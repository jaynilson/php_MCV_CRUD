<?php
require_once '../bootstrap/app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


if ($uri === '/auth/register') {
    $controller = new AuthController();
    $controller->register();
} elseif ($uri === '/auth/login') {
    $controller = new AuthController();
    $controller->login();
} elseif ($uri === '/auth/logout') {
    $controller = new AuthController();
    $controller->logout();
} elseif ($uri === '/data/store') {
    $controller = new DataController();
    $controller->store();
} elseif ($uri === '/data/display') {
    $controller = new DataController();
    $controller->display();
} else {
    echo "404 Not Found";
}

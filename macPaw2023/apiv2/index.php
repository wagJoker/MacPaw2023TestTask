<?php
// Завантаження автозавантажувача класів
require 'autoload.php';

// Підключення до бази даних
$config = require 'config/db.php';
$pdo = new PDO($config['dsn'], $config['username'], $config['password']);

// Роутер: отримання контролера та дії з URL
$route = $_GET['r'] ?? 'site/index';
list($controllerName, $actionName) = explode('/', $route);
$controllerClass = 'api\\controllers\\' . ucfirst($controllerName) . 'Controller';

// Створення об'єкта контролера та виклик відповідної дії
$controller = new $controllerClass($pdo);
$controller->$actionName();
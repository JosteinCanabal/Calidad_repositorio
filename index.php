<?php
// index.php

// Incluye los controladores
require_once 'controllers/HomeController.php';
require_once 'controllers/VideoController.php';
require_once 'controllers/FileController.php';

$controller = 'HomeController'; // Controlador por defecto

// Verifica si hay un controlador especificado en la URL
if (isset($_GET['controller'])) {
    $controller = ucfirst($_GET['controller']) . 'Controller';
}

// Verifica si la clase del controlador existe
if (class_exists($controller)) {
    $controllerInstance = new $controller();
    $controllerInstance->index();
} else {
    echo "Controlador no encontrado.";
}
?>
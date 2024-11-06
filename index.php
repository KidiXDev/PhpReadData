<?php
$request = $_SERVER['REQUEST_URI'];
$requestPath = strtok($request, '?');
$moduleDir = '/modules/';

switch ($requestPath) {
    case '':
    case '/':
        require __DIR__ . $moduleDir . 'view/dashboard.php';
        break;
    case '/add':
        require __DIR__ . $moduleDir . 'view/add.php';
        break;
    case '/edit':
        require __DIR__ . $moduleDir . 'view/edit.php';
        break;
    case '/delete':
        require __DIR__ . $moduleDir . 'delete.php';
        break;
    case '/export':
        require __DIR__ . $moduleDir . 'export.php';
        break;
    case '/import':
        require __DIR__ . $moduleDir . 'view/import.php';
        break;
    case '/auth/login':
        require __DIR__ . $moduleDir . 'auth/login.php';
        break;
    case '/auth/logout':
        require __DIR__ . $moduleDir . 'auth/logout.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . $moduleDir . '404.php';
}

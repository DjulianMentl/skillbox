<?php

switch ($_SERVER['REQUEST_URI']) {
    case '/skillbox/module-18/route/book' :
        include_once 'BooksController.php';
        $controller = new BooksController();
        echo $controller->list();
        break;
    case '/skillbox/module-18/route/user' :
        include_once 'UserController.php';
        $controller = new UserController();
        echo $controller->list();
        break;
    default:
        http_response_code(403);
}
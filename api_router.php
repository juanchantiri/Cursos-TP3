<?php
// Librerias
require_once "app/libs/router/router.php";
require_once 'app/libs/jwt/jwt.middleware.php'; 
require_once 'app/Middlewares/guard-api.middleware.php';

// Controladores
require_once "app/controller/auth_controller.php";
require_once "app/controller/cursos_controller.php";
require_once "app/controller/categorias_controller.php";

$router = new Router();


$router->addRoute('auth/login',     'GET',     'AuthApiController',    'login');

$router->addMiddleware(new JWTMiddleware());


$router->addRoute('cursos', 'GET', 'cursos_controller', 'getCursos');
$router->addRoute('cursos/categoria/:id', 'GET', 'cursos_controller', 'getCursosPorCategoria');


$router->addMiddleware(new GuardMiddleware());



$router->addRoute('categorias', 'GET', 'categorias_controller', 'getCategorias');
$router->addRoute('categorias/:id', 'GET', 'categorias_controller', 'getCategoria');
$router->addRoute('categorias', 'POST', 'categorias_controller', 'addCategorias');
$router->addRoute('categorias/:id', 'DELETE', 'categorias_controller', 'deleteCategoria');
$router->addRoute('categorias/:id', 'PUT', 'categorias_controller', 'updateCategoria');
$router->addRoute('categorias/ordenar/:order', 'GET', 'categorias_controller', 'ordenarCategorias'); // se ordena por nombre


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
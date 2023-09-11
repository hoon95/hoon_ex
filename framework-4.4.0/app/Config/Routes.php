<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
*/
$routes->get('/', 'Home::index');
$routes->get('/board/list', 'Board::list');
$routes->get('/board/write', 'Board::write');
$routes->match(['get', 'post'], 'writesave', 'Board::save');
$routes->get('/boardview/(:num)', 'Board::view/$1');

$routes->get('/login', 'MemberController::login');
$routes->get('/logout', 'MemberController::logout');
$routes->match(['get', 'post'], '/loginok', 'MemberController::loginok');
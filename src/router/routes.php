<?php
$routes = [
    '/' => 'HomeController@index',
    '/usuario/{id}' => 'UsuarioController@show',
    '/usuarios' => 'UsuarioController@usuarios',
    '/login' => 'LoginController@index',
    '/logar' => 'LoginController@logar',
    '/logout' => 'LoginController@logout'
];
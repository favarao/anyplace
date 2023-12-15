<?php
$routes = [
    '/' => 'HomeController@index',
    '/usuario/{id}' => 'UsuarioController@show',
    '/usuarios' => 'UsuarioController@usuarios',
    '/login' => 'LoginController@index',
    '/logar' => 'LoginController@logar',
    '/alterarSenhaInicial' => 'UsuarioController@alterarSenhaInicial',
    '/logout' => 'LoginController@logout',
    '/clientes' => 'ClienteController@index',
    '/cliente/{id}' => 'ClienteController@buscaCliente',
    '/addcliente' => 'ClienteController@adicionarClienteFormulario',
    '/insertCliente' => 'ClienteController@adicionarCliente',
    '/updateCliente' => 'ClienteController@atualizarCliente',
    '/deleteCliente/{id}' => 'ClienteController@deletarCliente',
    '/produtos' => 'ProdutoController@index',
    '/produto/{id}' => 'ProdutoController@buscaProduto',
    '/addproduto' => 'ProdutoController@adicionarProdutoFormulario',
    '/insertProduto' => 'ProdutoController@adicionarProduto',
    '/updateProduto' => 'ProdutoController@atualizarProduto',
    '/deleteProduto/{id}' => 'ProdutoController@deletarProduto',
    '/configuracao' => 'ConfiguracaoController@index',
    '/attParam' => 'ConfiguracaoController@atualizarParametro'
];
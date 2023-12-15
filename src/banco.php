<?php
// Configurações do banco de dados atual
$hostAtual = 'mysql';
$usuarioAtual = 'root';
$senhaAtual = 'root';
$bancoAtual = 'anyplace';

// Configurações do novo banco de dados
$hostNovo = 'mysql';
$usuarioNovo = 'root';
$senhaNovo = 'root';
$bancoNovo = 'anyplace';
$dir = '/anyplace.sql';

// Conexão com o banco de dados atual
$conexaoAtual = new mysqli($hostAtual, $usuarioAtual, $senhaAtual, $bancoAtual);

// Verifica se houve erro na conexão
if ($conexaoAtual->connect_error) {
    die("Erro na conexão com o banco de dados atual: " . $conexaoAtual->connect_error);
}

// Apaga todos os dados do banco de dados atual
$queryApagar = "DROP DATABASE $bancoAtual";
if ($conexaoAtual->query($queryApagar) === TRUE) {
    echo "Banco de dados atual apagado com sucesso\n";
} else {
    echo "Erro ao apagar banco de dados atual: " . $conexaoAtual->error . "\n";
}

// Conexão com o novo banco de dados
$conexaoNovo = new mysqli($hostAtual, $usuarioAtual, $senhaAtual);

// Verifica se houve erro na conexão
if ($conexaoNovo->connect_error) {
    die("Erro na conexão com o novo banco de dados: " . $conexaoNovo->connect_error);
}

// Cria um novo banco de dados
$queryCriarNovo = "CREATE DATABASE $bancoNovo";
if ($conexaoNovo->query($queryCriarNovo) === TRUE) {
    echo "Novo banco de dados criado com sucesso\n";
} else {
    echo "Erro ao criar novo banco de dados: " . $conexaoNovo->error . "\n";
}

// Importa o novo banco de dados
$comandoImportar = "mysql -u$usuarioNovo -p$senhaNovo $bancoNovo < $dir";
shell_exec($comandoImportar);

echo "Banco de dados importado com sucesso\n";

// Fecha as conexões
$conexaoAtual->close();
$conexaoNovo->close();
?>
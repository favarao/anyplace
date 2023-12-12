<?php
class UsuarioController
{
    public function index()
    {

    }

    public function show($id)
    {
        print_r($id);
    }

    public function alterarSenhaInicial(){
        header('Content-Type: application/json');
        $senha = $_REQUEST['novaSenha'];
        $senha2 = $_REQUEST['novaSenha2'];
        $idUsuario = $_SESSION['idUsuario'];
        echo json_encode(Usuario::novaSenha($idUsuario,$senha,$senha2));
    }
}
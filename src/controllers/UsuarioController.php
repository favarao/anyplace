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
        $result = Usuario::novaSenha($idUsuario,$senha,$senha2);
        if($result['success'] == true)
            unset($_SESSION['alterar']);
        echo json_encode($result);
    }
}
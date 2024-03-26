<?php

class PromocaoController extends RenderView
{
    public function index()
    {
        $clientes = array();
        if(allow('2'))
        {
            $clientes[] = Cliente::getCliente($_SESSION['idUsuario']);
            $idCliente =  $_SESSION['idUsuario'];  
        }            
        else
            $clientes = Cliente::getClientes();

        $this->loadView('promocoes',
            [
                'titulo' => 'Lista de Promoções',
                'promocoes' => Promocao::getPromocoes($idCliente??''),
                'clientes' => $clientes
            ]);
    }

    public function gerenciarPromocoes($idPromocao='')
    {
        $clientes = array();
        if(allow('1'))
            $clientes = Cliente::getClientes();
        else
            $clientes = Cliente::getCliente($_SESSION['usuario_id']);
        if($idPromocao)
            $promocao = Promocao::getPromocao($idPromocao);
        else
            $promocao = new Promocao();

        $this->loadView('gerenciarPromocoes',
            [
                'titulo' => 'Gerenciar Promoções',
                'param' => Configuracao::getConfiguracao(),
                'promocao' => $promocao,
                'clientes' => Cliente::getClientes()
            ]);
    }

    public function buscaPromocao($id)
    {
        header('Content-Type: application/json');
        echo json_encode(Promocao::getPromocao($id));
    }

    public function atualizarCliente()
    {
        header('Content-Type: application/json');
        $cliente = new Cliente($_REQUEST);
        $usuario = self::buscaLoginCliente($cliente->login);
        // print_r($cliente);print_r($usuario);exit;
        if (!$usuario || $usuario->idCliente == $cliente->id) {
            if ($cliente->update()) {
                if(!$usuario)
                {
                    $usuario = self::buscaLoginCliente('',$cliente->id);
                    $usuario->login = $cliente->login;
                    $usuario->update();
                }
                echo json_encode(['success' => true, 'msg' => 'Cliente atualizado com sucesso']);
            } else
                echo json_encode(['success' => false, 'msg' => 'Erro ao atualizar cliente']);
        } else {
            echo json_encode(['success' => false, 'msg' => 'Login já cadastrado']);
        }
    }

    public function buscaLoginCliente($login = '', $idCliente = '')
    {
        return Usuario::getUsuarioByLogin($login, $idCliente);
    }



    public function adicionarCliente()
    {
        header('Content-Type: application/json');
        $cliente = new Cliente($_REQUEST);
        $usuario = self::buscaLoginCliente($cliente->login);

        if ($usuario)
            echo json_encode(['success' => false, "msg" => 'Login já cadastrado.']);
        else
            if ($id = $cliente->insert()) {
                $cliente = (array) $cliente;
                $cliente['idCliente'] = $id;
                $cliente['grupo'] = 2;
                $cliente['status'] = 1;
                $usuario = new Usuario($cliente);
                $usuario->insert();
                echo json_encode(['success' => true, 'msg' => 'Cliente adicionado com sucesso.']);
            } else
                echo json_encode(['success' => false, 'msg' => 'Erro ao salvar cliente.']);
    }

    public function deletarCliente($id){
        header('Content-Type: application/json');
        $cliente = Cliente::getCliente($id);
        if($cliente)
            if($cliente->delete())
            {
                echo json_encode(['success'=> true, 'msg' => 'Cliente deletado com sucesso.']);
                return true;
            }
        echo json_encode(['success'=> false, 'msg' => 'Erro ao deletar cliente.']);                
    }


}
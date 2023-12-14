<?php

class ClienteController extends RenderView
{
    public function index()
    {
        $this->loadView('clientes',
            [
                'titulo' => 'Lista de Clientes',
                'param' => Configuracao::getConfiguracao(),
                'clientes' => Cliente::getClientes()
            ]);
    }

    public function adicionarClienteFormulario()
    {
        $this->loadView('addcliente',
            [
                'titulo' => 'Adicionar Cliente',
                'param' => Configuracao::getConfiguracao()
            ]);
    }

    public function buscaCliente($id)
    {
        header('Content-Type: application/json');
        echo json_encode(Cliente::getCliente($id));
    }

    public function atualizarCliente()
    {
        header('Content-Type: application/json');
        $cliente = new Cliente($_REQUEST);
        $usuario = self::buscaLoginCliente($cliente->login);
        // print_r($cliente);print_r($usuario);exit;
        if (!$usuario || $usuario->idCliente == $cliente->id) {
            if ($cliente->update()) {
                $usuario->update();
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


}
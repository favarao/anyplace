<?php

class ClienteController extends RenderView{
    public function index(){
        $this->loadView('clientes',
        [
            'titulo' => 'Lista de Clientes',
            'param' => Configuracao::getConfiguracao(),
            'clientes' => Cliente::getClientes()
        ]);
    }

    public function adicionarClienteFormulario(){
        $this->loadView('addcliente',
        [
            'titulo' => 'Adicionar Cliente',
            'param' => Configuracao::getConfiguracao()
        ]);
    }

    public function buscaCliente($id){
        header('Content-Type: application/json');
        echo json_encode(Cliente::getCliente($id));
    }

    public function atualizarCliente(){
        header('Content-Type: application/json');
        $cliente = new Cliente($_REQUEST);
        if($cliente->update())
            echo json_encode(['success' => true, 'msg' => 'Cliente atualizado com sucesso']);
        else
            echo json_encode(['success' => false, 'msg' => 'Erro ao atualizar cliente']);
    }

    public function buscaLoginCliente($idCliente){
        
    }

    public function adicionarCliente(){
        header('Content-Type: application/json');
        $cliente = new Cliente($_REQUEST);
        if($cliente->insert())
            echo json_encode(['success' => true, 'msg' => 'Cliente adicionado com sucesso.']);
        else
            echo json_encode(['success'=> false,'msg'=> 'Erro ao salvar cliente.']);
    }

    
}
<?php

class ClienteController extends RenderView{
    public function index(){
        $this->loadView('clientes',
        [
            'title' => 'Lista de Clientes',
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

    

    public function adicionarCliente(){
        header('Content-Type: application/json');
        $cliente = new Cliente($_REQUEST);
        if($cliente->insert())
            echo json_encode(['success' => true, 'msg' => 'Cliente adicionado com sucesso.']);
        else
            echo json_encode(['success'=> false,'msg'=> 'Erro ao salvar cliente.']);
    }

    
}
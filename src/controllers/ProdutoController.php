<?php

class ProdutoController extends RenderView{
    public function index(){
        $this->loadView('produtos',
        [
            'titulo' => 'Lista de Produtos',
            'param' => Configuracao::getConfiguracao(),
            'clientes' => Cliente::getClientes()
        ]);
    }

    public function adicionarProdutoFormulario(){
        $this->loadView('addproduto',
        [
            'titulo' => 'Adicionar Produto',
            'param' => Configuracao::getConfiguracao()
        ]);
    }

    public function buscaProduto($id){
        header('Content-Type: application/json');
        echo json_encode(Cliente::getCliente($id));
    }

    public function atualizarProduto(){
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
<?php

class PromocaoController extends RenderView
{
    public function index()
    {
        $promocoes = array();
        if(allow('2'))
        {
            $idCliente =  $_SESSION['idCliente'];
            $promocoes = Promocao::getPromocoes($idCliente);
            
        }            
        else
            $promocoes = Promocao::getPromocoes();

        $this->loadView('promocoes',
            [
                'titulo' => 'Lista de Promoções',
                'param' => Configuracao::getConfiguracao(),
                'promocoes' => $promocoes
            ]);
    }

    public function adicionarPromocao(){
        header('Content-Type: application/json');
        $promocao = new Promocao($_REQUEST);
        $promocao = Promocao::getPromocao($promocao->save());
        $promocao->salvaProdutos($_REQUEST['produtos']);
        $data = ['result'=> true, 'msg'=>'Promoção salva com sucesso.'];
        echo json_encode($data);
    }
    public function deletePromocao($id){
        header('Content-Type: application/json');
        
        return Promocao::getPromocao($id)->delete();
    }
    public function gerenciarPromocoes($idPromocao='')
    {
        $clientes = array();

        if(allow('2'))
            $clientes[0] = Cliente::getClienteByUsuario($_SESSION['idUsuario']);
        else
            $clientes = Cliente::getClientes();
        if($idPromocao)
        {
            $promocao = Promocao::getPromocao($idPromocao);
            if($promocao)
                $listaProdutos = $promocao->getProdutos();
            else
                $listaProdutos = array();
            $produtos = array();
            if($listaProdutos)
            foreach($listaProdutos as $lp)
                array_push($produtos,$lp->id);
            $produtos = implode(',',$produtos);
        }
        else
        {
            $promocao = new Promocao();
            $produtos = '';
            $listaProdutos = array();
        }
            

        

        $this->loadView('gerenciarPromocao',
            [
                'titulo' => 'Gerenciar Promoções',
                'clientes' => $clientes,
                'param' => Configuracao::getConfiguracao(),
                'promocao' => $promocao,
                'listaProdutos' => $listaProdutos,
                'produtos' => $produtos
            ]);
    }

   


}
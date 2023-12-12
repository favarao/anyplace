<?php

class ConfiguracaoController extends RenderView{
    public function index(){
        $this->loadView('configuracao',['titulo'=> 'Configurações','clientes' => Cliente::getClientes() ]);
    }

    public function adicionarCliente(){
        
    }
    public function getConfiguracao(){
        
    }
    
}
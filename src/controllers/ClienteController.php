<?php

class ClienteController extends RenderView{
    public function index(){
        $this->loadView('clientes',
        [
            'title' => 'Lista de Clientes',
            'clientes' => Cliente::getClientes() 
        ]);
    }

    
}
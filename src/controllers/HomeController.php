<?php

class HomeController extends RenderView{
    public function index(){
        $this->loadView('home',
        [
            'titulo' => 'Bem Vindo',
            'param' => Configuracao::getConfiguracao()
        ]);
    }
}
<?php 
class LoginController extends RenderView
{
    public function index(){
        $this->loadView('login');
    }

    public function logar(){
        
        print_r($this->getRequest('usuario'));
    }
}
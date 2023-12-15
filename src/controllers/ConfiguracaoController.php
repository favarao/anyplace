<?php

class ConfiguracaoController extends RenderView{
    public function index(){
        $this->loadView('configuracao',
    [
        'titulo'=> 'Atualizar Parametros',
        'param' => Configuracao::getConfiguracao(),
        'msg' => $_REQUEST['msg']??''
    ]);
    }

    public function atualizarParametro(){
        header('Content-Type: application/json');
        $msg ='';
        if (isset($_FILES["logo"]["name"]) && $_FILES["logo"]["name"]!='') {
            $nome_temporario = $_FILES["logo"]["tmp_name"];
            $nome_arquivo = $_FILES["logo"]["name"];
            
            $formato = explode('.',$nome_arquivo);
            $formato = $formato[count($formato)-1];
            if($formato!='png' && $formato!= 'jpg' && $formato!= 'jpeg'){
                $msg = "Erro em salvar imagem. Precisa ser png ou jpg.";
                echo json_encode(['success' => false, 'msg'=> $msg]);
            }
        }
        if($msg=='')
        {
            $configuracao = new Configuracao($_REQUEST);
                if($configuracao->update())
                {
                    if(isset($_FILES["logo"]['name']) && $_FILES["logo"]["name"]!='')
                        move_uploaded_file($nome_temporario, "assets/img/logo.$formato");
                    $msg = "Parametros atualizados com sucesso.";
                    echo json_encode(['success' => true, 'msg'=> $msg]);
                }
        }

    }
}
<?php

class ConfiguracaoController extends RenderView{
    public function index(){
        $this->loadView('configuracao',
    [
        'titulo'=> 'Atualizar Parametros',
        'param' => Configuracao::getConfiguracao()
    ]);
    }

    public function atualizarParametro(){
        $msg ='';
        if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] == 0) {
            $nome_temporario = $_FILES["logo"]["tmp_name"];
            $nome_arquivo = $_FILES["logo"]["name"];
            $formato = explode('.',$nome_arquivo)[1];
            if($formato!='png' && $formato!= 'jpg' && $formato!= 'jpeg'){
                $msg = "Erro em salvar imagem. Precisa ser png ou jpg.";
            }
        }
        elseif(isset($_FILES['logo']))
        {
            $msg = "Erro em salvar imagem.";
        }elseif(!isset($_REQUEST['nomeSistema']) || !isset($_REQUEST['nomeAdministrador']))
        {
            $msg = "Preencha corretamente o formulário";
        }

        if($msg=='')
        {
            if(isset($_FILES["logo"]))
                $_REQUEST['logo'] = "logo.$formato";
            $configuracao = new Configuracao($_REQUEST);
            if($configuracao->update())
            {
                if(isset($_FILES["logo"]))
                move_uploaded_file($nome_temporario, "assets/img/logo.$formato");
                $msg = "Parametros atualizados com sucesso.";
            }
            else
            {
                $msg = "Erro ao salvar parametros";
            }
        }

        header("Location: /configuracao" );
        exit;
    }
}
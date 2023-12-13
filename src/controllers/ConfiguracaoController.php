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
        if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] == 0) {
            $nome_temporario = $_FILES["logo"]["tmp_name"];
            $nome_arquivo = $_FILES["logo"]["name"];
            $formato = explode('.',$nome_arquivo)[1];
            if($formato!='png' && $formato!= 'jpg' && $formato!= 'jpeg'){
                $msg = "Erro em salvar imagem. Precisa ser png ou jpg.";
            }
            else
            {
                $configuracao = new Configuracao($_REQUEST);
                if($configuracao->update())
                {
                    move_uploaded_file($nome_temporario, "assets/img/$nome_arquivo");
                    $msg = "Parametros atualizados com sucesso.";
                }
            }
        }
        else
        {
            $msg = "Erro em salvar imagem. Precisa ser png ou jpg.";
        }

        $this->loadView('configuracao',
        [
            'titulo' => 'Atualizar Parametros',
            'param' => Configuracao::getConfiguracao(),
            'msg' => $msg
        ]);
    }
}
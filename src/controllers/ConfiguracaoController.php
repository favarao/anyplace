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

    public function negociarComissao(){
        if(allow('2'))
        {
            $c = Cliente::getClienteByUsuario($_SESSION['idUsuario']);
            $this->loadView('clienteNegociarComissao',
            [
                'titulo' => 'Negociar Comissão',
                'cliente' => $c,
                'comissao' => Configuracao::getComissao($c->id),
                'param' => Configuracao::getConfiguracao(),
                'msg' => $_REQUEST['msg']??''
            ]);
        }
        else
        {
            $this->loadView('negociarComissao',
            [
                'titulo' => 'Negociar Comissão',
                'clientes' => Configuracao::getClientesNegociacao(),
                'param' => Configuracao::getConfiguracao(),
                'msg' => $_REQUEST['msg']??''
            ]);
        }
    }

    public function recusarNegociacao(){
        return Configuracao::recusarNegociacao($_REQUEST['idPessoa']);
    }

    public static function solicitarComissao(){
        header('Content-Type: application/json');
        $data = new stdClass();
        $data->idPessoa = $_REQUEST['idPessoa'];
        $data->novoInicio = $_REQUEST['novoInicio'];
        $data->novoFinal = $_REQUEST['novoFinal'];
        $data->novoTipo = $_REQUEST['novoTipo'];
        $data->novoValor = $_REQUEST['novoValor'];
        if(Configuracao::solicitaComissao($data))
        {
            $msg = "Sucesso em solicitar negociação.";
            echo json_encode(['result' => true, 'msg'=> $msg]);

        }
        else
        {
            $msg = "Erro ao solicitar negociação.";
            echo json_encode(['result' => false, 'msg'=> $msg]);
        }
    }

    public static function aceitarComissao(){
        header('Content-Type: application/json');
        if(Configuracao::aceitarNegociacao($_REQUEST['idPessoa']))
        {
            $msg = "Comissão aceita.";
            echo json_encode(['success' => true, 'msg'=> $msg]);
        }
        else
        {
            $msg = "Comissão Recusada";
            echo json_encode(['success' => false, 'msg'=> $msg]);
        }
            
        
        

    }



    public function buscaNegociacao($id){
        header('Content-Type: application/json');
        echo json_encode(Configuracao::getComissao($id));
    }

    public function atualizaComissao(){
        header('Content-Type: application/json');
        if(Configuracao::atualizaComissao($_REQUEST))
            echo '{"result":true,"msg":"Sucesso ao salvar"}';
        else
            echo '{"result":false,"msg":"Erro ao salvar"}';
    }
}
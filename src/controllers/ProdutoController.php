<?php

class ProdutoController extends RenderView{
    public function index(){
        $this->loadView('produtos',
        [
            'titulo' => 'Lista de Produtos',
            'param' => Configuracao::getConfiguracao(),
            'produtos' => Produto::getProdutos(),
            'clientes' => Cliente::getClientes()
        ]);
    }

    public function adicionarProdutoFormulario(){
        $this->loadView('addproduto',
        [
            'titulo' => 'Adicionar Produto',
            'param' => Configuracao::getConfiguracao(),
            'clientes' => Cliente::getClientes()
        ]);
    }

    public function buscaProduto($id){
        header('Content-Type: application/json');
        echo json_encode(Produto::getProduto($id));
    }


    public function atualizarProduto(){
        header('Content-Type: application/json');
        $produto = new Produto($_REQUEST);
        if($produto->update())
            echo json_encode(['success' => true, 'msg' => 'Produto atualizado com sucesso']);
        else
            echo json_encode(['success' => false, 'msg' => 'Erro ao atualizar cliente']);
    }


    public function adicionarProduto(){
        header('Content-Type: application/json');
        $produto = new Produto($_REQUEST);
        if($_FILES["imagem1"]["name"]!='' || $_FILES["imagem2"]["name"]!='' || $_FILES["imagem3"]["name"]!='')
        {
            $nome_temporario1 = $_FILES["imagem1"]["tmp_name"];
            $nome_arquivo1 = $_FILES["imagem1"]["name"]??'';
            $nome_temporario2 = $_FILES["imagem2"]["tmp_name"];
            $nome_arquivo2 = $_FILES["imagem2"]["name"]??'';
            $nome_temporario3 = $_FILES["imagem3"]["tmp_name"];
            $nome_arquivo3 = $_FILES["imagem3"]["name"]??'';

        }
        if($id = $produto->insert())
        {
            if(Produto::insertFotos($id,$nome_arquivo1,$nome_arquivo2,$nome_arquivo3))
            {
                $diretorio = "assets/img/produto/$id";
                if (!file_exists($diretorio)) 
                    mkdir($diretorio, 0777, true);
                if($nome_arquivo1)
                    move_uploaded_file($nome_temporario1, "assets/img/produto/$id/$nome_arquivo1");
                if($nome_arquivo2)
                    move_uploaded_file($nome_temporario2, "assets/img/produto/$id/$nome_arquivo2");
                if($nome_arquivo3)
                    move_uploaded_file($nome_temporario3, "assets/img/produto/$id/$nome_arquivo3");
            }
            echo json_encode(['success' => true, 'msg' => 'Produto adicionado com sucesso.']);
        }
        else
            echo json_encode(['success'=> false,'msg'=> 'Erro ao salvar Produto.']);
    }

    public function deletarProduto($id){
        header('Content-Type: application/json');
        $produto = Produto::getProduto($id);
        if($produto)
            if($produto->delete())
            {
                echo json_encode(['success'=> true, 'msg' => 'Produto deletado com sucesso.']);
                return true;
            }
        echo json_encode(['success'=> false, 'msg' => 'Erro ao deletar produto.']);                
    }

    public function importarCSV(){
        header('Content-Type: application/json');
        $file = $_FILES['arquivoCSV']??'';
        if ($file) {
            $csvData = file_get_contents($file['tmp_name']);
        $lines = explode(PHP_EOL, $csvData);
        $result = array();

        // Assume que a primeira linha contém os cabeçalhos
        $headers = str_getcsv(array_shift($lines),'¨');

        foreach ($lines as $line) {
            $rowData = str_getcsv($line,"¨");
            print_r($rowData);exit;

            // Verifique se o número de elementos é o mesmo nos cabeçalhos e nos valores
            if (count($headers) === count($rowData)) {
                // Crie um array associativo combinando cabeçalhos e valores
                $assocData = array_combine($headers, $rowData);

                // Adicione ao resultado
                $result[] = $assocData;
            } else {
                // Trate a situação em que o número de elementos não corresponde
                echo "Erro: O número de elementos nos cabeçalhos não corresponde ao número de elementos na linha.";
                exit;
            }
        }
    
            // Agora $result contém um array de arrays associativos, onde cada array representa uma linha do CSV.
    
            // Faça o que quiser com $result, por exemplo, converta para JSON e imprima:
            echo json_encode($result);
        }
    }

    
}
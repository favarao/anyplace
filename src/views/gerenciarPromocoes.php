<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Gerenciar Promoção</h1>
        </div>
        <div class="card">
            <div class="card-body">
                
            <form id="formulario" method="POST">
            <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Titulo *</label>
                            <input type="text" name="titulo" id="titulo" value="<?=$promocao->titulo??''?>" required class="form-control" placeholder="Título da Promoção">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Cliente *</label>
                            <select  name="cliente" id="cliente" required  class="form-control">
                                <option value="">Selecione...</option>
                                <?php foreach ($clientes as $cliente):?>
                                    <option value="<?=$cliente->id?>" <?=($promocao->idCliente??'')==$cliente->id?'selected':''?>><?=$cliente->nome?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Data Inicial *</label>
                            <input type="date" name="dataInicial" id="dataInicial" max="9999-12-31" value="<?=$promocao->dataInicial??''?>"required  class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Data Final *</label>
                            <input type="date"  name="dataFinal" id="dataFinal" max="9999-12-31" value="<?=$promocao->dataFinal??''?>" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Porcentagem *</label>
                            <input type="number" step="0.01" min="1" name="porcentagem" id="porcentagem" value="<?=$promocao->porcentagem??''?>" required class="form-control" placeholder="Porcentagem Sobre o Produto">
                        </div>
                    </div>
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Produto *</label>
                            <div class="input-group">
                            <select name="produto" id="produto" class="form-control">
                                <option value="">Selecione um cliente</option>
                            </select>
                            <a onclick="adicionarProduto()" class="botao btn btn-primary">Adicionar Produto</a>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <table id="tabela-produtos" style="width:100%">
                    <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Valor Final</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody id="inserir">
                        </tbody>
                    </table>
                </div>
                <div class="row botoes-formulario">
                <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>
                
                <div>
                <a href="/promocoes" class="btn btn-primary botao">Cancelar</a>
                <a href="" class="btn btn-primary botao">Salvar</a>
                </div>
                
                </div>
            </form>
            <input type="hidden" id="produtos" value="">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#produto").select2();
            if($("#cliente").val())
            $.post("/getProdutos/"+$("#cliente").val(),function(data){
                     
        });
        
        });

        function adicionarProduto(){
            produtos = $("#produtos").val().split(',');
            id = $("#produto").val();
            porcentagem = $("#porcentagem").val();
            if($.inArray(id,produtos<0))
            {
                if(produtos=='')
                $("#inserir").empty();
                $.post("/produto/"+id,function(data){
                    var newRow = $('<tr>');
                    newRow.append($('<td>').text(data.sku));
                    newRow.append($('<td>').text(data.nome));
                    newRow.append($('<td>').text(data.valor));
                    newRow.append($('<td>').text(data.valor*porcentagem));
                    newRow.append($('<td>').text(data.nome));
                    $('#inserir').append(newRow);
                });
                produtos.push(id);
                $("#produtos").val(produtos.join(','));
                
            }
            else
            console.log("deu n");

        }

        $("#cliente").change(function(){
            $.post("/getProdutos/"+$("#cliente").val(),function(data){
                $("#produto").empty();
                $("#produto").append($('<option>', {
            value: '',
            text: 'Selecione'
        }));
            $.each(data,function(index,produto){
                $("#produto").append($('<option>', {
            value: produto.id,
            text: produto.nome
        }));
            }); 
        });
        });

        
        $("#formulario").submit(function (e) {
            e.preventDefault();

        });
        $('#tabela-produtos').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "Nenhum registro encontrado",
                "info": "Mostrando _START_ a _END_ de _TOTAL_",
                "infoEmpty": "",
                "infoFiltered": "",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Exibir _MENU_ registros",
                "loadingRecords": "Loading...",
                "processing": "",
                "search": "Pesquisar",
                "zeroRecords": "Nenhum registro encontrado",
                "paginate": {
                    "next": "Próxima",
                    "previous": "Anterior"
                }
            }
        });
    </script>
</main>
<?php include_once('footer.php'); ?>
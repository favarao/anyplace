<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Adicionar Produto</h1>
        </div>
        <div class="card">
            <div class="card-body">
                
            <form id="formulario" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Nome *</label>
                                    <input type="text" name="nome" id="nome" class="form-control"
                                        placeholder="Nome do Produto" required>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">SKU *</label>
                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="SKU"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Valor *</label>
                                    <input type="text" name="valor" id="valor" min="1" class="form-control"
                                        placeholder="Valor do Produto" required>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Estoque *</label>
                                    <input type="text" name="estoque" id="estoque" class="form-control" placeholder="Estoque"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Marca *</label>
                                    <select name="idMarca" id="idMarca" class="form-control" required>
                                        <option value="1">Marca 1</option>
                                        <option value="2">Marca 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Peso </label>
                                    <input type="number" name="peso" id="peso" step="0.01" class="form-control"
                                        placeholder="Peso do Produto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Categoria *</label>
                                    <select name="idCategoria" id="idCategoria" class="form-control" required>
                                        <?php foreach($categorias as $c):?>
                                            <option value="<?=$c->id?>"><?=$c->nome?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Cliente *</label>
                                    <select name="idCliente" id="idCliente" class="form-control" required>
                                        <?php foreach ($clientes as $cliente): ?>
                                            <option value="<?= $cliente->id ?>"><?= $cliente->nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Descrição Resumida *</label>
                                    <input type="text" name="descricaoResumida" id="descricaoResumida" class="form-control"
                                        placeholder="Descrição Resumida do Produto">
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Status *</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Ativo</option>
                                        <option value="2">Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Descrição</label>
                                    <textarea name="descricao" id="descricao" rows="5"
                                        class="form-control">Descrição Completa</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Fotos</label>
                                    <input type="file" name="imagem1" class="form-control my-1">
                                    <input type="file" name="imagem2" class="form-control my-1">
                                    <input type="file" name="imagem3" class="form-control my-1">
                                </div>
                            </div>
                        </div>



                        <div class="row botoes-formulario">
                        <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>

                        <div>
                            <span class="msg-sucesso" style="font-size:20px; font-weight:bold; color:lightgreen;"></span>
                            <a href="/addproduto" class="btn btn-primary botao">Limpar</a>
                            <button type="send" class="btn btn-primary botao">Salvar</button>
                        </div>

                    </div>
                    </form>
            </div>
        </div>
    </div>
    <script>
        $("#idCategoria").select2();
        $('#valor').mask('0.000.000.000,00', {reverse: true});
        $("#formulario").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this)
            $(".msg-sucesso").html('');
            $(".msg-erro").html('');
            $.ajax({
                type: 'POST',
                url: '/insertProduto',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.success == true)
                    {
                        $(".msg-sucesso").html('Sucesso ao cadastrar produto.')
                    setTimeout(function(){
                window.location.href = '/produtos';
            }, 2000);
                    }
                    else
                    {
                        $(".msg-erro").html(data.msg);
                    }
                }
            });

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
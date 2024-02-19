<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Produtos</h1>
        </div>
        <div class="card">
            <div class="card-header p-3">
                <?php if(allow('1')):?>
                <a href="/addproduto" class="btn btn-primary">Adicionar</a>
                <a href="#" onclick="openCSV()" class="btn btn-success">Importar CSV</a>
                <?php endif;?>
            </div>
            <div class="card-body">
                <?php if (!empty($produtos)): ?>
                    <div class="table-responsive">
                        <table id="tabela-produtos" class="">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Nome</th>
                                    <th>Loja</th>
                                    <th>Valor</th>
                                    <th>Estoque</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($produtos)
                                    foreach ($produtos as $produto): ?>
                                        <tr>
                                            <td>
                                                <?= $produto->sku ?? '' ?>
                                            </td>
                                            <td>
                                                <?= $produto->nome ?? '' ?>
                                            </td>
                                            <td>
                                                <?= $produto->loja ?? '' ?>
                                            </td>
                                            <td class="valor">
                                                <?= $produto->valor ?? '' ?>
                                            </td>
                                            <td>
                                                <?= $produto->estoque ?? '' ?>
                                            </td>
                                            <td class="actions">
                                                <a onclick="openModal(<?= $produto->id ?? 0 ?>)" class="table-link"><i
                                                        class="fa-solid fa-pencil"></i></a>
                                                <a onclick="deletar(<?= $produto->id ?? 0 ?>)" class="table-link text-danger"><i
                                                        class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>
                <?php else: ?>
                    <span>Nenhum produto cadastrado.</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="modal" id="editarProduto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Atualizar Produto</h4>
                    <button type="button" onclick="closeModal()" class="close">&times;</button>
                </div>

                <div class="modal-body">
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
                                    <input type="text" name="valor" id="valor" class="form-control"
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
                                        <option value="1">Categoria 1</option>
                                        <option value="2">Categoria 2</option>
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
                                    <div class="fotos mt-3">
                                        <div class="foto"><img id="preview1" style="width:98px; height:98px;" src="" alt=""></div>
                                        <div class="foto"><img id="preview2" style="width:98px; height:98px;" src="" alt=""></div>
                                        <div class="foto"><img id="preview3" style="width:98px; height:98px;" src="" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row botoes-formulario">
                        <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>

                        <div>
                            <span class="msg-sucesso" style="font-size:20px; font-weight:bold; color:lightgreen;"></span>
                            <a onclick="closeModal()" class="btn btn-primary botao">Cancelar</a>
                            <button type="send" class="btn btn-primary botao">Salvar</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalCSV">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Importar CSV</h4>
                    <button type="button" onclick="closeCSV()" class="close">&times;</button>
                </div>

                <div class="modal-body">
                <form id="formulario-csv" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">

                                    <label for="">Cliente</label>
                                    <select name="cliente" id="cliente-csv" class="form-control" <?=allow('2')?'readonly':''?>>
                                            <?php if(allow('1')):?>
                                                <?php foreach ($clientes as $cli):?>
                                                    <option value="<?=$cli->id?>"><?=$cli->nome?></option>
                                                <?php endforeach?>
                                            <?php else:?>
                                                <option value="<?=idUsuario()->id?>"><?=idUsuario()->nome?></option>
                                            <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Arquivo</label>
                                    <input type="file" class="form-control" name="arquivoCSV" id="arquivoCSV">
                                </div>
                            </div>
                        </div>
                        
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
                                    <input type="text" name="valor" id="valor" class="form-control"
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
                                        <option value="1">Categoria 1</option>
                                        <option value="2">Categoria 2</option>
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
                                    <div class="fotos mt-3">
                                        <div class="foto"><img id="preview1" style="width:98px; height:98px;" src="" alt=""></div>
                                        <div class="foto"><img id="preview2" style="width:98px; height:98px;" src="" alt=""></div>
                                        <div class="foto"><img id="preview3" style="width:98px; height:98px;" src="" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row botoes-formulario">
                        <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>

                        <div>
                            <span class="msg-sucesso" style="font-size:20px; font-weight:bold; color:lightgreen;"></span>
                            <a onclick="closeModal()" class="btn btn-primary botao">Cancelar</a>
                            <button type="send" class="btn btn-primary botao">Salvar</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#valor').mask('0.000.000.000,00', {reverse: true});
        // $(".valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        
        $(document).ready(function(){})
        function openModal(id) {
            $.post('/produto/' + id, function (data) {
                $("#id").val(data.id);
                $("#nome").val(data.nome);
                $("#sku").val(data.sku);
                $("#idCategoria").val(data.idCategoria);
                $("#idMarca").val(data.idMarca);
                $("#idCliente").val(data.idCliente);
                $("#valor").val(data.valor).trigger('input');
                $("#estoque").val(data.estoque);
                $("#peso").val(data.peso);
                $("#descricao").val(data.descricao);
                $("#descricaoResumida").val(data.descricaoResumida);
                $("#status").val(data.status);
                $("#preview1").attr('src', `assets/img/produto/${data.id}/${data.foto1}`);
                $("#preview2").attr('src', `assets/img/produto/${data.id}/${data.foto2}`);
                $("#preview3").attr('src', `assets/img/produto/${data.id}/${data.foto3}`);
            });
            
            $("#editarProduto").toggle();
        }
        function closeModal() {
            $('#formulario :input').each(function () {
                $(this).val('');
            });
            $("#editarProduto").toggle();
        }

        function openCSV()
        {
            $("#modalCSV").toggle();
        }

        function closeCSV()
        {
            $("#modalCSV").toggle();
        }

        $("#formulario").submit(function (e) {
            e.preventDefault();
            $.post('/updateProduto', $("#formulario").serialize(), function (data) {
                if (data.success == true) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.msg,
                        icon: 'success',
                    }).then((result) => {
                                if (result.isConfirmed) { location.reload() }
                            });
                    closeModal();
                }
                else {
                    Swal.fire({
                        title: 'Erro!',
                        text: data.msg,
                        icon: 'error',
                    });
                }
            });
        })

        function deletar(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Esta ação não pode ser revertida!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("/deleteProduto/" + id, function (data) {
                        if (data.success == true) {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: data.msg,
                                icon: 'success',
                            }).then((result) => {
                                if (result.isConfirmed) { location.reload() }
                            })
                        }
                        else {
                            Swal.fire({
                                title: 'Erro!',
                                text: data.msg,
                                icon: 'error',
                            }).then((result) => {
                                if (result.isConfirmed) { location.reload() }
                            })
                        }
                    });
                }
            });
        }


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
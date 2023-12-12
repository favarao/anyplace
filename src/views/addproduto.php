<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Adicionar Produto</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nome *</label>
                            <input type="text" class="form-control" placeholder="Nome do Produto">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">SKU *</label>
                            <input type="text" class="form-control" placeholder="SKU do Produto">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Marca *</label>
                            <input type="text" class="form-control" placeholder="Marca do Produto">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Peso </label>
                            <input type="text" class="form-control" placeholder="Peso do Produto">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Categoria *</label>
                            <input type="text" class="form-control" placeholder="Categoria do Produto">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Cliente *</label>
                            <select name="" id="" class="form-control">
                                <option value="">Selecione...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Descrição Resumida *</label>
                            <input type="text" class="form-control" placeholder="Descrição Resumida do Produto">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Status *</label>
                            <select name="" id="" class="form-control">
                                <option value="">Ativo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Descrição</label>
                            <textarea name="" id="" rows="5" class="form-control">Descrição Completa</textarea>
                        </div>
                    </div>
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Fotos</label>
                            <input type="file" class="form-control">
                            <div class="fotos mt-3">
                                <div class="foto"></div>
                                <div class="foto"></div>
                                <div class="foto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row botoes-formulario">
                <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>
                
                <div>
                <a href="" class="btn btn-primary botao">Cancelar</a>
                <a href="" class="btn btn-primary botao">Salvar</a>
                </div>
                
                </div>
            </div>
        </div>
    </div>
    <script>
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
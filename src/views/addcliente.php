<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Adicionar Cliente</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nome *</label>
                            <input type="text" class="form-control" placeholder="Nome do Cliente">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Loja *</label>
                            <input type="text" class="form-control" placeholder="Nome da Loja">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">CNPJ *</label>
                            <input type="text" class="form-control" placeholder="00.000.000/0000-00">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="text" class="form-control" placeholder="exemplo@exemplo.com.br">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Telefone *</label>
                            <input type="text" class="form-control" placeholder="(00)0000-0000">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Celular *</label>
                            <input type="text" class="form-control" placeholder="(00)00000-0000)">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Endereço *</label>
                            <input type="text" class="form-control" placeholder="Rua,Nº,Complemento,Bairro">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="" id="" class="form-control">
                                <option value="">Ativado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nome de contato *</label>
                            <input type="text" class="form-control" placeholder="Nome - Cargo">
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
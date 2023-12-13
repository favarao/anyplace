<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Clientes</h1>
        </div>
        <div class="card">
        <div class="card-header p-3">
                    <a href="cliente-adicionar.php" class="btn btn-primary">Adicionar</a>
                </div>
            <div class="card-body">
                <?php if(!empty($clientes)):?>
                <div class="table-responsive">
                    <table id="tabela-clientes">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Loja</th>
                                <th>Tel/Cel</th>
                                <th>Email</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($clientes)
                            foreach($clientes as $cliente): ?>
                            <tr>
                                <td><?=$cliente->nome?></td>
                                <td><?=$cliente->loja?></td>
                                <td>(18)99999-9999</td>
                                <td>joao@kabum.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>   
                            </tr>
                            <?php endforeach;?>
                            
                        </tbody>

                    </table>
                </div>
                <?php else:?>
                    <span>Nenhum cliente cadastrado.</span>
                <?php endif;?>
            </div>
        </div>
    </div>
    <script>
        $('#tabela-clientes').DataTable({
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
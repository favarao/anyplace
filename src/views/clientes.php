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
                            foreach($clientes as $clientes): ?>
                            <tr>
                                <td>João</td>
                                <td>KABUM</td>
                                <td>(18)99999-9999</td>
                                <td>joao@kabum.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>   
                            </tr>
                            <?php endforeach;?>
                            <tr>
                                <td>Maria</td>
                                <td>KALUNGA</td>
                                <td>(18)99999-9999</td>
                                <td>maria@kalunga.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Pedro</td>
                                <td>TORRA</td>
                                <td>(18)99999-9999</td>
                                <td>pedro@torra.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Bruna</td>
                                <td>MAGALU</td>
                                <td>(18)99999-9999</td>
                                <td>bruna@magalu.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>João</td>
                                <td>KABUM</td>
                                <td>(18)99999-9999</td>
                                <td>joao@kabum.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Maria</td>
                                <td>KALUNGA</td>
                                <td>(18)99999-9999</td>
                                <td>maria@kalunga.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Pedro</td>
                                <td>TORRA</td>
                                <td>(18)99999-9999</td>
                                <td>pedro@torra.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Gabrielle</td>
                                <td>MAGALU</td>
                                <td>(18)99999-9999</td>
                                <td>bruna@magalu.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>João</td>
                                <td>KABUM</td>
                                <td>(18)99999-9999</td>
                                <td>joao@kabum.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Maria</td>
                                <td>KALUNGA</td>
                                <td>(18)99999-9999</td>
                                <td>maria@kalunga.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Pedro</td>
                                <td>TORRA</td>
                                <td>(18)99999-9999</td>
                                <td>pedro@torra.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Bruna</td>
                                <td>MAGALU</td>
                                <td>(18)99999-9999</td>
                                <td>bruna@magalu.com.br</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
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
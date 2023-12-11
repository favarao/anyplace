<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Produtos</h1>
        </div>
        <div class="card">
        <div class="card-header p-3">
                    <a href="addproduto" class="btn btn-primary">Adicionar</a>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabela-produtos">
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
                            <tr>
                                <td>PEN-1234</td>
                                <td>Pendrive</td>
                                <td>KABUM</td>
                                <td>R$ 40,00</td>
                                <td>20</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>LAP-4321</td>
                                <td>Lapis</td>
                                <td>KALUNGA</td>
                                <td>R$ 3,00</td>
                                <td>10</td>
                                <td class="actions">
                                    <a href="" class="table-link"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="" class="table-link text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>BER-4324</td>
                                <td>Bermuda</td>
                                <td>TORRA</td>
                                <td>R$ 20,00</td>
                                <td>50</td>
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
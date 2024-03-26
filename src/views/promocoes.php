<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Promoções</h1>
        </div>
        <div class="card">
            <div class="card-header p-3">
                <a href="/gerenciarPromocao" class="btn btn-primary">Adicionar</a>
            </div>
            <div class="card-body">
                <?php if (!empty($clientes)): ?>
                    <div class="table-responsive">
                        <table id="tabela-promocoes">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Cliente</th>
                                    <th>Data Inicial</th>
                                    <th>Data Final</th>
                                    <th>Valor</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($promocoes)
                                    foreach ($promocoes as $promocao): ?>
                                        <tr>
                                            <td>
                                                <?= $promocao->titulo ?? '' ?>
                                            </td>
                                            <td>
                                                <?= $promocao->nomeCliente ?? '' ?>
                                            </td>
                                            <td>
                                                <?=$promocao->dataInicial??''?>
                                            </td>
                                            <td>
                                                <?= $promocao->datafinal ?? '' ?>
                                            </td>
                                            <td class="actions">
                                                <a href="/gerenciarPromocao/<?-$promocao->id?>" class="table-link"><i
                                                        class="fa-solid fa-pencil"></i></a>
                                                <a onclick="deletar(<?= $promocao->id ?? 0 ?>)" class="table-link text-danger"><i
                                                        class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>
                <?php else: ?>
                    <span>Nenhum cliente cadastrado.</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        $("#formulario").submit(function (e) {
            e.preventDefault();
            $.post('/save', $("#formulario").serialize(), function (data) {
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
                    $.post("/deletePromocao/" + id, function (data) {
                        if (data.success == true) {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: data.msg,
                                icon: 'success',
                            }).then((result) => {
                if (result.isConfirmed) {location.reload()}})
                        }
                        else {
                            Swal.fire({
                                title: 'Erro!',
                                text: data.msg,
                                icon: 'error',
                            }).then((result) => {
                if (result.isConfirmed) {location.reload()}})
                        }
                    });
                }
            });
        }


        $('#tabela-promocoes').DataTable({
            "order": [[0, "asc"]],
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
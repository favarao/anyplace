<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Clientes</h1>
        </div>
        <div class="card">
            <div class="card-header p-3">
                <a href="/addcliente" class="btn btn-primary">Adicionar</a>
            </div>
            <div class="card-body">
                <?php if (!empty($clientes)): ?>
                    <div class="table-responsive">
                        <table id="tabela-clientes">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Loja</th>
                                    <th>Cel/Tel</th>
                                    <th>Email</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($clientes)
                                    foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td>
                                                <?= $cliente->nome ?? '' ?>
                                            </td>
                                            <td>
                                                <?= $cliente->loja ?? '' ?>
                                            </td>
                                            <td>
                                                <?= ($cliente->celular ? $cliente->celular : $cliente->telefone) ?? '' ?>
                                            </td>
                                            <td>
                                                <?= $cliente->email ?? '' ?>
                                            </td>
                                            <td class="actions">
                                                <a onclick="openModal(<?= $cliente->id ?? 0 ?>)" class="table-link"><i
                                                        class="fa-solid fa-pencil"></i></a>
                                                <a onclick="deletar(<?= $cliente->id ?? 0 ?>)" class="table-link text-danger"><i
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
    <div class="modal" id="editarCliente">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Atualizar Cliente</h4>
                    <button type="button" onclick="closeModal()" class="close">&times;</button>
                </div>

                <div class="modal-body">
                    <form id="formulario" method="POST">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Nome *</label>
                                    <input type="text" name="nome" id="nome" class="form-control"
                                        placeholder="Nome do Cliente" required>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Loja *</label>
                                    <input type="text" name="loja" id="loja" class="form-control"
                                        placeholder="Nome da Loja" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">CNPJ *</label>
                                    <input type="text" name="cnpj" id="cnpj" class="form-control" minlength="18"
                                        maxlength="18" placeholder="00.000.000/0000-00" required>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="exemplo@exemplo.com.br" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Telefone *</label>
                                    <input type="text" name="telefone" id="telefone" class="form-control"
                                        placeholder="(00)0000-0000" required>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Celular *</label>
                                    <input type="text" name="celular" id="celular" class="form-control"
                                        placeholder="(00)00000-0000)" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Endereço *</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control"
                                        placeholder="Rua,Nº,Complemento,Bairro" required>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1">Ativado</option>
                                        <option value="0">Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Nome de contato *</label>
                                    <input type="text" name="contato" id="contato" class="form-control"
                                        placeholder="Nome - Cargo" required>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="">Login *</label>
                                    <input type="text" name="login" id="login" class="form-control"
                                        placeholder="Usuario" required>
                                </div>
                            </div>
                        </div>

                        <div class="row botoes-formulario">
                            <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>
                            <div class="modal-footer">
                                <button type="send" class="btn btn-primary" onclick>Salvar</button>
                                <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancelar</button>
                            </div>
                    </form>
                </div>



            </div>
        </div>
    </div>

    <script>
        $('#cnpj').mask('00.000.000/0000-00', { reverse: true });

        // Máscara para telefone
        $('#telefone').mask('(00) 0000-0000');

        // Máscara para celular
        $('#celular').mask('(00) 0000-00009').focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask('(00) 00000-0009');
            } else {
                element.mask('(00) 0000-00009');
            }
        });

        function openModal(id) {
            $.post('/cliente/' + id, function (data) {
                $("#id").val(data.id);
                $("#nome").val(data.nome);
                $("#loja").val(data.loja);
                $("#email").val(data.email);
                $("#cnpj").val(data.cnpj).trigger('input');
                $("#celular").val(data.celular).trigger('input');
                $("#telefone").val(data.telefone).trigger('input');
                $("#endereco").val(data.endereco);
                $("#status").val(data.status);
                $("#contato").val(data.contato);
                $("#login").val(data.login);
            });
            $("#editarCliente").toggle();
        }
        function closeModal() {
            $('#formulario :input').each(function () {
                $(this).val('');
            });
            $("#editarCliente").toggle();
        }

        $("#formulario").submit(function (e) {
            e.preventDefault();
            $.post('/updateCliente', $("#formulario").serialize(), function (data) {
                if (data.success == true) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.msg,
                        icon: 'success',
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
                    $.post("/deleteCliente/" + id, function (data) {
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
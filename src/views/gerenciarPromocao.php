<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>Gerenciar Promoção</h1>
        </div>
        <div class="card">
            <div class="card-body">

                <form id="formulario" method="POST">
                    <input type="hidden" name="id" value="<?=$promocao->id??''?>">
                    <div class="row">
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Titulo *</label>
                                <input type="text" name="titulo" id="titulo" value="<?= $promocao->titulo ?? '' ?>" required class="form-control" placeholder="Título da Promoção">
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Cliente *</label>
                                <select name="idCliente" id="cliente" required class="form-control">
                                    <option value="">Selecione...</option>
                                    <?php foreach ($clientes as $cliente) : ?>
                                        <option value="<?= $cliente->id ?>" <?= ($promocao->idCliente ?? '') == $cliente->id ? 'selected' : '' ?>><?= $cliente->nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Data Inicial *</label>
                                <input type="date" name="dataInicial" id="dataInicial" max="9999-12-31" value="<?= $promocao->dataInicial ?? '' ?>" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Data Final *</label>
                                <input type="date" name="dataFinal" id="dataFinal" max="9999-12-31" value="<?= $promocao->dataFinal ?? '' ?>" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Porcentagem *</label>
                                <input type="number" step="0.01" min="1" max="99" name="valor" id="porcentagem" value="<?= $promocao->valor ?? '' ?>" required class="form-control" placeholder="Porcentagem Sobre o Produto">
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
                                <?php if (isset($listaProdutos)) : ?>
                                    <?php foreach ($listaProdutos as $p) : ?>
                                        <tr>
                                            <td class="sku"><?= $p->sku ?></td>
                                            <td><?= $p->nome ?></td>
                                            <td class="valor"><?= $p->valor ?></td>
                                            <td class="atualizaValor"><?= $p->valor ?></td>
                                            <td><a onclick="deletar('<?=$p->sku?>','<?=$p->id?>')" class="table-link text-danger pointer"><i class="fa-solid fa-trash"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row botoes-formulario">
                        <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>

                        <div>
                            <a href="/promocoes" class="btn btn-primary botao">Cancelar</a>
                            <button class="btn btn-primary botao">Salvar</button>
                        </div>

                    </div>
                    <input type="hidden" id="produtos" name="produtos" value="<?=$produtos??''?>">
                    <input type="hidden" id="status" name="status" value="<?=$promocao->status??1?>">
                </form>
                
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#produto").select2();
            if ($("#cliente").val())
            $.post("/getProdutos/" + $("#cliente").val(), function(data) {
                $("#produto").empty();
                $("#produto").append($('<option>', {
                    value: '',
                    text: 'Selecione'
                }));
                $.each(data, function(index, produto) {
                    $("#produto").append($('<option>', {
                        value: produto.id,
                        text: produto.nome
                    }));
                });
            });
        });

        function atualizaValores() {
            $('td.valor').each(function() {
                var valorAtual = parseFloat($(this).text());
                var porcentagem = $("#porcentagem").val() ? $("#porcentagem").val() : 0;
                var novoValor = valorAtual * (1 - (parseFloat(porcentagem)) / 100);

                $(this).closest('tr').find('td.atualizaValor').text(novoValor.toFixed(2));
            });
        }

        $("#porcentagem").on('input', function() {
            atualizaValores();
        })

        function adicionarProduto() {
            produtos = $("#produtos").val().split(',');
            id = $("#produto").val();
            porcentagem = $("#porcentagem").val();
            if ($.inArray(id, produtos) !== -1) {
                Swal.fire({
                        title: 'Erro!',
                        text: "Produto já na lista.",
                        icon: 'error',
                    });
            } else {
                if ($.inArray(id, produtos < 0)) {
                    if (produtos == '')
                        $("#inserir").html('');
                    $.post("/produto/" + id, function(data) {
                        var newRow = [
                            data.sku, 
                            data.nome,
                            data.valor,
                            data.valor,
                            `<a onclick="deletar('${data.sku}','${data.id}')" class="table-link text-danger pointer"><i class="fa-solid fa-trash"></i></a>`
                        ];

                        // Adiciona a nova linha ao DataTable
                        $("#tabela-produtos").DataTable().row.add(newRow).draw();
                        atualizaValores();
                    });
                    produtos.push(id);
                    $("#produtos").val(produtos.join(','));

                }
            }


        }

        function deletar(sku, id) {
            produtos = $("#produtos").val().split(',');
            produtos = $.grep(produtos, function(valor) {
                return valor !== id;
            });
            $("#produtos").val(produtos.join(','));
            var row = $('td').filter(function() {
                return $(this).text() === `${sku}`;
            }).closest('tr');
            $("#tabela-produtos").DataTable().row(row).remove().draw();
        }

        $("#cliente").change(function() {
            $.post("/getProdutos/" + $("#cliente").val(), function(data) {
                $("#produto").empty();
                $("#produto").append($('<option>', {
                    value: '',
                    text: 'Selecione'
                }));
                $.each(data, function(index, produto) {
                    $("#produto").append($('<option>', {
                        value: produto.id,
                        text: produto.nome
                    }));
                });
            });
        });


        $("#formulario").submit(function(e) {
            e.preventDefault();
            var dataInicial = new Date($('#dataInicial').val());
            var dataFinal = new Date($('#dataFinal').val());
            var hoje = new Date();

            if (!(dataInicial <= dataFinal && dataInicial >= hoje && dataFinal >= hoje)) {
                Swal.fire({
                        title: 'Erro!',
                        text: "Intervalo de datas inválido.",
                        icon: 'error',
                    });
                return;
            }

            $.post("/adicionarPromocao",$("#formulario").serialize(),function(data){
                if(data.result == true)
                window.location.href = '/promocoes';
            });

        });
        $('#tabela-produtos').DataTable({
            columnDefs: [
            { targets: 0, className: 'sku' },
            { targets: 2, className: 'valor' },
            { targets: 3, className: 'atualizaValor' }
        ],
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
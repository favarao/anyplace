<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p3">
    <div class="row">
            <h1>Negociar Comissão</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <form id="form-comissao">
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Cliente *</label>
                            <select name="idPessoa" id="idPessoa" required class="form-control">
                                <option value="">Selecione um Cliente</option>
                                <?php foreach ($clientes as $c):?>
                                    <option value="<?=$c->idPessoa?>"><?=$c->novoValor||$c->novoTipo||$c->novoInicio||$c->novoFinal?'PENDENTE - '.$c->nome:''.$c->nome?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Forma Atual</label>
                            <select disabled name="tipo" id="tipo" class="form-control">
                                <option value="F">Fixo</option>
                                <option value="P">Porcentagem</option>
                            </select>
                        </div>
                    </div>
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Comissão Atual</label>
                            <input  disabled type="number" name="valor" id="valor" class="form-control" value="">
                        </div>
                    </div>
                    
                    
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Data Inicial *</label>
                            <input type="date" name="dataInicial" required id="dataInicial" disabled class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Data Final *</label>
                            <input type="date" name="dataFinal" required id="dataFinal" disabled class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nova Forma *</label>
                            <select name="novoTipo" id="novoTipo" required class="form-control">
                            <option value="F">Fixo</option>
                            <option value="P">Porcentagem</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Novo Valor *</label>
                            <input type="text" id="novoValor" required name="novoValor" class="form-control">
                        </div>
                    </div>
                    </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nova Data Inicial *</label>
                            <input type="date" max="9999-12-31" name="novoInicio" required id="novoInicio"  class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nova Data Final *</label>
                            <input type="date" max="9999-12-31" name="novoFinal" required id="novoFinal" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row botoes-formulario">
                <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>
                
                <div>
                <a href="#" style="display:none;" onclick="recusar()" class="btn btn-primary recusar">Recusar</a>
                <button type="send" class="btn btn-primary salvar botao">Salvar</button>
                </div>
                
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function recusar(){
            $.post("/recusarNegociacao",$("#form-comissao").serialize(),function(data){
                location.reload();
            });
        }
        $("#form-comissao").submit(function(e){
            e.preventDefault();
            if($("#novoInicio").val()>=$("#novoFinal").val())
            {
                Swal.fire({
                        title: 'Erro!',
                        text: "Intervalo de datas inválido.",
                        icon: 'error',
                    });
                return;
            }
            if($(".salvar").hasClass('aceitar'))
            {
                $.post("/aceitarComissao",$("#form-comissao").serialize(),function(data){
                    location.reload();
                })
                
            }
            else
            $.post("/atualizaComissao",$("#form-comissao").serialize(),function(data){
                if(data.result == true)
                {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.msg,
                        icon: 'success',
                    }).then((result) => {
                                if (result.isConfirmed) { location.reload() }
                            });
                }
                else
                Swal.fire({
                        title: 'Erro!',
                        text: data.msg,
                        icon: 'error',
                    }).then((result) => {
                                if (result.isConfirmed) { location.reload() }
                            });
            });
        })

        $("#idPessoa").change(function(){
            $.post("/buscaNegociacao/"+$("#idPessoa").val(),function(data){
                $("#tipo").val(data.tipo);
                $("#valor").val(data.valor);
                $("#dataInicial").val(data.dataInicial);
                $("#dataFinal").val(data.dataFinal);
                $("#novoValor").val(data.novoValor);
                $("#novoTipo").val(data.novoTipo);
                $("#novoInicio").val(data.novoInicio);
                $("#novoFinal").val(data.novoFinal);
                if(data.novoValor || data.novoTipo || data.novoInicio || data.novoFinal)
                {
                    $(".salvar").html("Aceitar");
                    $(".salvar").addClass('aceitar');
                    $(".recusar").show();
                }
                else
                {
                    $(".salvar").html("Salvar");
                    $(".salvar").removeClass('aceitar');
                    $(".recusar").hide();
                }
            });
        })

        $("#idPessoa").select2();
    </script>
</main>
<?php include_once('footer.php'); ?>
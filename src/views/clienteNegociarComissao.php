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
                            <input type="text" class="form-control" value="<?=$cliente->nome?>" disabled>
                            <input type="hidden" name="idPessoa" value="<?=$cliente->id??''?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Forma Atual</label>
                            <select disabled name="tipo" id="tipo" class="form-control">
                                <option value="F" <?=$comissao->tipo=='F'?'selected':''?>>Fixo</option>
                                <option value="P" <?=$comissao->tipo=='P'?'selected':''?>>Porcentagem</option>
                            </select>
                        </div>
                    </div>
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Comissão Atual</label>
                            <input  disabled type="number" name="valor" id="valor" class="form-control" value="<?=$comissao->valor?>">
                        </div>
                    </div>
                    
                    
                </div>
                <div class="row">
                <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Data Inicial *</label>
                            <input type="date" name="dataInicial" value="<?=$comissao->dataInicial?>" id="dataInicial" disabled class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Data Final *</label>
                            <input type="date" name="dataFinal" value="<?=$comissao->dataFinal?>" disabled id="dataFinal" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nova Forma *</label>
                            <select name="novoTipo" id="novoTipo" required class="form-control">
                            <option value="F" <?=$comissao->novoTipo=='F'?'selected':''?>>Fixo</option>
                            <option value="P" <?=$comissao->novoTipo=='P'?'selected':''?>>Porcentagem</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Novo Valor *</label>
                            <input type="text" id="novoValor" min="1" required name="novoValor" value="<?=$comissao->novoValor?>" class="form-control">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nova Data Inicial *</label>
                            <input type="date" max="9999-12-31" min="<?=date('Y-m-d');?>" name="novoInicio" value="<?=$comissao->novoInicio?>" required id="novoInicio" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nova Data Final *</label>
                            <input type="date" max="9999-12-31" min="<?=date('Y-m-d');?>" name="novoFinal" value="<?=$comissao->novoFinal?>" required id="novoFinal" class="form-control">
                        </div>
                    </div>
                    </div>
                    
                
                <div class="row botoes-formulario">
                <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>
                
                <div>
                <button type="send" class="btn btn-primary botao">Solicitar</button>
                </div>
                
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
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
            $.post("/solicitarComissao",$("#form-comissao").serialize(),function(data){
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

    </script>
</main>
<?php include_once('footer.php'); ?>
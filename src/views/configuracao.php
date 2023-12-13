<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1><?=$titulo??''?></h1>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" id="formulario" action="/">
                <input type="hidden" name="id" value="1">
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Nome do sistema *</label>
                            <input type="text" name="nomeSistema" id="nomeSistema" class="form-control" value="<?=$param->nomeSistema??''?>" placeholder="Nome do sistema" required>
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Proprietário do Sistema *</label>
                            <input type="text" name="nomeAdministrador" id="nomeAdministrador" class="form-control" value="<?=$param->nomeAdministrador??''?>" placeholder="Dono do sistema" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Logo *</label>
                            <input type="file" name="logo" id="logo" class="form-control" value="<?=$param->logo?>">
                            <div class="imagem-atual">
                                <?php if(isset($param->logo) && $param->logo!=''): ?>
                                    <img src="assets/img/<?=$param->logo??''?>" alt="">
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
               
                
                <div class="row botoes-formulario">
                <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>
                
                <div>
                <button type="send" class="btn btn-primary botao">Salvar</button>
                </div>
                
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("#formulario").submit(function(e){
            e.preventDefault();
            $.post('/insertCliente',$("#formulario").serialize(),function(data){
                console.log(data);
            });
            
        })
    </script>
</main>
<?php include_once('footer.php'); ?>
<?php require_once __DIR__ . '/header.php'; ?>

<section>
    <main>
        <div class="container-fluid p-3">

            <div class="card">
                <div class="card-body">
                    <?php if (isset($_SESSION['alterar'])): ?>
                        <div class="row">
                            <h1>Alterar senha inicial</h1>
                        </div>
                        <form id="form-changepass">
                            <div class="row">
                                <div class="col-md-6 p-3">
                                    <div class="form-group">
                                        <label for="">Nova senha*</label>
                                        <input type="password" name="novaSenha" class="form-control"
                                            placeholder="Nova senha">
                                    </div>
                                </div>
                                <div class="col-md-6 p-3">
                                    <div class="form-group">
                                        <label for="">Repetir senha *</label>
                                        <input type="password" name="novaSenha2" class="form-control"
                                            placeholder="Nova senha">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <span class="msg-erro"></span>
                            </div>

                            <div class="row botoes-formulario">
                                <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>

                                <div>
                                    <button class="btn btn-primary botao" type="button" onclick="enviar()">Salvar</button>
                                </div>

                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center">
                            <p style="font-size:50px;" class="bem-vindo"><?=$param->nomeSistema??''?></p>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>
        <script>
            function enviar() {
                $.post('/alterarSenhaInicial', $("#form-changepass").serialize(), function (data) {
                    $(".msg-erro").html(data.msg);
                    console.log(data);
                })
            }
        </script>
    </main>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>
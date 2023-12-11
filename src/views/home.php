<?php require_once __DIR__ . '/header.php'; ?>

<section>
    <main>
        <div class="container-fluid p-3">
            
            <div class="card">
                <div class="card-body">
                    <?php if ($_SESSION['alterar']): ?>
                        <div class="row">
                <h1>Alterar senha inicial</h1>
            </div>
                        <form action="changepass" method="POST">
                            <div class="row">
                                <div class="col-md-6 p-3">
                                    <div class="form-group">
                                        <label for="">Nova senha*</label>
                                        <input type="password" class="form-control" placeholder="Nome do Cliente">
                                    </div>
                                </div>
                                <div class="col-md-6 p-3">
                                    <div class="form-group">
                                        <label for="">Repetir senha *</label>
                                        <input type="password" class="form-control" placeholder="Nome da Loja">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <span class="msg-erro"></span>
                            </div>

                            <div class="row botoes-formulario">
                                <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>

                                <div>
                                    <a href="" class="btn btn-primary botao">Cancelar</a>
                                    <a href="" class="btn btn-primary botao">Salvar</a>
                                </div>

                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center">
                            <p class="bem-vindo">Bem Vindo</p>
                        </div>
                    <?php endif; ?>
                    <div class="text-center">
                            <p style="font-size:50px;" class="bem-vindo">AnyPlace</p>
                        </div>2

                </div>
            </div>
        </div>
        <script>
        </script>
    </main>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>
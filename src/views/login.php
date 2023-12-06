<?php
require_once __DIR__ . '/head.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    AnyPlace
                </div>
                <div class="card-body">
                    <form id="form-login">
                        <div class="form-group">
                            <label for="username">Usuário:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario"
                                placeholder="Digite seu usuário">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control" name="senha" id="senha"
                                placeholder="Digite sua senha">
                        </div>
                        <button type="button" onclick="logar()" class="btn btn-primary mt-2">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function logar() {
        $.post("logar", $("#form-login").serialize(), function (resultado) {
            if(resultado == true)
                console.log("verda");
            else
                console.log("falso");
            console.log(resultado);
        });
    }

</script>
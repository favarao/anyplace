<?php 
require_once __DIR__.'/head.php';
?>

<form class="form-login" action="logar" method="POST">

    <div class="form-group">
        <label for="">Login</label>
        <input type="text" name="usuario">
        <label for="">Senha</label>
        <input type="password" name="senha">
        <button class="btn">Logar</button>
    </div>
</form>
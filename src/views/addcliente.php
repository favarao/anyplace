<?php include_once('header.php'); ?>
<main>
    <div class="container-fluid p-3">
        <div class="row">
            <h1>
                <?= $titulo ?? '' ?>
            </h1>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" id="formulario">
                    <input type="hidden" name="id" value="">
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
                                <input type="text" name="loja" id="loja" class="form-control" placeholder="Nome da Loja"
                                    required>
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
                                <input type="text" name="login" id="login" class="form-control" placeholder="Usuario"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row botoes-formulario">
                        <div><span class="campo-obrigatorio">* campos obrigatórios</span></div>

                        <div>
                            <span class="msg-sucesso" style="font-size:20px; font-weight:bold; color:lightgreen;"></span>
                            <a href="/addcliente" class="btn btn-primary botao">Limpar</a>
                            <button type="send" class="btn btn-primary botao">Salvar</button>
                        </div>

                    </div>
                </form>
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
        $("#formulario").submit(function (e) {
            e.preventDefault();
            $.post('/insertCliente', $("#formulario").serialize(), function (data) {
                if(data.success == true)
                {
                    $(".msg-sucesso").html('Sucesso ao cadastrar cliente.')
                    setTimeout(function(){
                // Redirecionar para outra página
                window.location.href = '/clientes';
            }, 2000); // 2000 milissegundos = 2 segundos
                }
                else
                {}
            });

        })
    </script>
</main>
<?php include_once('footer.php'); ?>
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
                <form method="POST" enctype="multipart/form-data" id="formulario">
                    <input type="hidden" name="id" value="1">
                    <div class="row">
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Nome do sistema *</label>
                                <input type="text" name="nomeSistema" id="nomeSistema" class="form-control"
                                    value="<?= $param->nomeSistema ?? '' ?>" placeholder="Nome do sistema" required>
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Proprietário do Sistema *</label>
                                <input type="text" name="nomeAdministrador" id="nomeAdministrador" class="form-control"
                                    value="<?= $param->nomeAdministrador ?? '' ?>" placeholder="Dono do sistema" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-3">
                            <div class="form-group">
                                <label for="">Logo *</label>
                                <input type="file" name="logo" id="logo" class="form-control" value="">
                                <div class="imagem-atual d-flex align-items-center justify-content-center mt-3">
                                    <img class="logo-preview" style="width:200px;" src="<?=file_exists("assets/img/logo.png")?'assets/img/logo.png':''?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="msg-erro">
                        <?= $msg ?? '' ?>
                    </div>
                    <div class="msg-sucesso">
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
    <form action="/configuracao" method="POST" id="reload">
    <input type="hidden" id="msg" name="msg" value="<?=$msg??''?>">
    </form>
    <script>
        $("#logo").change(function () {
            $('.imagem-atual').html('');
        });


        $("#formulario").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this)
            $(".msg-sucesso").html('');
            $(".msg-erro").html('');
            $.ajax({
                type: 'POST',
                url: '/attParam',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.success == true)
                    {
                        $("#msg").val(data.msg);
                        $(".logo-preview").attr("src", 'assets/img/logo.png');
                        $("#reload").submit();
                    }
                    else
                    {
                        $(".msg-erro").html(data.msg);
                    }
                }
            });

        });

//         function getFormData(formId) {
//     var formData = new FormData();
//     var formInputs = $(formId).find(':input');

//     formInputs.each(function(index, element) {
//         var input = $(element);

//         if (input.attr('type') === 'file') {
//             formData.append(input.attr('name'), input[0].files[0]);
//         } else {
//             formData.append(input.attr('name'), input.val());
//         }
//     });

//     return formData;
// }
    </script>
</main>
<?php include_once('footer.php'); ?>
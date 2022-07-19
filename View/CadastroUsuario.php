<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastro Usuario</title>
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">


</head>

<body style=" background-image: url(../img/fundo8.jpg)">
    <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div class="col-sm-10">
                    <h3 style="color: #fcfdfd;">Cadastro de Usuário</h3>

                    <?php
                    if (isset($_POST['confirmarEnvio'])) {
                        include_once '../Controller/FuncoesControllerUsuario.php';
                        $fcu = new FuncoesControllerUsuario();
                        $msg = $fcu->inserirUsuario($_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['senha'], $_POST['confirmarSenha'], '1', '0');

                        echo $msg;
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                               URL='../index.php'\">";
                    }
                    ?>
                </div>
                <form method="post">
                    <div class=" col-sm-8 " class="form-group">
                        <label style="color: #fcfdfd" for="nome">Nome completo:</label>
                        <input type="text" class="form-control" name="nome" required="required" />
                    </div>
                    <div class="col-sm-10"></div>
                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Telefone:</label>
                        <input type="tel" class="form-control" name="telefone" id="telefone" required="required" onkeypress="updateMask(this)" />
                    </div>

                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Email:</label>
                        <input type="text" class="form-control" name="email" required="required" />
                    </div>
                    <div class="col-sm-10"></div>
                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Senha:</label>
                        <input type="password" class="form-control" name="senha" required="required" />
                    </div>
                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Confirmar Senha:</label>
                        <input type="password" class="form-control" name="confirmarSenha" required="required" />
                    </div>
                    <div class="col-sm-10"></div>
                    <!--                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Perfil:</label>
                        <select class="form-control" name="perfil" />
                        <option>-</option>
                        <option value="0">Administrador</option>
                        <option value="1">Usuário</option>
                        </select>
                    </div>-->

                    <!--                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Situação:</label>
                        <select class="form-control" name="ativo" required="required">
                            <option value="0">Ativo</option>
                            <option value="1">Inativo</option>
                        </select>
                    </div>-->
                    <div class="col-sm-12" class="form-group">
                        <input type="submit" value="Enviar" class="btn-success" name="confirmarEnvio" />
                        <input type="reset" value="Limpar" class="btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../s/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/casa.js"></script>
    <script src="../js/main.js"></script>

    <!-- <script type="text/javascript">
        function mascara(telefone) {
            if (telefone.value.length == 0)
                telefone.value = '(' + telefone.value; //quando começamos a digitar, o script irá inserir um parênteses no começo do campo.
            if (telefone.value.length == 3)
                telefone.value = telefone.value + ') '; //quando o campo já tiver 3 caracteres (um parênteses e 2 números) o script irá inserir mais um parênteses, fechando assim o código de área.
            if (telefone.value.length == 10)
                telefone.value = telefone.value + '-';
            //if (telefone.value.length == 10)
            // telefone.value = telefone.value + '-'; //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone.

        }
    </script> -->
    <script>
        $('.phone-mask').each(function(i, el) {
            $('#' + el.id).mask("(00) 00000-0000");
        })

        function updateMask(event) {
            var $element = $('#' + this.id);
            $(this).off('blur');
            $element.unmask();
            if (this.value.replace(/\D/g, '').length > 10) {
                $element.mask("(00) 00000-0000");
            } else {
                $element.mask("(00) 0000-00009");
            }
            $(this).on('blur', updateMask);
        }
        $('.phone-mask').on('blur', updateMask);
    </script>

</body>

</html>
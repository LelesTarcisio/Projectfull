<?php
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION['perfil']!='0' || !isset($_SESSION['perfil'])){
    header("Location: ../Controller/derruba_session.php");
    exit();
}
/* include("../Model/Conecta.php"); */
include_once '../Controller/FuncoesControllerUsuario.php';

/* include_once '../css/estilo.css'; */
if(!isset($_SESSION['perfil']) || $_SESSION['perfil']!='0'){
    header('Location: logout.php');
    exit();
}
$fcu = new FuncoesControllerUsuario();
$linhasUsuario = $fcu->pesquisaUsuario();
//$id = $fcu->proximoCodigoUsuario();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastro Usuário</title>
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
                <h3 style="color: #fcfdfd;" >Cadastro de Usuário</h3>
                
                <?php
                if (isset($_POST['confirmarEnvio'])) {
                    include_once '../Controller/FuncoesControllerUsuario.php';
                    $fcu = new FuncoesControllerUsuario();
                    $msg = $fcu->inserirUsuarioComum($_POST['id_usuario'], $_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['senha'], $_POST['confirmarSenha'], $_POST['perfil'], $_POST['ativo']);

                    echo $msg;
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                               URL='CadastroUsuario.php'\">";
                }
                ?>
                </div>
                <form method="post">
                    <div class="form-group">
                        <label hidden style="color: #fcfdfd" for="nome">Código: </label>
                        <label hidden for="nome"><?php echo $id; ?></label>
                        <input type="hidden" class="form-control" name="id_usuario" value="<?php echo $id; ?>" />
                    </div>
                    <div class=" col-sm-8 " class="form-group">
                        <label style="color: #fcfdfd" for="nome">Nome completo:</label>
                        <input type="text" class="form-control" name="nome" required="required" />
                    </div>
                    <div class="col-sm-10"></div>
                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" required="required" onkeypress="mascara(this)" maxlength=14 />
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
                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Perfil:</label>
                        <select class="form-control" name="perfil" />
                        <option>-</option>
                        <option value="0">Administrador</option>
                        <option value="1">Usuário</option>
                        </select>
                    </div>

                    <div class=" col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="nome">Situação:</label>
                        <select class="form-control" name="ativo" required="required">
                            <option value="0">Ativo</option>
                            <option value="1">Inativo</option>
                        </select>
                    </div>
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
    
    <script type="text/javascript">
        function mascara(telefone) {
            if (telefone.value.length == 0)
                telefone.value = '(' + telefone.value; //quando começamos a digitar, o script irá inserir um parênteses no começo do campo.
            if (telefone.value.length == 3)
                telefone.value = telefone.value + ')'; //quando o campo já tiver 3 caracteres (um parênteses e 2 números) o script irá inserir mais um parênteses, fechando assim o código de área.

            //if (telefone.value.length == 10)
            // telefone.value = telefone.value + '-'; //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone.

        }
    </script>
    
</body>

</html>
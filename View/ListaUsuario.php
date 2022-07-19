<?php
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION['perfil']!='0' || !isset($_SESSION['perfil'])){
    header("Location: ../Controller/derruba_session.php");
    exit();
}
include_once '../Controller/FuncoesControllerUsuario.php';


$fcu = new FuncoesControllerUsuario();
$linhas = $fcu->pesquisaUsuario();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Usuário</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/redmond/jquery-ui-1.10.1.custom.css" />
    <link href="../css/bootstrap-grid.css" rel="stylesheet">
</head>

<body style=" background-image: url(../img/fundo8.jpg)">
    <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        //codigo para efetivar a Alteração dos dados do usuario
                        if (isset($_POST['confirmarAlteracao'])) {
                            $msg = $fcu->editarUsuario($_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['perfil'], $_POST['ativo']);

                            //Alterando dados no BD
                            echo $msg;

                            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                        URL='../View/ListaUsuario.php'\">";
                        }
                        //codigo para efetivar a exclusão dos dados do cliente
                        if (isset($_POST['confirmarExclusao'])) {
                            // $idatleta = $_POST['idatleta'];
                            //excluindo no BD

                            $msg = $fcu->excluirUsuario($_POST['email']);
                            echo $msg;
                            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                        URL='../View/ListaUsuario.php'\">";
                        }
                        ?>
                        <div class="panel panel-info">
                            <div class="panel painelRei">
                                <h3 class="text-primary" style="color: whitesmoke; padding-left: 10px;">Lista de Usuarios</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-condensed table-hover">
                                    <thead>
                                        <tr>

                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>E-mail</th>
                                            <th>Perfil</th>
                                            <th>Ativo</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($linhas) {
                                            $a = 0;
                                            foreach ($linhas as $linha) {
                                                $a++;
                                        ?>
                                                <tr>

                                                    <td><?php echo $linha['nome']; ?></td>
                                                    <td><?php echo $linha['telefone']; ?></td>
                                                    <td><?php echo $linha['email']; ?></td>
                                                    <td><?php
                                                        if($linha['perfil'] == 0){
                                                            echo "administrador";
                                                        } else if($linha['perfil'] == 1){
                                                            echo "usuário";
                                                        }  ?></td>
                                                    <td><?php if ($linha['ativo'] == 0) echo "Ativo";
                                                        else echo "Inativo";  ?></td>



                                                    <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_ed<?php echo $a; ?>"><img src="../img/edita.ico" width="16"></button></td>
                                                    <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_exc<?php echo $a; ?>"><img src="../img/deleta.ico" width="16"></button></td>
                                                </tr>
                                                <!-- janela modal Editar Esporte -->
                                                <div class="modal fade" id="modal_ed<?php echo $a; ?>" role="dialog" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    <span class="sr-only">Fechar a tela modal</span>
                                                                </button>
                                                                <h4 class="modal-title">Dados para Edição</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <div class="form-group">
                                                                        <label for="nome">Nome:</label>
                                                                        <input type="text" class="form-control" name="nome" value="<?php echo $linha['nome']; ?>" required="required" />
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="nome">Telefone:</label>
                                                                        <input type="text" class="form-control" name="telefone" value="<?php echo $linha['telefone']; ?>" required="required" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Email:</label>
                                                                        <input type="text" class="form-control" name="email" value="<?php echo $linha['email']; ?>" required="required" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Perfil:</label>
                                                                        <input type="text" class="form-control" name="perfil" value="<?php echo $linha['perfil']; ?>" required="required" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nome">Situação:</label>
                                                                        <input type="text" class="form-control" name="ativo" value="<?php echo $linha['ativo']; ?> " required="required" />
                                                                    </div>


                                                                    <?php
                                                                    /*
                                                                            foreach ($linhasUsuario as $linhaUsuario) {
                                                                                ?>    
                                                                                <option value="<?php echo $linhaUsuario['id_usuario']; ?>">
                                                                                    <?php echo $linhaUsuario['nomeUsuario']; ?>
                                                                                </option> 
                                                                                <?php
                                                                            }
                                                                              * */

                                                                    ?>
                                                                    </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <!--                                                            <input type="hidden" name="codigo" value="<?php echo $linha['email']; ?>">
                                                            <input type="hidden" name="id_usuario" value="<?php echo $linha['email']; ?>">-->
                                                            <input type="submit" name="confirmarAlteracao" class="btn btn-default" value=" Enviar ">
                                                            <input type="submit" class="btn btn-danger" value="Cancelar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                            </div>

                            <div class="modal fade" id="modal_exc<?php echo $a; ?>" role="dialog" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Fechar a tela modal</span>
                                            </button>
                                            <h4 class="modal-title">Dados para Exclusão</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Deseja excluir os dados de <?php echo $linha['nome']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="post">
                                                <!--                                                <input type="hidden" name="codigo" value="<?php echo $linha['email']; ?>">-->
                                                <input type="submit" name="confirmarExclusao" class="btn btn-default" value="Excluir">
                                                <input type="submit" class="btn btn-danger" value="Cancelar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- // janela modal -->
                    <?php
                                            }
                                        }
                    ?>
                    </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>
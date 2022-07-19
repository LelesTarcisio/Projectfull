<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['perfil'] != '0' || !isset($_SESSION['perfil'])) {
    header("Location: ../Controller/derruba_session.php");
    exit();
}
/* include_once '../Model/ConectaDB.php'; */
include_once '../Controller/FuncoesControllerFornecedor.php';
$fcf = new FuncoesControllerFornecedor();
$id = $fcf->proximoFornecedor();
$linhas = $fcf->pesquisaFornecedor();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>(Cadastro de Fornecedor)</title>
    <link rel="stylesheet" href="../css/bootstrap-grid.css" />
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/redmond/jquery-ui-1.10.1.custom.css">
    <link rel="stylesheet" href="../css/estilo.css" />
    <!-- Adicionando Javascript -->
</head>

<body onLoad="entrada();" style=" background-image: url(../img/fundo8.jpg)">
    <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div>
                    <h3 style="color: #fcfdfd">Dados dos Fornecedores </h3>
                </div>
                <?php
                if (isset($_POST['confirmarEnvio'])) {
                    if ($_POST['razao'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira a razão social.</p>";
                        echo $mensagem;
                    } else if ($_POST['fantasia'] == "-") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um nome fantasia.</p>";
                        echo $mensagem;
                    } else if ($_POST['cnpj'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um CNPJ.</p>";
                        echo $mensagem;
                    } else if ($_POST['telefone'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um telefone.</p>";
                        echo $mensagem;
                    } else if ($_POST['email'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um email.</p>";
                        echo $mensagem;
                    } else if ($_POST['cep'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um cep.</p>";
                        echo $mensagem;
                    } else if ($_POST['logradouro'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um logradouro.</p>";
                        echo $mensagem;
                    } else if ($_POST['bairro'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um bairro.</p>";
                        echo $mensagem;
                    } else if ($_POST['cidade'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira uma cidade.</p>";
                        echo $mensagem;
                    } else if ($_POST['numero'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira um numero.</p>";
                        echo $mensagem;
                    } else if ($_POST['uf'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Insira uma unidade federativa.</p>";
                        echo $mensagem;
                    } else {
                        $msg = $fcf->inserirFornecedor($_POST['idfor'], $_POST['fantasia'], $_POST['razao'], $_POST['cnpj'], $_POST['telefone'], $_POST['email'], $_POST['cep'], $_POST['cidade'], $_POST['logradouro'], $_POST['bairro'], $_POST['complemento'], $_POST['numero'], $_POST['uf']);
                        echo $msg;
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                URL='CadastroFornecedor.php'\">";
                    }
                }

                if (isset($_POST['confirmarExclusao'])) {
                    //excluindo no DB;
                    $msg = $fcf->excluirFornecedor($_POST['idfor']);
                    echo $msg;
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                        URL='CadastroFornecedor.php'\">";
                }
                if (isset($_POST['confirmarAtualizacao'])) {
                    //Atualizando no DB;
                    $msg = $fcf->atualizarFornecedor($_POST['idfor'], $_POST['fantasia'], $_POST['razao'], $_POST['cnpj'], $_POST['telefone'], $_POST['email'], $_POST['cep'], $_POST['cidade'], $_POST['logradouro'], $_POST['bairro'], $_POST['complemento'], $_POST['numero'], $_POST['uf']);
                    echo $msg;
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                        URL='CadastroFornecedor.php'\">";
                }
                ?>
                <form method="post">
                    <div class="col-sm-2" class="form-group">
                        <!--  <label style="color: #fcfdfd" for="idfor">Código: </label> -->
                        <!--  <input type="text" id="idfor2" class="form-control" value="<?php echo $id; ?>" disabled="disabled" /> <!-- Só para aparência -->
                        <input type="hidden" id="idfor" class="form-control" name="idfor" value="<?php echo $id; ?>" />
                    </div>
                    <div class="col-sm-12" class="form-control">
                        <label style="color: #fcfdfd" for="razao">Razão Social:</label>
                        <input type="text" id="razao" class="form-control" name="razao" required="required" />
                    </div>
                    <div class="col-sm-12" class="form-group">
                        <label style="color: #fcfdfd" for="fantasia">Nome Fantasia:</label>
                        <input type="text" id="fantasia" class="form-control" name="fantasia" required="required" />
                    </div>
                    <div class="col-sm-6" class="form-group">
                        <label style="color: #fcfdfd" for="cnpj">Cnpj:</label>
                        <input type="text" id="cnpj" class="form-control" name="cnpj" id="cnpj" required="required" onkeypress="mascara3(this)" maxlength=18 />
                    </div>
                    <div class="col-sm-6" class="form-group">
                        <label style="color: #fcfdfd" for="telefone">Telefone:</label>
                        <input type="tel" id="telefone" class="form-control" name="telefone" required="required" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" />
                    </div>
                    <!--  -->
                    <div class="col-sm-8" class="form-group">
                        <label style="color: #fcfdfd" for="email">E-mail:</label>
                        <input type="text" id="email" class="form-control" name="email" required="required" />
                    </div>
                    <div class="col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="cep">CEP:</label>
                        <input type="text" id="cep" class="form-control" name="cep" required="required" onkeypress="mascara2(this)" maxlength=9 />
                    </div>
                    <div class="col-sm-12" class="form-control">
                        <label style="color: #fcfdfd" for="logradouro">Logradouro:</label>
                        <input type="text" id="logradouro" class="form-control" name="logradouro" required="required" />
                    </div>
                    <div class="col-sm-12" class="form-control">
                        <label style="color: #fcfdfd" for="complemento">Complemento:</label>
                        <input type="text" id="complemento" class="form-control" name="complemento" value="-" />
                    </div>
                    <div class="col-sm-4" class="form-control">
                        <label style="color: #fcfdfd" for="bairro">Bairro:</label>
                        <input type="text" id="bairro" class="form-control" name="bairro" required="required" style="margin-bottom: 10px;" />
                    </div>
                    <div class="col-sm-3" class="form-control">
                        <label style="color: #fcfdfd" for="cidade">Cidade:</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" required="required" />
                    </div>
                    <div class="col-sm-2" class="form-control">
                        <label style="color: #fcfdfd" for="numero">Numero:</label>
                        <input type="text" id="numero" class="form-control" name="numero" required="required" />
                    </div>
                    <div class="col-sm-3" class="form-control">
                        <label style="color: #fcfdfd" for="uf">UF:</label>
                        <select class="form-control" name="uf" id="uf">
                            <option value="-">-</option>
                            <option value="CE">CE</option>
                            <option value="MS">MS</option>
                            <option value="PI">PI</option>
                            <option value="SC">SC</option>
                            <option value="AC">AC</option>
                            <option value="DF">DF</option>
                            <option value="MG">MG</option>
                            <option value="RJ">RJ</option>
                            <option value="SP">SP</option>
                            <option value="AL">AL</option>
                            <option value="ES">ES</option>
                            <option value="PA">PA</option>
                            <option value="RN">RN</option>
                            <option value="SE">SE</option>
                            <option value="AP">AP</option>
                            <option value="GO">GO</option>
                            <option value="PB">PB</option>
                            <option value="RS">RS</option>
                            <option value="TO">TO</option>
                            <option value="AM">AM</option>
                            <option value="MA">MA</option>
                            <option value="PR">PR</option>
                            <option value="RO">RO</option>
                            <option value="BA">BA</option>
                            <option value="MT">MT</option>
                            <option value="PE">PE</option>
                            <option value="RR">RR</option>
                        </select>
                        <!-- https://velhobit.com.br/programacao/carregando-cep-cidades-dinamicamente.html -->
                        <!-- https://www.youtube.com/watch?v=m_5ksklp5Tc -->
                        <!-- https://celke.com.br/artigo/preenchimento-automatico-do-endereco-a-partir-do-cep -->
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="submit" value="Enviar" class="btn-success" id="confirmarEnvio" name="confirmarEnvio" />
                            <input type="reset" value="Limpar" class="btn-danger" />
                            <input type="submit" value="Atualizar" class="btn-warning" id="confirmarAtualizacao" name="confirmarAtualizacao" />
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-6">
                <div>
                    <h3></h3>
                </div>
                <div class="panel panel-info">
                    <div class="panel painelRei">
                        <h3 class="text-primary" style="color: whitesmoke; text-align: center;">Listagem dos Fornecedores</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-condensed table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>Código</th> -->
                                    <th>Razão Social</th>
                                    <th>Nome Fantasia</th>
                                    <th>CNPJ</th>
                                    <th>E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($linhas) {
                                    $a = 0;
                                    foreach ($linhas as $linha) {
                                        $a++;

                                        // $contador = 1;
                                        // ++$contador;
                                        $idForn = "idFornecedor" . $a;
                                        $idRazao = "razao" . $a;
                                        $idFantasia = "fantasia" . $a;
                                        $idCnpj = "cnpj" . $a;
                                        $idTelefone = "telefone" . $a;
                                        $idEmail = "email" . $a;
                                        $idCep = "cep" . $a;
                                        $idCidade = "cidade" . $a;
                                        $idLogra = "logradouro" . $a;
                                        $idBairro = "bairro" . $a;
                                        $idComple = "complemento" . $a;
                                        $idNumero = "numero" . $a;
                                        $idUf = "uf" . $a;
                                ?>
                                        <input type="hidden" id="<?php echo $idForn; ?>" value="<?php echo $linha['idfornecedor']; ?>" />
                                        <input type="hidden" id="<?php echo $idRazao; ?>" value="<?php echo $linha['razaoSocial']; ?>" />
                                        <input type="hidden" id="<?php echo $idFantasia; ?>" value="<?php echo $linha['nomeFantasia']; ?>" />
                                        <input type="hidden" id="<?php echo $idCnpj; ?>" value="<?php echo $linha['cnpj']; ?>" />
                                        <input type="hidden" id="<?php echo $idTelefone; ?>" value="<?php echo $linha['telefone']; ?>" />
                                        <input type="hidden" id="<?php echo $idEmail; ?>" value="<?php echo $linha['email']; ?>" />
                                        <input type="hidden" id="<?php echo $idCep; ?>" value="<?php echo $linha['cep']; ?>" />
                                        <input type="hidden" id="<?php echo $idCidade; ?>" value="<?php echo $linha['cidade']; ?>" />
                                        <input type="hidden" id="<?php echo $idLogra; ?>" value="<?php echo $linha['logradouro']; ?>" />
                                        <input type="hidden" id="<?php echo $idBairro; ?>" value="<?php echo $linha['bairro']; ?>" />
                                        <input type="hidden" id="<?php echo $idComple; ?>" value="<?php echo $linha['complemento']; ?>" />
                                        <input type="hidden" id="<?php echo $idNumero; ?>" value="<?php echo $linha['numero']; ?>" />
                                        <input type="hidden" id="<?php echo $idUf; ?>" value="<?php echo $linha['uf']; ?>" />

                                        <tr>
                                            <!-- <td><?php echo $linha['idfornecedor']; ?></td> -->
                                            <td><?php echo $linha['razaoSocial']; ?></td>
                                            <td><?php echo $linha['nomeFantasia']; ?></td>
                                            <td><?php echo $linha['cnpj']; ?></td>
                                            <td><?php echo $linha['email']; ?></td>
                                            <td><button type="button" class="btn btn-default"><img src="../img/edita.ico" width="16" onclick="editaNome('<?php echo $idForn; ?>', '<?php echo $idRazao; ?>', '<?php echo $idFantasia; ?>', '<?php echo $idCnpj; ?>', '<?php echo $idTelefone; ?>', '<?php echo $idEmail; ?>', '<?php echo $idCep; ?>', '<?php echo $idLogra; ?>', '<?php echo $idComple; ?>', '<?php echo $idBairro; ?>', '<?php echo $idCidade; ?>', '<?php echo $idNumero; ?>', '<?php echo $idUf; ?>');"></button></td>
                                            <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_exc<?php echo $a; ?>"><img src="../img/deleta.ico" width="16" /></button></td>
                                        </tr>
                                        <!-- janela modal Excluir -->
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
                                                        <div class="form-group">
                                                            <p>Deseja excluir os dados de <?php echo $linha['razaoSocial']; ?> ?</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <!-- TAVA ESQUECENDO DE COLOCAR NESSA PARTE OS DADOS PARA FAZER A EXCLUSÃO-->
                                                            <input type="hidden" name="idfor" value="<?php echo $linha['idfornecedor']; ?>" />
                                                            <input type="submit" name="confirmarExclusao" class="btn btn-default" value="Excluir" />
                                                            <input type="submit" class="btn btn-danger" value="Cancelar" />
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
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/casa.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <!--   <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <script type="text/javascript">
        $("#cep").focusout(function() {
            //Início do Comando AJAX
            $.ajax({
                //O campo URL diz o caminho de onde virá os dados
                //É importante concatenar o valor digitado no CEP
                url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/unicode/',
                //Aqui você deve preencher o tipo de dados que será lido,
                //no caso, estamos lendo JSON.
                dataType: 'json',
                //SUCESS é referente a função que será executada caso
                //ele consiga ler a fonte de dados com sucesso.
                //O parâmetro dentro da função se refere ao nome da variável
                //que você vai dar para ler esse objeto.
                success: function(resposta) {
                    //Agora basta definir os valores que você deseja preencher
                    //automaticamente nos campos acima.
                    $("#logradouro").val(resposta.logradouro);
                    $("#complemento").val(resposta.complemento);
                    $("#bairro").val(resposta.bairro);
                    $("#cidade").val(resposta.localidade);
                    $("#uf").val(resposta.uf);
                    //Vamos incluir para que o Número seja focado automaticamente
                    //melhorando a experiência do usuário
                    $("#numero").focus();
                }
            });
        });
    </script>
    <script type="text/javascript">
        function mascara(telefone) {
            if (telefone.value.length == 0)
                telefone.value = '(' + telefone.value; //quando começamos a digitar, o script irá inserir um parênteses no começo do campo.
            if (telefone.value.length == 3)
                telefone.value = telefone.value + ') '; //quando o campo já tiver 3 caracteres (um parênteses e 2 números) o script irá inserir mais um parênteses, fechando assim o código de área.

            //if (telefone.value.length == 10)
            // telefone.value = telefone.value + '-'; //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone.

        }
    </script> <!-- https://www.devmedia.com.br/forum/como-eu-faco-para-colocar-em-um-input-parentes/539468 -->
    <script type="text/javascript">
        $("#telefone").mask("(00) 0000-00009");
    </script>
    <script type="text/javascript">
        function mascara2(cep) {
            if (cep.value.length == 5) {
                cep.value = cep.value + '-';
            }
        }
    </script>
    <script type="text/javascript">
        function mascara3(cnpj) {
            if (cnpj.value.length == 2) {
                cnpj.value = cnpj.value + '.';
            }
            if (cnpj.value.length == 6) {
                cnpj.value = cnpj.value + '.';
            }
            if (cnpj.value.length == 10) {
                cnpj.value = cnpj.value + '/';
            }
            if (cnpj.value.length == 15) {
                cnpj.value = cnpj.value + '-';
            }
        }
    </script>
    <script>
        function entrada() {
            $('#confirmarAtualizacao').attr("disabled", true);
            $('#confirmarEnvio').attr("disabled", false);
        }
    </script>
    <script>
        function editaNome(a, b, c, d, e, f, g, h, i, j, k, l, m) {
            $('#confirmarEnvio').attr("disabled", true);
            $('#confirmarAtualizacao').attr("disabled", false);
            idfor.value = document.getElementById(a).value;
            idfor2.value = document.getElementById(a).value;
            razao.value = document.getElementById(b).value;
            fantasia.value = document.getElementById(c).value;
            cnpj.value = document.getElementById(d).value;
            telefone.value = document.getElementById(e).value;
            email.value = document.getElementById(f).value;
            cep.value = document.getElementById(g).value;
            logradouro.value = document.getElementById(h).value;
            complemento.value = document.getElementById(i).value;
            bairro.value = document.getElementById(j).value;
            cidade.value = document.getElementById(k).value;
            numero.value = document.getElementById(l).value;
            uf.value = document.getElementById(m).value;
        }
    </script>

</body>

</html>
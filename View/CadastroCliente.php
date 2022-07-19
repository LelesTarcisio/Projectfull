<?php
if (!isset($_SESSION)) {
    session_start();
}
/* include_once '../Model/Conecta.php'; */
include_once '../Controller/FuncoesControllerCliente.php';
include_once '../Controller/FuncoesControllerEndereco.php';


$fcc = new FuncoesControllerCliente();
$fce = new FuncoesControllerEndereco();

$linhasEndereco = $fce->pesquisaEndereco();
$email = $_SESSION['email'];
$id = $fcc->proximoCodigoCliente();
$linhas = $fcc->pesquisaClienteCompleto($email);


?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>(Cadastro de Cliente!)</title>
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- Adicionando Javascript -->
</head>

<body style="background-image: url(../img/fundo8.jpg)">
    <!--  http://www.nyan.cat/  -->
    <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div class="col-sm-12">
                    <h3 style="color: #fcfdfd">Cadastro de Cliente</h3>
                </div>
                <?php
                if (isset($_POST['confirmarEnvio'])) {

                    $fce = new FuncoesControllerEndereco();
                    $linhaE = $fce->pesquisaCodEndereco($_POST['cep'], $_POST['logradouro'], $_POST['numero']);

                    if ($linhaE) {
                        foreach ($linhaE as $linE) {
                            $codEndereco = $linE['codEndereco'];
                        }

                        $fcc = new FuncoesControllerCliente();
                        $msg = $fcc->inserirCliente(
                            $_POST['codCliente'],
                            $_POST['tipoCliente'],
                            $_POST['nomeCliente'],
                            $_POST['cpf_cnpj'],
                            $_POST['fixo'],
                            $_POST['movel'],
                            $_SESSION['email'],
                            $_POST['nomeRepresentante'],
                            '0',
                            $codEndereco,
                            $_SESSION['email']
                        );
                    } else {

                        $msg = $fce->inserirEndereco(
                            $_POST['cep'],
                            $_POST['cidade'],
                            $_POST['logradouro'],
                            $_POST['bairro'],
                            $_POST['complemento'],
                            $_POST['numero'],
                            $_POST['uf']
                        );

                        $linhaE = $fce->pesquisaCodEndereco($_POST['cep'], $_POST['logradouro'], $_POST['numero']);

                        foreach ($linhaE as $linE) {
                            $codEndereco = $linE['codEndereco'];
                        }

                        $fcc = new FuncoesControllerCliente();
                        $msg = $fcc->inserirCliente(
                            $_POST['codCliente'],
                            $_POST['tipoCliente'],
                            $_POST['nomeCliente'],
                            $_POST['cpf_cnpj'],
                            $_POST['fixo'],
                            $_POST['movel'],
                            $_SESSION['email'],
                            $_POST['nomeRepresentante'],
                            '0',
                            $codEndereco,
                            $_SESSION['email']

                        );
                    }



                    echo $msg;
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                               URL='CadastroCliente.php'\">";
                }

                if (isset($_POST['confirmarEditar'])) {
                    $_SESSION['codCliente'] = $_POST['codCliente'];
                    header("Location: editarCliente.php");
                    exit();
                }
                if ($linhas) {
                    foreach ($linhas as $linha) {
                ?>

                        <div class=" col-sm-8" class="form-control">
                            <label style="color: #fcfdfd;" for="cpf_cnpj">Nome do Cliente:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['nomeCliente']; ?></label>
                        </div>

                        <div class=" col-sm-3" class="form-control">
                            <label style="color: #fcfdfd;" for="cpf_cnpj">CPF_CNPJ:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['cpf_cnpj']; ?></label>
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd;" for="fixo">Telefone Fixo:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['fixo']; ?></label>
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd;" for="movel">Telefone Celular:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['movel']; ?></label>
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd;" for="email">E-mail:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['email']; ?></label>
                        </div>
                        <div class=" col-sm-7" class="form-control">
                            <label style="color: #fcfdfd;" for="nomeRepresentante">Nome Representante:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['nomeRepresentante']; ?></label>
                        </div>

                        <div class="col-sm-12">
                            <h3 style="color: #fcfdfd;">Endereço</h3>
                        </div>

                        <div class=" col-sm-4" class="form-group">
                            <label style="color: #fcfdfd;" for="cep">CEP:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['cep']; ?></label>
                        </div>
                        <div class=" col-sm-3" class="form-control">
                            <label style="color: #fcfdfd;" for="cidade">Cidade:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['cidade']; ?></label>
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd;" for="logradouro">Logradouro:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['logradouro']; ?></label>
                        </div>
                        <div class=" col-sm-2" class="form-control">
                            <label style="color: #fcfdfd" for="bairro">Bairro:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['bairro']; ?></label>
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd" for="complemento">Complemento:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['complemento']; ?></label>
                        </div>
                        <div class=" col-sm-2" class="form-control">
                            <label style="color: #fcfdfd" for="numero">Numero:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['numero']; ?></label>
                        </div>
                        <div class=" col-sm-2" class="form-control">
                            <label style="color: #fcfdfd" for="uf">UF:</label>
                            <label style="color: #fcfdfd;"><?php echo $linha['uf']; ?></label>
                        </div>
                        <div class=" col-sm-12" class="form-group">
                            <div class="form-group">
                                <form method="post">
                                    <input type="hidden" class="form-control" name="codCliente" value="<?php echo $linha['codCliente']; ?>" />
                                    <input type="submit" value="Editar" class="btn-warning" name="confirmarEditar" />
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>

                    <form method="post">
                        <div class=" col-sm-12" class="form-group">
                            <label style="color: #fcfdfd">Código: </label>
                            <label style="color: #fcfdfd"><?php echo $id; ?></label>
                            <input type="hidden" class="form-control" name="codCliente" value="<?php echo $id; ?>" />
                        </div>

                        <div class=" col-sm-3" class="form-group">
                            <label style="color: #fcfdfd" for="nome">Perfil:</label>
                            <select class="form-control" name="tipoCliente" />
                            <option>-</option>
                            <option value="0">Juridica</option>
                            <option value="1">Física</option>
                            </select>
                        </div>
                        <div class=" col-sm-8" class="form-control">
                            <label style="color: #fcfdfd" for="cpf_cnpj">Nome do Cliente:</label>
                            <input type="text" class="form-control" name="nomeCliente" id="nomeCliente" value="<?php echo $_SESSION['nome']; ?>" required="required" />
                        </div>
                        <div class=" col-sm-3" class="form-control">
                            <label style="color: #fcfdfd" for="cpf_cnpj">CPF_CNPJ:</label>
                            <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" required="required" onkeypress='mascaraMutuario(this, cpfCnpj)' onblur='clearTimeout()' maxlength="18" />
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd" for="fixo">Telefone Fixo:</label>
                            <input type="text" class="form-control" name="fixo" id="fixo" required="required" onkeypress="mascara(this)" maxlength=14 />
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd" for="movel">Telefone Celular:</label>
                            <input type="text" class="form-control" name="movel" id="movel" required="required" onkeypress="mascara(this)" maxlength=14 />
                        </div>
                        <div class=" col-sm-7" class="form-control">
                            <label style="color: #fcfdfd" for="nomeRepresentante">Nome Representante:</label>
                            <input type="text" class="form-control" name="nomeRepresentante" id="nomeRepresentante" required="required" />
                        </div>

                        <div class=" col-sm-12" class="form-group">
                            <!-- <div class="form-group">
                                <input type="submit" value="Enviar" class="btn-warning" name="confirmarEnvio" /> 
                                <input type="reset" value="Limpar" class="btn-success" />
                            </div> -->
                        </div>

                        <div class="col-sm-12">
                            <h3 style="color: #fcfdfd">Cadastro de Endereço</h3>
                        </div>

                        <div class=" col-sm-4" class="form-group">
                            <label style="color: #fcfdfd" for="cep">CEP:</label>
                            <input type="text" class="form-control" name="cep" id="cep" required="required" onkeypress="mascara2(this)" maxlength=9 />
                        </div>
                        <div class=" col-sm-3" class="form-control">
                            <label style="color: #fcfdfd" for="cidade">Cidade:</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" required="required" />
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd" for="logradouro">Logradouro:</label>
                            <input type="text" class="form-control" name="logradouro" id="logradouro" required="required" />
                        </div>
                        <div class=" col-sm-4" class="form-control">
                            <label style="color: #fcfdfd" for="bairro">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" required="required" />
                        </div>
                        <div class=" col-sm-5" class="form-control">
                            <label style="color: #fcfdfd" for="complemento">Complemento:</label>
                            <input type="text" class="form-control" name="complemento" id="complemento" required="required" />
                        </div>
                        <div class=" col-sm-1" class="form-control">
                            <label style="color: #fcfdfd" for="numero">Numero:</label>
                            <input type="text" class="form-control" name="numero" id="numero" required="required" />
                        </div>
                        <div class=" col-sm-2" class="form-control">
                            <label style="color: #fcfdfd" for="uf">UF:</label>
                            <select class="form-control" id="uf" name="uf">
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

                        </div>
                        <div class=" col-sm-12" class="form-group">
                            <div class="form-group">
                                <input type="submit" value="Enviar" class="btn-warning" name="confirmarEnvio" />
                                <input type="reset" value="Limpar" class="btn-success" />
                            </div>
                        </div>
                    </form>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/casa.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/jquery.mask.min.js"></script>

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
    </script>
    



</body>

</html>
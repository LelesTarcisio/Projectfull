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
                        $msg = $fcc->editarCliente(
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
                        $msg = $fcc->editarCliente(
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
                if($linhas){
                    foreach ($linhas as $linha){
                    ?>                
                <form method="post">
                    <div class=" col-sm-12" class="form-group">
                        <label style="color: #fcfdfd">Código: </label>
                        <label style="color: #fcfdfd"><?php echo $id; ?></label>
                        <input type="hidden" class="form-control" name="codCliente" value="<?php echo $linha['codCliente']; ?>" />
                    </div>

                    <div class=" col-sm-8" class="form-control">
                        <label style="color: #fcfdfd" for="cpf_cnpj">Nome do Cliente:</label>
                        <input type="text" class="form-control" value="<?php echo $linha['nomeCliente']; ?>" name="nomeCliente" id="nomeCliente" value="<?php echo $_SESSION['nome'];?>" required="required" />
                    </div>

                    <div class=" col-sm-3" class="form-control">
                        <label style="color: #fcfdfd" for="cpf_cnpj">CPF_CNPJ:</label>
                        <input type="text" class="form-control" value="<?php echo $linha['cpf_cnpj']; ?>" name="cpf_cnpj" id="cpf_cnpj" required="required" />
                    </div>
                    <div class=" col-sm-4" class="form-control">
                        <label style="color: #fcfdfd" for="fixo">Telefone Fixo:</label>
                        <input type="text" class="form-control" value="<?php echo $linha['fixo']; ?>" name="fixo" id="fixo" required="required" onkeypress="mascara(this)" maxlength=14 />
                    </div>
                    <div class=" col-sm-4" class="form-control">
                        <label style="color: #fcfdfd" for="movel">Telefone Celular:</label>
                        <input type="text" class="form-control" name="movel" value="<?php echo $linha['movel']; ?>" id="movel" required="required" onkeypress="mascara(this)" maxlength=14 />
                    </div>
                    <div class=" col-sm-7" class="form-control">
                        <label style="color: #fcfdfd" for="nomeRepresentante">Nome Representante:</label>
                        <input type="text" class="form-control" value="<?php echo $linha['nomeRepresentante']; ?>" name="nomeRepresentante" id="nomeRepresentante" required="required" />
                    </div>

                    <div class=" col-sm-8" class="form-control">
                        <label style="color: #fcfdfd" for="cpf_cnpj"></label>
                        <input type="hidden" type="text" class="form-control" value="<?php echo $linha['tipoCliente']; ?>" name="tipoCliente" id="tipoCliente" value="<?php echo $_SESSION['tipoCliente'];?>" required="required" />
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
                        <input type="text" class="form-control" name="cep" value="<?php echo $linha['cep']; ?>" id="cep" required="required" onkeypress="mascara2(this)" maxlength=9 />
                    </div>
                    <div class=" col-sm-3" class="form-control">
                        <label style="color: #fcfdfd" for="cidade">Cidade:</label>
                        <input type="text" class="form-control" name="cidade" value="<?php echo $linha['cidade']; ?>" id="cidade" required="required" />
                    </div>
                    <div class=" col-sm-4" class="form-control">
                        <label style="color: #fcfdfd" for="logradouro">Logradouro:</label>
                        <input type="text" class="form-control" name="logradouro" value="<?php echo $linha['logradouro']; ?>" id="logradouro" required="required" />
                    </div>
                    <div class=" col-sm-4" class="form-control">
                        <label style="color: #fcfdfd" for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" value="<?php echo $linha['bairro']; ?>" id="bairro" required="required" />
                    </div>
                    <div class=" col-sm-5" class="form-control">
                        <label style="color: #fcfdfd" for="complemento">Complemento:</label>
                        <input type="text" class="form-control" name="complemento" value="<?php echo $linha['complemento']; ?>" id="complemento" required="required" />
                    </div>
                    <div class=" col-sm-1" class="form-control">
                        <label style="color: #fcfdfd" for="numero">Numero:</label>
                        <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $linha['numero']; ?>" required="required" />
                    </div>
                    <div class=" col-sm-2" class="form-control">
                        <label style="color: #fcfdfd" for="uf">UF:</label>
                        <select class="form-control" name="uf">
                            <option value="-">-</option>
                            <option value="CE" <?php if($linha['uf']==="CE") echo "selected='selected'"; ?>>CE</option>
                            <option value="MS" <?php if($linha['uf']==="MS") echo "selected='selected'"; ?>>MS</option>
                            <option value="PI" <?php if($linha['uf']==="PI") echo "selected='selected'"; ?>>PI</option>
                            <option value="SC" <?php if($linha['uf']==="SC") echo "selected='selected'"; ?>>SC</option>
                            <option value="AC" <?php if($linha['uf']==="AC") echo "selected='selected'"; ?>>AC</option>
                            <option value="DF" <?php if($linha['uf']==="DF") echo "selected='selected'"; ?>>DF</option>
                            <option value="MG" <?php if($linha['uf']==="MG") echo "selected='selected'"; ?>>MG</option>
                            <option value="RJ" <?php if($linha['uf']==="RJ") echo "selected='selected'"; ?>>RJ</option>
                            <option value="SP" <?php if($linha['uf']==="SP") echo "selected='selected'"; ?>>SP</option>
                            <option value="AL" <?php if($linha['uf']==="AL") echo "selected='selected'"; ?>>AL</option>
                            <option value="ES" <?php if($linha['uf']==="ES") echo "selected='selected'"; ?>>ES</option>
                            <option value="PA" <?php if($linha['uf']==="PA") echo "selected='selected'"; ?>>PA</option>
                            <option value="RN" <?php if($linha['uf']==="RN") echo "selected='selected'"; ?>>RN</option>
                            <option value="SE" <?php if($linha['uf']==="SE") echo "selected='selected'"; ?>>SE</option>
                            <option value="AP" <?php if($linha['uf']==="AP") echo "selected='selected'"; ?>>AP</option>
                            <option value="GO" <?php if($linha['uf']==="GO") echo "selected='selected'"; ?>>GO</option>
                            <option value="PB" <?php if($linha['uf']==="PB") echo "selected='selected'"; ?>>PB</option>
                            <option value="RS" <?php if($linha['uf']==="RS") echo "selected='selected'"; ?>>RS</option>
                            <option value="TO" <?php if($linha['uf']==="TO") echo "selected='selected'"; ?>>TO</option>
                            <option value="AM" <?php if($linha['uf']==="AM") echo "selected='selected'"; ?>>AM</option>
                            <option value="MA" <?php if($linha['uf']==="MA") echo "selected='selected'"; ?>>MA</option>
                            <option value="PR" <?php if($linha['uf']==="PR") echo "selected='selected'"; ?>>PR</option>
                            <option value="RO" <?php if($linha['uf']==="RO") echo "selected='selected'"; ?>>RO</option>
                            <option value="BA" <?php if($linha['uf']==="BA") echo "selected='selected'"; ?>>BA</option>
                            <option value="MT" <?php if($linha['uf']==="MT") echo "selected='selected'"; ?>>MT</option>
                            <option value="PE" <?php if($linha['uf']==="PE") echo "selected='selected'"; ?>>PE</option>
                            <option value="RR" <?php if($linha['uf']==="RR") echo "selected='selected'"; ?>>RR</option>
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
                }
                ?>
            </div>
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


    <script type="text/javascript">
        function mascara2(cep) {
            if (cep.value.length == 5) {
                cep.value = cep.value + '-';
            }
        }
    </script>


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



</body>

</html>
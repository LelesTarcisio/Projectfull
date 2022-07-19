<?php
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION['perfil']!='0' || !isset($_SESSION['perfil'])){
    header("Location: ../Controller/derruba_session.php");
    exit();
}
/* include_once '../Model/System_of_a_DAO.php'; */
include_once '../Controller/FuncoesControllerProdutoLote.php';
include_once '../Controller/FuncoesControllerFornecedor.php';
include_once '../Controller/fdatas.php';
$fcp = new FuncoesControllerProdutoLote();
$fcf = new FuncoesControllerFornecedor();
$id = $fcp->proximoCodigoProdutoLote();
$linhas = $fcp->pesquisaProdutoLote();
$fdatas = new fdatas();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>Cadastro do Produto</title>
    <link rel="stylesheet" href="../css/bootstrap-grid.css" />
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap-reboot.css">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css" />
    <link rel="stylesheet" href="../bootstrapSelectpicker/dist/css/bootstrap-select.min.css" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
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
                <?php
                if (isset($_POST['confirmarEnvio'])) {
                    if ($_POST['nome'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual o nome do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['dataProd'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a data de entrada do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['qtdEstoq'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a quantidade de produtos em estoque?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['valComp'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual o valor da compra do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['valVen'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual o valor de venda do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['situ'] == "-") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a situação do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['dataVali'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a data de validade do seu produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['desc'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Dê uma descrição ao produto.</p>";
                        echo $mensagem;
                        return;
                    }

                    if (isset($_FILES['imagem2']['name']) && $_FILES['imagem2']['error'] == 0) {
                        $arquivo_tmp = $_FILES['imagem2']['tmp_name'];
                        $nome = $_FILES['imagem2']['name'];

                        // Pega a extensão
                        $extensao = pathinfo($nome, PATHINFO_EXTENSION);

                        // Converte a extensão para minúsculo
                        $extensao = strtolower($extensao);

                        // Somente imagens, .jpg;.jpeg;.gif;.png
                        // Aqui eu enfileiro as extensões permitidas e separo por ';'
                        // Isso serve apenas para eu poder pesquisar dentro desta String
                        if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                            // Cria um nome único para esta imagem
                            // Evita que duplique as imagens no servidor.
                            // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                            $novoNome = uniqid(time()) . '.' . $extensao;

                            // Concatena a pasta com o nome
                            $destino = '../upload/' . $novoNome;

                            // tenta mover o arquivo para o destino
                            if (@move_uploaded_file($arquivo_tmp, $destino)) {
                                $msg = $fcp->inserirProdutoLote($_POST['idProd'], $_POST['nome'], $_POST['dataProd'], $_POST['qtdEstoq'], $_POST['valComp'], $_POST['valVen'], $_POST['situ'], $_POST['desc'], $_POST['dataVali'], $destino, $_POST['forn_idforn']);
                                
                                echo $msg;
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                    URL='CadastroProduto.php'\">";
                            } else
                                echo "<script>alert('Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.')";
                        } else
                            echo "<script>alert('Você poderá enviar apenas arquivos .jpg, .jpeg, .gif ou .png')</script>";
                    } else
                        echo "<script>alert('Você não enviou nenhum arquivo!')</script>";
                }

                if (isset($_POST['confirmaAtualizacao'])) {
                    if ($_POST['nome'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual o nome do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['dataProd'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a data de entrada do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['qtdEstoq'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a quantidade de produtos em estoque?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['valComp'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual o valor da compra do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['valVen'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual o valor de venda do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['situ'] == "-") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a situação do produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['dataVali'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Qual a data de validade do seu produto?</p>";
                        echo $mensagem;
                        return;
                    }
                    if ($_POST['desc'] == "") {
                        $mensagem = "<p class='msgResp bg-warning text-center'>Dê uma descrição ao produto.</p>";
                        echo $mensagem;
                        return;
                    }

                    if (isset($_FILES['imagem2']['name']) && $_FILES['imagem2']['error'] == 0) {
                        $arquivo_tmp = $_FILES['imagem2']['tmp_name'];
                        $nome = $_FILES['imagem2']['name'];

                        // Pega a extensão
                        $extensao = pathinfo($nome, PATHINFO_EXTENSION);

                        // Converte a extensão para minúsculo
                        $extensao = strtolower($extensao);

                        // Somente imagens, .jpg;.jpeg;.gif;.png
                        // Aqui eu enfileiro as extensões permitidas e separo por ';'
                        // Isso serve apenas para eu poder pesquisar dentro desta String
                        if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                            // Cria um nome único para esta imagem
                            // Evita que duplique as imagens no servidor.
                            // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                            $novoNome = uniqid(time()) . '.' . $extensao;

                            // Concatena a pasta com o nome
                            $destino = '../upload/' . $novoNome;

                            // tenta mover o arquivo para o destino
                            if (@move_uploaded_file($arquivo_tmp, $destino)) {
                                $msg = $fcp->editarProdutoLote($_POST['idProd'], $_POST['nome'], $_POST['dataProd'], $_POST['qtdEstoq'], $_POST['valComp'], $_POST['valVen'], $_POST['situ'], $_POST['desc'], $_POST['dataVali'], $destino, $_POST['forn_idforn']);
                                
                                echo $msg;
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                    URL='CadastroProduto.php'\">";
                            } else
                                echo "<script>alert('Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.')";
                        } else
                            echo "<script>alert('Você poderá enviar apenas arquivos .jpg, .jpeg, .gif ou .png')</script>";
                    } else
                        echo "<script>alert('Você não enviou nenhum arquivo!')</script>";
                }

                if (isset($_POST['confirmarExclusao'])) {
                    //excluindo no DB;
                    $msg = $fcp->excluiProdutoLote($_POST['idprodex']);
                    echo $msg;
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"1;
                                URL='CadastroProduto.php'\">";
                    $filePath = $_POST['imgDel'];
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                ?>
                <div>
                    <h3 style="color: #fcfdfd">Cadastro do Produto </h3>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="col-sm-2" class="form-group">
                        <label style="color: #fcfdfd" for="idProd">Código: </label>
                        <input type="text" id="idProd2" class="form-control" value="<?php echo $id; ?>" disabled="disabled" /> <!-- Só para aparência -->
                        <input type="hidden" id="idProd" class="form-control" name="idProd" value="<?php echo $id; ?>" />
                    </div>
                    <div class="col-sm-12" class="form-control">
                        <label style="color: #fcfdfd" for="nome">Nome do Produto:</label>
                        <input type="text" id="nome" class="form-control" name="nome" required="required" />
                    </div>
                    <div class="col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="dataProd">Data de Entrada:</label>
                        <input type="date" id="dataProd" class="form-control" name="dataProd" required="required" />
                    </div>
                    <div class="col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="qtdEstoq">Estoque (qtd):</label>
                        <input type="text" id="qtdEstoq" class="form-control" name="qtdEstoq" required="required" />
                    </div>
                    <div class="col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="valComp">Valor da Compra:</label>
                        <input type="text" id="valComp" class="form-control" name="valComp" required="required" onKeyPress="return(moeda(this, '.', ',', event))" />
                    </div>
                    <div class="col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="valVen">Valor da Venda:</label>
                        <input type="text" id="valVen" class="form-control" name="valVen" required="required" onKeyPress="return(moeda(this, '.', ',', event))" />
                    </div>
                    <div class="col-sm-4" class="form-group">
                        <label style="color: #fcfdfd" for="situ">Situação do Produto:</label>
                        <select class="form-control" name="situ" id="situ">
                            <option value="-">-</option>
                            <option value="A">Ativo</option>
                            <option value="I">Inativo</option>
                        </select>
                    </div>
                    <div class="col-sm-4" class="form-control">
                        <label style="color: #fcfdfd" for="dataVali">Data de Validade:</label>
                        <input type="date" id="dataVali" class="form-control" name="dataVali" onkeypress="mascara(this)" maxlength=10 />
                    </div>
                    <div class="col-sm-12" class="form-control">
                        <label style="color: #fcfdfd" for="desc">Descrição:</label>
                        <textarea type="text" id="desc" class="form-control" name="desc" required="required"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <label style="color: #fcfdfd" for="forn_idforn">Fornecedor:</label>
                        <select class="selectpicker" data-live-search="true" id="forn_idforn" name="forn_idforn">
                            <?php
                            $linhas2 = $fcf->pesquisaFornecedor($sql);
                            foreach ($linhas2 as $linha) {
                            ?>
                                <option value="<?php echo $linha["idfornecedor"]; ?>"><?php echo $linha["nomeFantasia"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label style="color: #fcfdfd" for="img">Imagem</label><br>
                        <img id="imagem" src="../img/indice2.png" alt="" width="200" height="200" />
                        <input name="imagem2" type="file" onchange="previewFile()">
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
                    <div class="panel painelRei" style="background-color: #212121;">
                        <h3 class="text-primary" style="color: whitesmoke; text-align: center;">Listagem dos Produtos</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Data Entrada</th>
                                    <th>Validade</th>
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
                                        $idProd = "codLote" . $a;
                                        $idNome = "nomeProduto" . $a;
                                        $idData = "dataProduto" . $a;
                                        $idQtd = "qtdEstoque" . $a;
                                        $idValorC = "valorCompra" . $a;
                                        $idValorV = "valorVenda" . $a;
                                        $idSituacao = "situacao" . $a;
                                        $idDataVal = "dataValidade" . $a;
                                        $idDescr = "descricao" . $a;
                                        $idFornIdForn = "fornecedor_idfornecedor" . $a;
                                        $idImagem = "imagem" . $a;
                                ?>

                                        <input type="hidden" id="<?php echo $idProd; ?>" value="<?php echo $linha['codLote']; ?>" />
                                        <input type="hidden" id="<?php echo $idNome; ?>" value="<?php echo $linha['nomeProduto']; ?>" />
                                        <input type="hidden" id="<?php echo $idData; ?>" value="<?php echo $linha['dataProduto']; ?>" />
                                        <input type="hidden" id="<?php echo $idQtd; ?>" value="<?php echo $linha['qtdEstoque']; ?>" />
                                        <input type="hidden" id="<?php echo $idValorC; ?>" value="<?php echo $linha['valorCompra']; ?>" />
                                        <input type="hidden" id="<?php echo $idValorV; ?>" value="<?php echo $linha['valorVenda']; ?>" />
                                        <input type="hidden" id="<?php echo $idSituacao; ?>" value="<?php echo $linha['situacao']; ?>" />
                                        <input type="hidden" id="<?php echo $idDataVal; ?>" value="<?php echo $linha['dataValidade']; ?>" />
                                        <input type="hidden" id="<?php echo $idDescr; ?>" value="<?php echo $linha['descricao']; ?>" />
                                        <input type="hidden" id="<?php echo $idFornIdForn; ?>" value="<?php echo $linha['fornecedor_idfornecedor']; ?>" />
                                        <input type="hidden" id="<?php echo $idImagem; ?>" value="<?php echo $linha['imagem']; ?>" />


                                        <tr>
                                            <td><?php echo $linha['codLote']; ?></td>
                                            <td><?php echo $linha['nomeProduto']; ?></td>
                                            <td><?php echo $linha['qtdEstoque']; ?></td>
                                            <td><?php echo $fdatas->vemdata($linha['dataProduto']); ?></td>
                                            <td><?php echo $fdatas->vemdata($linha['dataValidade']); ?></td>
                                            <td><button type="button" class="btn btn-default"><img src="../img/edita.ico" width="16" onclick="editaNome('<?php echo $idProd; ?>', '<?php echo $idNome; ?>', '<?php echo $idData; ?>', '<?php echo $idQtd; ?>', '<?php echo $idValorC; ?>', '<?php echo $idValorV; ?>', '<?php echo $idSituacao; ?>', '<?php echo $idDataVal; ?>', '<?php echo $idDescr; ?>', '<?php echo $idFornIdForn; ?>', '<?php echo $idImagem; ?>');"></button></td>
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
                                                            <p>Deseja excluir os dados de <?php echo $linha['nomeProduto']; ?> ?</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <!-- TAVA ESQUECENDO DE COLOCAR NESSA PARTE OS DADOS PARA FAZER A EXCLUSÃO-->
                                                            <input type="hidden" name="idprodex" value="<?php echo $linha['codLote']; ?>" />
                                                            <input type="hidden" name="imgDel" value="<?php echo $linha['imagem']; ?>" />
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
    <script src="../js/valor.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/casa.js"></script>
    <script src="../js/main.js"></script>
    <script src="../bootstrapSelectpicker/js/jquery.min.js"></script>
    <script src="../bootstrapSelectpicker/js/bootstrap-select.js"></script>
    <script src="../bootstrapSelectpicker/js/bootstrap-select.mim.js"></script>
    <script>
        function previewFile() {
            var preview = document.querySelector('img');
            var file = document.querySelector('input[type=file]').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
    <script>
        function editaNome(a, b, c, d, e, f, g, h, i, j, k) {
            $('#confirmarEnvio').attr("disabled", true);
            $('#confirmarAtualizacao').attr("disabled", false);
            idProd.value = document.getElementById(a).value;
            idProd2.value = document.getElementById(a).value;
            nome.value = document.getElementById(b).value;
            dataProd.value = document.getElementById(c).value;
            qtdEstoq.value = document.getElementById(d).value;
            valComp.value = document.getElementById(e).value;
            valVen.value = document.getElementById(f).value;
            situ.value = document.getElementById(g).value;
            dataVali.value = document.getElementById(h).value;
            desc.value = document.getElementById(i).value;
            forn_idforn.value = document.getElementById(j).value;
            $('.selectpicker').selectpicker('refresh');
            document.getElementById("imagem").src = document.getElementById(k).value;
            textoFoto = "Foto atual";
            textoFile = "<label>Escolher nova foto</label><br>";
            var preview = document.querySelector('img');
            imagem2.value = document.querySelector('img');
            var reader = new FileReader();

            reader.onloadend = function() {
                //preview.src = reader.result;
                preview.src = document.getElementById(k).value;
            }
            reader.readAsDataURL(file);

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }

        }
    </script>
</body>
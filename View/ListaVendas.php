<?php
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION['perfil']!='0' || !isset($_SESSION['perfil'])){
    header("Location: ../Controller/derruba_session.php");
    exit();
}
include_once '../Controller/FuncoesControllerVenda.php';
$fcv = new FuncoesControllerVenda();
$linhas = $fcv->pesquisaListaVenda();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Vendas</title>
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
</head>

<body onLoad="entrada();" style=" background-image: url(../img/fundo8.jpg)">
    <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div>
                    <h3></h3>
                </div>
                <div class="panel panel-info">
                    <div class="panel painelRei">
                        <h3 class="text-primary" style="color: whitesmoke; text-align: center;">Listagem das Vendas</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Produto</th> <!-- nome do produto -> produtoLote -->
                                    <th>Qtd.Itens</th> <!-- qtdVenda -->
                                    <th>Data Venda</th> <!-- dataVenda -->
                                    <th>Hora Venda</th> <!-- horaVenda -->
                                    <th>Valor</th> <!-- valorTotal -->
                                    <th>Estorno</th> <!-- codVendaEstorno -->
                                    <th>Motivo</th> <!-- descricaoEstorno -->
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
                                        $idNome = "nomeProduto" . $a;
                                        $idCodVenda = "codVenda" . $a;
                                        $idQtd = "qtdVenda" . $a;
                                        $idHora = "horaVenda" . $a;
                                        $idData = "dataVenda" . $a;
                                        $idDataPag = "dataPagamento" . $a;
                                        $idFormPag = "formaPagamento" . $a;
                                        $idValor = "valorTotal" . $a;
                                        $idStatus = "statusVenda" . $a;
                                        $idEstorno = "codVendaEstorno" . $a;
                                        $idDescEstorno = "descricaoEstorno" . $a;

                                        /* Não sei se essa parte é necessária */
                                        $idFKCliente = "cliente_codCliente" . $a;
                                        $idFKEndereco = "endereco_codEndereco" . $a;

                                ?>
                                        <input type="hidden" id="<?php echo $idNome; ?>" value="<?php echo $linha['nomeProduto']; ?>" />
                                        <input type="hidden" id="<?php echo $idCodVenda; ?>" value="<?php echo $linha['codVenda']; ?>" />
                                        <input type="hidden" id="<?php echo $idQtd; ?>" value="<?php echo $linha['qtdVenda']; ?>" />
                                        <input type="hidden" id="<?php echo $idHora; ?>" value="<?php echo $linha['horaVenda']; ?>" />
                                        <input type="hidden" id="<?php echo $idData; ?>" value="<?php echo $linha['dataVenda']; ?>" />
                                        <input type="hidden" id="<?php echo $idDataPag; ?>" value="<?php echo $linha['dataPagamento']; ?>" />
                                        <input type="hidden" id="<?php echo $idFormPag; ?>" value="<?php echo $linha['formaPagamento']; ?>" />
                                        <input type="hidden" id="<?php echo $idValor; ?>" value="<?php echo $linha['valorTotal']; ?>" />
                                        <input type="hidden" id="<?php echo $idStatus; ?>" value="<?php echo $linha['statusVenda']; ?>" />
                                        <input type="hidden" id="<?php echo $idEstorno; ?>" value="<?php echo $linha['codVendaEstorno']; ?>" />
                                        <input type="hidden" id="<?php echo $idDescEstorno; ?>" value="<?php echo $linha['descricaoEstorno']; ?>" />

                                        <!-- Não sei se essa parte é necessária -->
                                        <input type="hidden" id="<?php echo $idFKCliente; ?>" value="<?php echo $linha['cliente_codCliente']; ?>" />
                                        <input type="hidden" id="<?php echo $idFKEndereco; ?>" value="<?php echo $linha['endereco_codEndereco']; ?>" />

                                        <tr>
                                            <td><?php echo $linha['nomeProduto']; ?></td>
                                            <td><?php echo $linha['qtdVenda']; ?></td>
                                            <td><?php echo $linha['dataVenda']; ?></td>
                                            <td><?php echo $linha['horaVenda']; ?></td>
                                            <td><?php echo $linha['valorTotal']; ?></td>
                                            <td><?php echo $linha['codVendaEstorno']; ?></td>
                                            <td><?php echo $linha['descricaoEstorno']; ?></td>

                                            <td><button type="button" class="btn btn-default"><img src="../img/edita.ico" width="16" onclick="editaNome('<?php echo $idNome; ?>', '<?php echo $idRazao; ?>', '<?php echo $idFantasia; ?>', '<?php echo $idCnpj; ?>', '<?php echo $idTelefone; ?>', '<?php echo $idEmail; ?>', '<?php echo $idCep; ?>', '<?php echo $idLogra; ?>', '<?php echo $idComple; ?>', '<?php echo $idBairro; ?>', '<?php echo $idCidade; ?>', '<?php echo $idNumero; ?>', '<?php echo $idUf; ?>');"></button></td>
                                        </tr>
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
    <script src="../js/jquery.mask.min.js" />
    </body>

</html>
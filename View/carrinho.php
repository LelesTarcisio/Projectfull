<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../Controller/FuncoesControllerProdutoLote.php';
include_once '../Controller/FuncoesControllerCliente.php';
$fcv = new FuncoesControllerProdutoLote();
$fcc = new FuncoesControllerCliente();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/estilo.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css.css">
    <style>
        td {
            text-align: center;
            padding: 5px;
            border: 1px solid red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table>
                    <form method="post" action="../Controller/finalizarCompra.php">
                        <?php
                        $valorTotal = 0;
                        $i = 0;
                        $valorTotalProduto = 0;
                        foreach ($_SESSION['carrinho'] as $key => $carrinho) {
                            $linhas = $fcv->pesquisaCodProdutoLote($key);
                            foreach ($linhas as $linha) {
                                $i++;
                                $valorTotalProduto = ((float) $linha['valorVenda'] * $carrinho);
                                $valorTotal += $valorTotalProduto;
                        ?>
                                <tr>
                                    <td><img src="<?php echo $linha['imagem']; ?>" width="64"></td>
                                    <td><?php echo $linha["nomeProduto"]; ?></td>
                                    <td><?php echo "R$ " . $linha["valorVenda"]; ?></td>
                                    <td>
                                        <input type="hidden" name="idProd<?php echo $i; ?>" value="<?php echo $key; ?>">
                                        <input type="hidden" name="vlrProd<?php echo $i; ?>" value="<?php echo $valorTotalProduto; ?>">
                                        <input type="text" maxlength="3" size="1" value="<?php echo $carrinho; ?>" name="qtdProd<?php echo $i; ?>"> Unid.
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                echo "Total dos produtos: " . $_SESSION['contador'] . " - Valor Total: R$ " . $valorTotal;
                ?>
            </div>
            <div class="col-md-4">
                <label>Forma de pagamento:</label>
                <select class="form-control" name="formaPgto">
                    <option value="1">Visa Crédito</option>
                    <option value="2">Master Crédito</option>
                </select><br>
                <input type="hidden" name="vlrT" value="<?php echo $valorTotal; ?>" />
                <input type="hidden" name="qtdI" value="<?php echo $i; ?>" />
                <input type="hidden" name="idVenda" value="<?php echo $lineId = $fcc->pesquisaIdCliente(); ?>" />
                <input class="btn btn-success" type="submit" value="Finalizar Compra" />
                <!-- <input class="btn btn-danger" type="text" onclick="<?php //$_SESSION['contador' == 0]?>" value="Cancelar Compra" /> -->
                <a href="../Controller/derruba_session.php" class="btn btn-danger">Cancelar Compra</a>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/casa.js"></script>
    <script src="../js/main.js"></script>
    <script>
        function refreshValor() {

        }
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
</head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="bootstrapSelectpicker/dist/css/bootstrap-select.min.css" />

<body>
    <div class="container">
        <div class="row">
            <h2>Carrinho de Compra - Exemplo <a href="derruba_session.php" class="btn btn-default">Sair</a></h2>
            <hr />
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                $idproduto = $_GET['produto'];
                include_once 'Conecta.php';
                $sql = "select * from produto where idProduto = '$idproduto' ";
                $query = mysqli_query($db, $sql) or die(mysqli_error($db));
                $linhas = mysqli_fetch_array($query);
                if ($linhas) {
                    do {
                ?>
                        <td style="padding: 10px;">
                            <img src="<?php echo $linhas['imagem']; ?>" style="padding: 5px; border: 1px solid blue;" width="200">
                            <br><?php echo $linhas["nome"]; ?><br><?php echo $linhas["valor"]; ?><br>
                            <form method="get" action="produtoSetCarrinho.php">
                                <input type="hidden" name="produtoCart" value="<?php echo $linhas['idProduto']; ?>">
                                <input type="submit" value="Comprar" class="btn btn-default" />
                            </form>
                        </td>
                    <?php
                    } while ($linhas = mysqli_fetch_array($query));
                    ?>
                <?php
                }
                ?>
                </tr>
            </div>
        </div>
    </div>

    <script src="bootstrapSelectpicker/js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrapSelectpicker/js/bootstrap-select.js"></script>
    <script src="bootstrapSelectpicker/js/bootstrap-select.mim.js"></script>
</body>

</html>
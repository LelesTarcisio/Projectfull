<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../Controller/FuncoesControllerProdutoLote.php';
$codProduto = $_GET['produto'];
$fcpl = new FuncoesControllerProdutoLote();
$linhas = $fcpl->pesquisaCodProdutoLote($codProduto);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/estilo.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css.css">

    <title> Produtos</title>
</head>

<body>
    <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">    
        <div class="row">
            <?php
            foreach ($linhas as $linha) {
            ?>
                <h2><?php echo $linha["nomeProduto"] ?></h2>
            <?php
            }
            ?>
           
            <hr />
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                foreach ($linhas as $linha) {
                ?>
                    <td style="padding: 10px;">
                        <img src="<?php echo $linha['imagem']; ?>" style="padding: 5px; border: 1px solid black;" width="200">
                        <br>
                        <?php echo $linha["nomeProduto"]; ?><br><?php echo $linha["valorVenda"]; ?><br>
                        <form method="get" action="../Controller/produto2.php">
                            <input type="hidden" name="produto2" value="<?php echo $linha['codLote']; ?>">
                            <input type="submit" value="Comprar" class="btn btn-default" />
                            <a href="../Controller/derruba_session.php" class="btn btn-default">Voltar</a>
                        </form>
                    </td>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/casa.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>
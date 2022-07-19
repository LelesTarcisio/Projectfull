<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
    $_SESSION['contador'] = 0;
}
include_once '../Controller/FuncoesControllerProdutoLote.php';
include_once '../Controller/FuncoesControllerCliente.php';
$fcpl = new FuncoesControllerProdutoLote();
$fcc = new FuncoesControllerCliente();
$linhas = $fcpl->pesquisaProdutoLote();
$linhaCliente = $fcc->pesquisaListaCliente();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>Produtos</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/estilo.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css.css">
</head>

<body>    
<?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    <div class="container">    
        <div class="row">
            <h2>Carrinho de Compra</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                echo "<img src='../img/cart0.png' width='76'>";
                echo "<label style='position:relative; top: -5px; left: -38px; font-weight: bold;
                    font-size:24px; color:#b12f0a'>" . $_SESSION['contador'] . "</label>";
                ?>
                <br>
                <a href="carrinho.php" class="btn btn-outline">Carrinho</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table>
                    <tr>
                        <?php
                        if ($linhas) {
                            $cont = 0;
                            foreach ($linhas as $linha) {
                                $cont++;
                                if ($cont > 5) {
                                    echo "</tr><tr>";
                                    $cont = 0;
                                }
                        ?>
                                <td style="padding: 10px;">
                                    <img src="<?php echo $linha['imagem']; ?>" style="padding: 5px;
                                 border: 1px solid blue;" width="180" height="180">
                                    <br>
                                    <?php echo $linha["nomeProduto"]; ?>
                                    <br>
                                    <?php echo $linha["valorVenda"]; ?>
                                    <br>
                                    <?php
                                    if ($linha["qtdEstoque"] > 0) {
                                    ?>
                                        <!-- 
                                >nessa form quando clicar no botão ira ser transferido para a pagina do produto;
                                >é interessante criar um button para deixar mais bonito aqui;
                                 -->
                                        <form method="get" action="produto.php">
                                            <input type="hidden" name="produto" value="<?php echo $linha['codLote']; ?>">
                                            <input type="submit" value="Comprar" class="btn btn-default" name="addCarrinho" />
                                        </form>
                                    <?php
                                    } else {
                                        echo "<label style='color:red; font-weight: bold; padding-top: 10px;'>Indisponível</label>";
                                    }
                                    ?>
                                </td>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/casa.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>
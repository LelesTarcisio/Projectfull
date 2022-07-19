<?php
session_start();
include_once 'ConectaDB.php';
foreach ($_SESSION['carrinho'] as $key => $carrinho) {
    $sql = "update produtoLote set qtdEstoque = (qtdEstoque - '$carrinho') where codLote = '$key'";    
    mysqli_query($db, $sql) or die(mysqli_error($db));
}
echo "<script>alert('Compra realizada com sucesso!');</script>";
echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
        URL='derruba_session.php'\">";

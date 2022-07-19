<?php
session_start();
$idp = $_GET['produtoCart'];
if (!isset($_SESSION['carrinho'][$idp])) {
    $_SESSION['carrinho'][$idp] = 1;
    $_SESSION['contador'] += 1;
} else {
    $_SESSION['carrinho'][$idp] += 1;
    $_SESSION['contador'] += 1;
}
echo "";
echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
        URL='LojaVenda.php'\">";

<?php
session_start();
$idp = $_GET['produto2'];
if(!isset($_SESSION['carrinho'][$idp])){
    $_SESSION['carrinho'][$idp] = 1;
}else{
    $_SESSION['carrinho'][$idp] += 1;
}
$_SESSION['contador'] += 1; 
echo "";
echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
        URL='../View/index.php'\">";

?>
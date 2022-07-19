<?php
ob_start();
session_start();
if($_SESSION['perfil'] === '0'){
    session_unset(); // Eliminar todas as variáveis da sessão
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: ../View/index.php");
    exit; 
} else{
    session_unset(); // Eliminar todas as variáveis da sessão
// Destrói a sessão por segurança
session_destroy();
// Redireciona o visitante de volta pro login
header("Location: ../View/index.php");
exit;
}
ob_end_flush();

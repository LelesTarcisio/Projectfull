<?php
if (!isset($_SESSION)) {
    session_start();
}
include ('Model/conecta.php');
if(empty($_POST['email']) || empty($_POST['senha'])) {
    header('location:index.php');
    exit();
}
$email = mysqli_real_escape_string($db, $_POST['email']);
$senha = mysqli_real_escape_string($db, $_POST['senha']);

$query = "select nome, perfil, email from usuario where email = '$email' and senha = sha1('$senha')";

$result = mysqli_query($db, $query);

$linha = mysqli_num_rows($result);

if($linha === 1) {
    $_SESSION['email'] = $email;
    $resultado = mysqli_fetch_array($result);
    $_SESSION['nome'] = $resultado['nome'];
    $_SESSION['perfil'] = $resultado['perfil'];
    $_SESSION['email'] = $resultado['email'];
    header('Location: View/painel.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}
 
 

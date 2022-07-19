<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'Model/Usuario.php';
$u = new Usuario();
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Projeto Login</title>
        <link rel="stylesheet" type="text/css" href="interface.css"
    </head>
    <body>
        
        
        
        <div id="corpo-form">
            <h1>Entrar</h1>  
            
            <?php
                    if (isset($_SESSION['nao_autenticado'])):
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                               URL='index.php'\">";
                        ?>
                        <div class="notification is-danger">
                            <p style="color: #FF0000" >ERRO: Usuario ou Senha inválidos.</p> 
                        </div>
                        <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>
            <div class="card-body">
            <form action="login2.php" method="post">
                <div class="input-group form-group">
                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>                
                <input type="email" name="email" class="form-control"  placeholder="Usuário">
                </div>
                
                <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                <input type="password" name="senha" class="form-control" placeholder="Senha">
                </div>
                
                <div class="form-group">
                <input type="submit" name="btn" value="ACESSAR" class="btn btn-success btn-default">
                </div>
                <a style="color: #fcfdfd" href="View/CadastroUsuario.php">Ainda não é inscrito?<strong style="color: #419641">Cadastre-se!</strong></a>
            </form>
        </div>
         
                         
          
</body>
</html>

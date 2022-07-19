<?php
if (!isset($_SESSION)) {
    session_start();
}
/* include_once ('verifica.php'); */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel Geral</title>
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
    <body style="background-image: url(../img/drinks.jpg) ; background-repeat: repeat;">
   <?php
    include_once 'View_Administrativo.php';
    $adm = new MenuAdministrativo();
    echo $adm->menuAdministrativo();
    ?>
    </body>
</html>



<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['email']) || $_SESSION['email'] === null) {
    echo "<script>alert('Faça o Login para finalizar a compra.');</script>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
        URL='../index.php'\">";
} else {
    include_once '../Controller/FuncoesControllerCliente.php';
    $email = $_SESSION['email'];
    $fcc = new FuncoesControllerCliente();
    $resultado = $fcc->pesquisaClienteCompleto($email);
    if($resultado) {
        include_once '../Controller/FuncoesControllerProdutoLote.php';
        include_once '../Controller/FuncoesControllerVenda.php';
        include_once '../Controller/FuncoesControllerCliente.php';
        $fcpl = new FuncoesControllerProdutoLote();
        $fcv = new FuncoesControllerVenda();
        $qtdI = $_POST['qtdI'];
        $formaPgto = $_POST['formaPgto'];
        $id = "";
        $qtdP = "";
        foreach ($resultado as $resul){
            $fkCli = $resul['codCliente'];
            $fkEnd = $resul['codEndereco'];
        }
        $codVenda = $fcv->inserirVenda($formaPgto, $fkCli, $fkEnd);
        for ($x = 1; $x <= $qtdI; $x++) {
            $id = "idProd$x";
            $qtdP = "qtdProd$x";
            $vlrP = "vlrProd$x";
            $id = $_POST["$id"];
            $qtdP = $_POST["$qtdP"];
            $vlrP = $_POST["$vlrP"];
            //echo "idProduto = $id, qtdProduto = $qtdP";
            // fazer o insert para venda 
            // insert venda values (null, 0, current_time(), current_date(), 1)
            /* depois pegar o idVenda 
             * select idVenda from venda where horaVenda = current_time() and
             * dataVenda = current_date();
             * $fkvenda = $linha['idVenda'];
             * e fazer o insert da associativa (venda_produto)
             * insert into venda_produto values ('$fkvenda','$id','$qtdP');
             *  mysqli_query($db, $sql)or die(mysqli_error($db));
             */
            $fcv->inserirVendaProdutoLote($codVenda, $id, $qtdP, $vlrP);
            $fcpl->atualizaEstoqueProdutoLote($id, $qtdP);
        }
        echo "<script>alert('Compra realizada com sucesso!');</script>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
        URL='derruba_session.php'\">";
        
    } else {
        echo "<script>alert('Cadastre os seus dados para finalizar a compra.');</script>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
        URL='../View/CadastroCliente.php'\">";
    }
}


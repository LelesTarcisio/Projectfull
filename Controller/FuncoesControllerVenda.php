<?php
class FuncoesControllerVenda{
    
    public function pesquisaVendaCarrinho(){
        include_once '../Model/System_of_a_DAO.php';
        $venda = new vendaDAO();
        $msg = $venda->pesquisaVendaCarrinhoDAO();
        return $msg;
    }

    public function finalizarCompraCarrinho(){
        include_once '../Model/System_of_a_DAO.php';
        $venda = new vendaDAO();
        $msg = $venda->finalizarCompraDAO($codiVenda, $qtdVenda, $hora, $data, $dataPag, $pag, $valTotal,
        $desc, $stat, $codEstorno, $descEstorno, $qtdI);
        return $msg;
    }

    public function pesquisaVendaLoja(){
        include_once '../Model/System_of_a_DAO.php';
        $loja = new vendaDAO();
        $msg = $loja->pesquisaVendaLojaDAO();
        return $msg;
    }
    
    public function inserirVenda($pagamento, $fkCliente, $fkEndereco){
        include_once '../Model/System_of_a_DAO.php';
        $loja = new vendaDAO();
        $msg = $loja->inserirVendaDAO($pagamento, $fkCliente, $fkEndereco);
        return $msg;
    }
    
    public function inserirVendaProdutoLote($fkVenda, $codigoProduto, $qtdProduto, $valor){
        include_once '../Model/System_of_a_DAO.php';
        $loja = new vendaDAO();
        $msg = $loja->inserirVendaProdutoLoteDAO($fkVenda, $codigoProduto, $qtdProduto, $valor);
        return $msg;
    }
}

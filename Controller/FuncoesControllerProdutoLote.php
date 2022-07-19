<?php

class FuncoesControllerProdutoLote {

    public function inserirProdutoLote($codigo, $nome, $dataProduto, $qtdEstoque, $valorCompra, $valorVenda, $situacao, $descricao, $dataValidade, $imagem, $forn_idforn) {
        include_once '../Model/System_of_a_DAO.php';
        $prodLoteDao = new produtoLoteDAO();
        
        $codigo = (int) $codigo;
        
        /*
         * Dando problema com as colunas, ver se não tem a mais indo para o banco de dados.
         */       
        
        $valorCompra = trim($valorCompra);
        $valorCompra = str_replace(".", "", $valorCompra);
        $valorCompra = str_replace(",", ".", $valorCompra);
        
        $valorVenda = trim($valorVenda);
        $valorVenda = str_replace(".", "", $valorVenda);
        $valorVenda = str_replace(",", ".", $valorVenda);
        
        $imagem = (string) $imagem;
        
        
        $msg = $prodLoteDao->inserirProdutoLoteDAO($codigo, $nome, $dataProduto, $qtdEstoque, $valorCompra, $valorVenda, $situacao, $descricao, $dataValidade, $imagem, $forn_idforn);
        return $msg;
    }
    
    public function editarProdutoLote($codigo, $nome, $dataProduto, $qtdEstoque, $valorCompra, $valorVenda, $situacao, $descricao, $dataValidade, $imagem, $forn_idforn) {
        include_once '../Model/System_of_a_DAO.php';
        $prodLoteDao = new produtoLoteDAO();
        $msg = $prodLoteDao->editarProdutoLoteDAO($codigo, $nome, $dataProduto, $qtdEstoque, $valorCompra, $valorVenda, $situacao, $descricao, $dataValidade, $imagem, $forn_idforn);
        return $msg;
    }
    
    public function excluiProdutoLote($codigo) {
        include_once '../Model/System_of_a_DAO.php';
        $prodLoteDao = new produtoLoteDAO();
        $msg = $prodLoteDao->excluiProdutoLoteDao($codigo);
        return $msg;
    }
    
    public function proximoCodigoProdutoLote() {
        include_once '../Model/System_of_a_DAO.php';
        $prodLoteDao = new produtoLoteDAO();
        $msg = $prodLoteDao->proximoCodigoProdutoLoteDAO();
        return $msg;
    }
    
    public function pesquisaProdutoLote() {
        include_once '../Model/System_of_a_DAO.php';
        $prodLoteDao = new produtoLoteDAO();
        $msg = $prodLoteDao->pesquisaProdutoLoteDAO();
        return $msg;
        
    }
    
    public function pesquisaCodProdutoLote($codProduto) {
        include_once '../Model/System_of_a_DAO.php';
        $prodLoteDao = new produtoLoteDAO();
        $msg = $prodLoteDao->pesquisaCodProdutoDAO($codProduto);
        return $msg;
        
    }
    
    public function atualizaEstoqueProdutoLote($codProduto, $qtd) {
        include_once '../Model/System_of_a_DAO.php';
        $prodLoteDao = new produtoLoteDAO();
        $msg = $prodLoteDao->atualizaEstoqueProdutoLoteDAO($codProduto, $qtd);
        return $msg;
        
    }
}

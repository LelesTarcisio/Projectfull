<?php

class FuncoesControllerEndereco {

    public function inserirEndereco($cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf) {
        include_once '../Model/System_of_a_DAO.php';
        $enderecoDAO = new EnderecoDAO();
        $mensagem = $enderecoDAO->inserirEnderecoDAO($cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf);
        
     
        $cep = trim($cep);
        $cep = str_replace("-", "", $cep);
        return $mensagem;
    }

    public function pesquisaCodEndereco($cep, $logradouro, $numero) {
        include_once '../Model/System_of_a_DAO.php';
        $enderecoDAO = new EnderecoDAO();
        $linhaNova = $enderecoDAO->pesquisaCodEnderecoDAO($cep, $logradouro, $numero);
        return $linhaNova;
    }
    
     public function pesquisaEndereco() {
        include_once '../Model/System_of_a_DAO.php';
        $enderecoDAO = new EnderecoDAO();
        $linhaNova = $enderecoDAO->pesquisaEnderecoDAO();
        return $linhaNova;
    }

    public function editarEndereco($codEndereco, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf) {
        include_once '../Model/System_of_a_DAO.php';
        $enderecoDAO = new EnderecoDAO();
        $mensagem = $enderecoDAO->editarEnderecoDAO($codEndereco, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf);
        
        

        $cep = trim($cep);
        $cep = str_replace("-", "", $cep);
        
        return $mensagem;
    }

    public function excluirEndereco($codEndereco) {
        include_once '../Model/System_of_a_DAO.php';
        $enderecoDAO = new EnderecoDAO();
        $mensagem = $enderecoDAO->excluirEnderecoDAO($codEndereco);
        return $mensagem;
    }

    public function proximoCodigoEndereco() {
        include_once '../Model/System_of_a_DAO.php';
        $enderecoDAO = new EnderecoDAO();
        $mensagem = $enderecoDAO->proximoCodigoEnderecoDAO();
        return $mensagem;
    }

}


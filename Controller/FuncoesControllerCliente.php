<?php

class FuncoesControllerCliente {

    public function inserirCliente($codCliente, $tipoCliente, $nomeCliente, $cpf_cnpj, $fixo, $movel, $email, $nomeRepresentante, $ativo, $endereco_codEndereco,$fkusuario) {
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $mensagem = $clienteDAO->inserirClienteDAO($codCliente, $tipoCliente, $nomeCliente, $cpf_cnpj, $fixo, $movel, $email, $nomeRepresentante, $ativo, $endereco_codEndereco,$fkusuario);
       
        return $mensagem;
    }

    public function pesquisaCliente($email) {
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $linhaNova = $clienteDAO->pesquisaClienteDAO($email);
        return $linhaNova;
    }
    
    public function pesquisaClienteCompleto($email) {
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $linhaNova = $clienteDAO->pesquisaClienteCompletoDAO($email);
        return $linhaNova;
    }

    public function editarCliente($codCliente, $tipoCliente, $nomeCliente, $cpf_cnpj, $fixo, $movel, $email, $nomeRepresentante, $ativo, $endereco_codEndereco, $fkusuario){
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $mensagem = $clienteDAO->editarClienteDAO($codCliente, $tipoCliente, $nomeCliente, $cpf_cnpj, $fixo, $movel, $email, $nomeRepresentante, $ativo, $endereco_codEndereco, $fkusuario);
    }

    public function excluirCliente($codCliente) {
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $mensagem = $clienteDAO->excluirClienteDAO($codCliente);
        return $mensagem;
    }

    public function proximoCodigoCliente() {
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $mensagem = $clienteDAO->proximoCodigoClienteDAO();
        return $mensagem;
    }

    public function pesquisaListaCliente() {
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $mensagem = $clienteDAO->pesquisaListaClienteDAO();
        return $mensagem;
    }

    public function pesquisaIdCliente(){
        include_once '../Model/System_of_a_DAO.php';
        $clienteDAO = new ClienteDAO();
        $mensagem = $clienteDAO->pesquisaIdClienteDAO();
        return $mensagem;
    }

}

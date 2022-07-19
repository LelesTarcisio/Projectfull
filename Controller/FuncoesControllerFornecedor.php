<?php

class FuncoesControllerFornecedor {

    public function inserirFornecedor($codigo, $nome, $razao, $cnpj, $telefone, $email, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf) {
        include_once '../Model/System_of_a_DAO.php';
        $forDAO = new FornecedorDAO();
        $cnpj = trim($cnpj);
        $cnpj = str_replace(".", "", $cnpj);
        $cnpj = str_replace(",", "", $cnpj);
        $cnpj = str_replace("-", "", $cnpj);
        $cnpj = str_replace("/", "", $cnpj);

        $telefone = trim($telefone);
        $telefone = str_replace("(", "", $telefone);
        $telefone = str_replace(")", "", $telefone);
        $telefone = str_replace("-", "", $telefone);
        $telefone = str_replace(" ", "", $telefone);

        $cep = trim($cep);
        $cep = str_replace("-", "", $cep);

        $codigo = (int) $codigo;
        
        if ($complemento === "") {
            $complemento = "-";
        }

        /* echo "<script> alert($cnpj); </script>"; */
        $mensagem = $forDAO->inserirFornecedorDAO($codigo, $nome, $razao, $cnpj, $telefone, $email, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf);
        return $mensagem;
    }

    public function proximoFornecedor() {
        include_once '../Model/System_of_a_DAO.php';
        $forDAO = new FornecedorDAO();
        $mensagem = $forDAO->proximoCodigoFornecedorDAO();
        return $mensagem;
    }

    public function pesquisaFornecedor() {
        include_once '../Model/System_of_a_DAO.php';
        $forDAO = new FornecedorDAO();
        $mensagem = $forDAO->pesquisaFornecedorDAO();
        return $mensagem;
    }

    public function excluirFornecedor($codigo) {
        include_once '../Model/System_of_a_DAO.php';
        $forDAO = new FornecedorDAO();
        $mensagem = $forDAO->excluiFornecedorDao($codigo);
        return $mensagem;
    }

    public function atualizarFornecedor($codigo, $nome, $razao, $cnpj, $telefone, $email, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf) {
        include_once '../Model/System_of_a_DAO.php';
        $forDAO = new FornecedorDAO();
        $mensagem = $forDAO->editarFornecedorDAO($codigo, $nome, $razao, $cnpj, $telefone, $email, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf);
        return $mensagem;
    }
    
    /*
    public function pesquisaCon($sql) {
        include_once '../Model/System_of_a_DAO.php';
        $pesq = new FornecedorDAO();
        $msg = $pesq->pesquisa($sql);
        return $msg;
    }
    */
}

/* https://forum.imasters.com.br/topic/223948-tirar-m%C3%A1scara-do-cnpj-p-guardar-no-banco/ 
 * http://blogs.ambientelivre.com.br/marcio/limpando-caracteres-especiais-de-documentos-cpf-cnpj-em-php/
 * https://www.clubedohardware.com.br/forums/topic/901784-remover-caracteres-do-php/
 *  */
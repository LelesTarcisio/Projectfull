<?php

class FuncoesControllerUsuario {

    public function inserirUsuario($nome, $telefone, $email, $senha, $confirmarSenha, $perfil, $ativo) {
        if($senha == $confirmarSenha){
            include_once '../Model/System_of_a_DAO.php';
            $usuarioDAO = new UsuarioDAO();
            $mensagem = $usuarioDAO->inserirUsuarioDAO($nome, $telefone, $email, $senha, $perfil, $ativo);
        }else{
            $mensagem = "<p style='color: #efd52a;'>A senha não é igual à confirmação da senha.</p>";
        }
        return $mensagem;
    }

    public function pesquisaUsuario() {
        include_once '../Model/System_of_a_DAO.php';
        $usuarioDAO = new UsuarioDAO();
        $linhaNova = $usuarioDAO->pesquisaUsuarioDAO();
        return $linhaNova;
    }

    public function editarUsuario($nome, $telefone, $email, $perfil, $ativo) {
        include_once '../Model/System_of_a_DAO.php';
        $usuarioDAO = new UsuarioDAO();
        $mensagem = $usuarioDAO->editarUsuarioDAO($nome, $telefone, $email, $perfil, $ativo);
        return $mensagem;
    }

    public function excluirUsuario($email) {
        include_once '../Model/System_of_a_DAO.php';
        $usuarioDAO = new UsuarioDAO();
        $mensagem = $usuarioDAO->excluirUsuarioDAO($email);
        return $mensagem;
    }

    public function pesquisaUsuarioLoja($email){
        include_once '../Model/System_of_a_DAO.php';
        $usuarioDAO = new UsuarioDAO();
        $mensagem = $usuarioDAO->pesquisaUsuarioLojaDAO($email);
        return $mensagem;
    }

//    public function proximoCodigoUsuario() {
//        include_once '../Model/System_of_a_DAO.php';
//        $usuarioDAO = new UsuarioDAO();
//        $mensagem = $usuarioDAO->proximoCodigoUsuarioDAO();
//        return $mensagem;
//    }

}

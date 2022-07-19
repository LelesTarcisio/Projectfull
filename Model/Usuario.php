<?php

class Usuario{
    private $nome; //nome do usuario
    private $telefone; //Telefone de contato do usuario.
    private $email; //email de cadastro do usuario.
    private $senha; //senha de cadastro do usuario.
    private $perfil; //perfil do usuario.
    private $ativo; //Se o usuario encontra-se ativo ou inativo.
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }
     public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
     public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getSenha(){
        return $this->senha;
    }  
     public function setPerfil($perfil){
        $this->perfil = $perfil;
    }
    public function getPerfil(){
        return $this->perfil;
    }
     public function setAtivo($ativo){
        $this->ativo = $ativo;
    }
    public function getAtivo(){
        return $this->ativo;
    }
    
}
       


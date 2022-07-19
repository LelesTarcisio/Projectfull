<?php

class endereco{
    private $codEndereco; //código do endereço
    private $cep; //cep
    private $cidade; //cidade
    private $logradouro; //logradouro
    private $bairro; //bairro
    private $complemento; //complemento 
    private $numero; //numero 
    private $uf; //uf
   
    
    public function setCodEndereco($codEndereco){
        $this->codEndereco = $codEndereco;
    }
    public function getCodEndereco(){
        return $this->codEndereco;
    }
    public function setCep($cep){
        $this->cep = $cep;
    }
    public function getCep(){
        return $this->cep;
    }
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function getCidade(){
        return $this->cidade;
    }
    public function setLogradouro($logradouro){
        $this->logradouro = $logradouro;
    }
    public function getLogradouro(){
        return $this->logradouro;
    }
    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
    public function getBairro(){
        return $this->bairro;
    }
    public function setComplemento($complemento){
        $this->complemento = $complemento;
    }
    public function getComplemento(){
        return $this->complemento;
    }
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function setUf($uf){
        $this->uf = $uf;
    }
    public function getUf(){
        return $this->uf;
    }
    
    
}


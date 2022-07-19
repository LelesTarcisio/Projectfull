<?php

class Fornecedor {

    private $codigo; //idfornecedor
    private $nome; //nomeFantasia
    private $razao; //razaoSocial
    private $cnpj; //cnpj
    private $telefone; //telefone
    private $email; //e-mail
    private $cep; //cep
    private $cidade; //cidade
    private $logradouro; //logradouro
    private $bairro; //bairro
    private $complemento; //complemento
    private $numero; //numero
    private $uf; //uf

    //SET - Mais seta aqui que no trânsito.

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setRazao($razao) {
        $this->razao = $razao;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }

    //GET - veeeeeeeeeeeeeeeeeeenha!!

    public function getCodigo() {
        return $this->codigo;
    }
    
    public function getNome() {
        return $this->nome;
        
    }

    public function getRazao() {
        return $this->razao;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getUf() {
        return $this->uf;
    }

}

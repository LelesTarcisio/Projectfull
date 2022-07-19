<?php

class Produto {
    private $codigo; //codProduto
    private $nome; //nome
    private $descricao; //descricao
    private $imagem; //imagem
    
    
    //SET -
    
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;        
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    
    //GET
    
    public function getCodigo() {
        return $this->codigo;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function getImagem() {
        return $this->imagem;
    }
}
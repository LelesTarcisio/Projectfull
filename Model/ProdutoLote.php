<?php

class ProdutoLote {

    private $codigo; //codLote
    private $nome; //nomeProduto
    private $dataProduto; //dataProduto
    private $qtdEst; //qtdEstoque
    private $valCompra; //valorCompra(Unidade)
    private $valVenda; //valorVenda
    private $situacao; //situacao
    private $desc; //descricao
    private $dataVal; //dataValidade
    private $imagem; //imagem
    private $forn_idforn; //fornecedor_idfornecedor

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setDataProduto($dataProduto) {
        $this->dataProduto = $dataProduto;
    }
    
    public function getDataProduto() {
        return $this->dataProduto;
    }
    
    public function setQtdEst($qtdEst) {
        $this->qtdEst = $qtdEst;
    }
    
    public function getQtdEst() {
        return $this->qtdEst;
    }
    
    public function setValCompra($valCompra) {
        $this->valCompra = $valCompra;
    }
    
    public function getValCompra() {
        return $this->valCompra;
    }
    
    public function setValVenda($valVenda) {
        $this->valVenda = $valVenda;
    }
    
    public function getValVenda() {
        return $this->valVenda;
    }
    
    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
    
    public function getSituacao() {
        return $this->situacao;
    }
    
    public function setDesc($desc) {
        $this->desc = $desc;
    }
    
    public function getDesc() {
        return $this->desc;
    }
    
    public function setDataVal($dataVal) {
        $this->dataVal = $dataVal;
    }
    public function getDataVal() {
        return $this->dataVal;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    public function getImagem() {
        return $this->imagem;
    }
    public function setForn_IdForn($forn_idforn) {
        $this->forn_idforn = $forn_idforn;
    }
    public function getForn_IdForn() {
        return $this->forn_idforn;
    }
}

<?php

class Venda {

    private $codigo; //codVenda
    private $qtdVenda; //qtdVenda
    private $hora; //horaVenda
    private $data; //dataVenda
    private $dataPagamento; //dataPagamento
    /* private $entrega; //tipoEntrega */
    private $pagamento; //formaPagamento
    /* private $valorFrete; //valorFrete */
    private $valorTotal; //valorTotal
    private $desconto; //descontoVenda
    private $status; //statusVenda
    private $codigoEstorno; //codVendaEstorno
    private $descricaoEstorno; //descricaoEstorno
    private $fkCliente; //cliente_codCliente
    private $fkEndereco; //endereco_codEndereco

    //SET & GET

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setQtdVenda($qtdVenda) {
        $this->qtdVenda = $qtdVenda;
    }

    public function getQtdVenda() {
        return $this->qtdVenda;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function getHora() {
        return $this->hota;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function setDataPagamento($dataPagamento) {
        $this->dataPagamento = $dataPagamento;
    }

    public function getDataPagamento() {
        return $this->dataPagamento;
    }

    /* public function setEntrega($entrega) {
        $this->entrega = $entrega;
    }

    public function getEntrega() {
        return $this->entrega;
    } */

    public function setPagamento($pagamento) {
        $this->pagamento = $pagamento;
    }

    public function getPagamento() {
        return $this->pagamento;
    }

   /*  public function setValorFrete($valorFrete) {
        $this->valorFrete = $valorFrete;
    }

    public function getValorFrete() {
        return $this->valorFrete;
    } */

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    public function getValorTotal() {
        return $this->valorTotal;
    }

    public function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    public function getDesconto() {
        return $this->desconto;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setCodigoEstorno($codigoEstorno) {
        $this->codigoEstorno = $codigoEstorno;
    }

    public function getCodigoEstorno() {
        return $this->codigoEstorno;
    }

    public function setDescricaoEstorno($descricaoEstorno) {
        $this->descricaoEstorno = $descricaoEstorno;
    }

    public function getDescricaoEstorno() {
        return $this->descricaoEstorno;
    }
    
    public function setFkCliente($fkCliente) {
        $this->fkCliente = $fkCliente;
    }

    public function getFkCliente() {
        return $this->fkCliente;
    }
    
    public function setFkEndereco($fkEndereco) {
        $this->fkEndereco= $fkEndereco;
    }

    public function getFkEndereco() {
        return $this->fkEndereco;
    }

}

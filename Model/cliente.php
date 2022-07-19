<?php

class cliente{
    private $codCliente; //código do cliente
    private $tipoCliente; //Tipo do cliente
    private $nomeCliente; //Nome de cliente se é físico ou juridico
    private $cpf_cnpj; //cpf ou cnpj
    private $fixo; //telefone fixo
    private $movel; //telefone movel
    private $email; //email 
    private $nomeRepresentante; //Nome da empresa 
    private $ativo; //se esta ativo ou inativo na empresa
    private $endereco_codEndereco; //chave estrangeira 
    private $fkusuario; //chave estrangeira 
    
    public function setCodCliente($codCliente){
        $this->codCliente = $codCliente;
    }
    public function getCodCliente(){
        return $this->codCliente;
    }
     public function setTipoCliente($tipoCliente){
        $this->tipoCliente = $tipoCliente;
    }
    public function getTipoCliente(){
        return $this->tipoCliente;
    }
    public function setNomeCliente($nomeCliente){
        $this->nomeCliente = $nomeCliente;
    }
    public function getNomeCliente(){
        return $this->nomeCliente;
    }
   
    public function setCpf_Cnpj($cpf_cnpj){
        $this->cpf_cnpj = $cpf_cnpj;
    }
    public function getCpf_Cnpj(){
        return $this->cpf_cnpj;
    }
    public function setFixo($fixo){
        $this->fixo = $fixo;
    }
    public function getFixo(){
        return $this->fixo;
    }
    public function setMovel($movel){
        $this->movel = $movel;
    }
    public function getMovel(){
        return $this->movel;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setNomeRepresentante($nomeRepresentante){
        $this->nomeRepresentante = $nomeRepresentante;
    }
    public function getNomeRepresentante(){
        return $this->nomeRepresentante;
    }
    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }
    public function getAtivo(){
        return $this->ativo;
    }
    public function setEndereco_codEndereco($endereco_codEndereco){
        $this->endereco_codEndereco = $endereco_codEndereco;
    }
    public function getEndereco_codEndereco(){
        return $this->endereco_codEndereco;
    }
    public function setFkusuario($fkusuario){
        $this->fkusuario = $fkusuario;
    }
    public function getFkusuario(){
        return $this->fkusuario;
    }
    
}

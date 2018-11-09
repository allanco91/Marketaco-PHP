<?php

namespace Marketaco;

class LancamentoCaixa
{
    private $LancamentoCaixaID;
    private $Data;
    private $Descricao;
    private $Entrada;
    private $Saida;
    private $Observacao;
    private $Excluir;
    private $CaixaID;
    private $FormaPagamentoID;
    private $PedidoID;

    //Contrutor
    function __construct($LancamentoCaixaID, $Data, $Descricao, $Entrada, $Saida, $Observacao, $Excluir, $CaixaID, $FormaPagamentoID, $PedidoID)
    {
        $this->LancamentoCaixa = $LancamentoCaixaID;
        $this->Data = $Data;
        $this->Descricao = $Descricao;
        $this->Entrada = $Entrada;
        $this->Saida = $Saida;
        $this->Observacao = $Observacao;
        $this->Excluir = $Excluir;
        $this->CaixaID = $CaixaID;
        $this->FormaPagamentoID = $FormaPagamentoID;
        $this->PedidoID = $PedidoID;
	}

    /*GETs and SETs*/
    public function getLancamentoCaixaID(){
		return $this->LancamentoCaixaID;
	}

	public function setLancamentoCaixaID($LancamentoCaixaID){
		$this->LancamentoCaixaID = $LancamentoCaixaID;
	}

	public function getData(){
		return $this->Data;
	}

	public function setData($Data){
		$this->Data = $Data;
	}

	public function getDescricao(){
		return $this->Descricao;
	}

	public function setDescricao($Descricao){
		$this->Descricao = $Descricao;
	}

	public function getEntrada(){
		return $this->Entrada;
	}

	public function setEntrada($Entrada){
		$this->Entrada = $Entrada;
	}

	public function getSaida(){
		return $this->Saida;
	}

	public function setSaida($Saida){
		$this->Saida = $Saida;
	}

	public function getObservacao(){
		return $this->Observacao;
	}

	public function setObservacao($Observacao){
		$this->Observacao = $Observacao;
	}

	public function getExcluir(){
		return $this->Excluir;
	}

	public function setExcluir($Excluir){
		$this->Excluir = $Excluir;
	}

	public function getCaixaID(){
		return $this->CaixaID;
	}

	public function setCaixaID($CaixaID){
		$this->CaixaID = $CaixaID;
	}

	public function getFormaPagamentoID(){
		return $this->FormaPagamentoID;
	}

	public function setFormaPagamentoID($FormaPagamentoID){
		$this->FormaPagamentoID = $FormaPagamentoID;
	}

	public function getPedidoID(){
		return $this->PedidoID;
	}

	public function setPedidoID($PedidoID){
		$this->PedidoID = $PedidoID;
	}    
}
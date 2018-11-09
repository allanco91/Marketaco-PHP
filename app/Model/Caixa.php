<?php

namespace Marketaco;

class Caixa
{
    private $CaixaID;
    private $Data_Abertura;
    private $Data_Fechamento;
    private $SaldoInicial;
    private $SaldoFinal;
    private $E_Dinheiro;
    private $C_Debito;
    private $C_Credito;
    private $E_Cheque;
    private $SaldoDinheiro;
    private $S_Dinheiro;
    private $S_Cheque;
    private $Observacao;
    private $Status;

    /*Construtor*/
    function __construct($CaixaID, $Data_Abertura, $Data_Fechamento, $SaldoInicial, $SaldoFinal, $E_Dinheiro, $C_Debito, $C_Credito, $E_Cheque, $SaldoDinheiro, $S_Dinheiro, $S_Cheque, $Observacao, $Status)
    {
        $this->CaixaID = $CaixaID;
        $this->Data_Abertura = $Data_Abertura;
        $this->Data_Fechamento = $Data_Fechamento;
        $this->SaldoInicial = $SaldoInicial;
        $this->SaldoFinal = $SaldoFinal;
        $this->E_Dinheiro = $E_Dinheiro;
        $this->C_Debito = $C_Debito;
        $this->C_Credito = $C_Credito;
        $this->E_Cheque = $E_Cheque;
        $this->SaldoDinheiro = $SaldoDinheiro;
        $this->S_Dinheiro = $S_Dinheiro;
        $this->S_Cheque = $S_Cheque;
        $this->Observacao = $Observacao;
        $this->Status = $Status;
    }

    /*GETs and SETs*/
    public function getCaixaID(){
		return $this->CaixaID;
	}

	public function setCaixaID($CaixaID){
		$this->CaixaID = $CaixaID;
	}

	public function getData_Abertura(){
		return $this->Data_Abertura;
	}

	public function setData_Abertura($Data_Abertura){
		$this->Data_Abertura = $Data_Abertura;
	}

	public function getData_Fechamento(){
		return $this->Data_Fechamento;
	}

	public function setData_Fechamento($Data_Fechamento){
		$this->Data_Fechamento = $Data_Fechamento;
	}

	public function getSaldoInicial(){
		return $this->SaldoInicial;
	}

	public function setSaldoInicial($SaldoInicial){
		$this->SaldoInicial = $SaldoInicial;
	}

	public function getSaldoFinal(){
		return $this->SaldoFinal;
	}

	public function setSaldoFinal($SaldoFinal){
		$this->SaldoFinal = $SaldoFinal;
	}

	public function getE_Dinheiro(){
		return $this->E_Dinheiro;
	}

	public function setE_Dinheiro($E_Dinheiro){
		$this->E_Dinheiro = $E_Dinheiro;
	}

	public function getC_Debito(){
		return $this->C_Debito;
	}

	public function setC_Debito($C_Debito){
		$this->C_Debito = $C_Debito;
	}

	public function getC_Credito(){
		return $this->C_Credito;
	}

	public function setC_Credito($C_Credito){
		$this->C_Credito = $C_Credito;
	}

	public function getE_Cheque(){
		return $this->E_Cheque;
	}

	public function setE_Cheque($E_Cheque){
		$this->E_Cheque = $E_Cheque;
	}

	public function getSaldoDinheiro(){
		return $this->SaldoDinheiro;
	}

	public function setSaldoDinheiro($SaldoDinheiro){
		$this->SaldoDinheiro = $SaldoDinheiro;
	}

	public function getS_Dinheiro(){
		return $this->S_Dinheiro;
	}

	public function setS_Dinheiro($S_Dinheiro){
		$this->S_Dinheiro = $S_Dinheiro;
	}

	public function getS_Cheque(){
		return $this->S_Cheque;
	}

	public function setS_Cheque($S_Cheque){
		$this->S_Cheque = $S_Cheque;
	}

	public function getObservacao(){
		return $this->Observacao;
	}

	public function setObservacao($Observacao){
		$this->Observacao = $Observacao;
	}

	public function getStatus(){
		return $this->Status;
	}

	public function setStatus($Status){
		$this->Status = $Status;
	}
}
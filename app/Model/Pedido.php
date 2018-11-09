<?php

namespace Marketaco;

class Pedido
{
    private $PedidoID;
    private $Data;
    private $DataEntrega;
    private $DataSaida;
    private $ValorTotal;
    private $FormaPag;
    private $Desconto;
    private $ValorFinal;
    private $ValorPago;
    private $Saldo;
    private $Troco;
    private $Pago;
    private $ClienteID;
    private $EnderecoID;
    private $StatusPedidoID;

    /*Contrutor*/
    function __construct($PedidoID, $Data, $DataEntrega, $DataSaida, $ValorTotal, $FormaPag, $Desconto, $ValorFinal, $ValorPago, $Saldo, $Troco, $Pago, $ClienteID, $EnderecoID, $StatusPedidoID)
    {
        $this->PedidoID = $PedidoID;
        $this->Data = $Data;
        $this->DataEntrega = $DataEntrega;
        $this->DataSaida = $DataSaida;
        $this->ValorTotal = $ValorTotal;
        $this->FormaPag = $FormaPag;
        $this->Desconto = $Desconto;
        $this->ValorFinal = $ValorFinal;
        $this->ValorPago = $ValorPago;
        $this->Saldo = $Saldo;
        $this->Troco = $Troco;
        $this->Pago = $Pago;
        $this->ClienteID = $ClienteID;
        $this->EnderecoID = $EnderecoID;
        $this->StatusPedidoID = $StatusPedidoID;
    }

    /*GETs and SETs*/
    public function getPedidoID(){
		return $this->PedidoID;
	}

	public function setPedidoID($PedidoID){
		$this->PedidoID = $PedidoID;
	}

	public function getData(){
		return $this->Data;
	}

	public function setData($Data){
		$this->Data = $Data;
	}

	public function getDataEntrega(){
		return $this->DataEntrega;
	}

	public function setDataEntrega($DataEntrega){
		$this->DataEntrega = $DataEntrega;
	}

	public function getDataSaida(){
		return $this->DataSaida;
	}

	public function setDataSaida($DataSaida){
		$this->DataSaida = $DataSaida;
	}

	public function getValorTotal(){
		return $this->ValorTotal;
	}

	public function setValorTotal($ValorTotal){
		$this->ValorTotal = $ValorTotal;
	}

	public function getFormaPag(){
		return $this->FormaPag;
	}

	public function setFormaPag($FormaPag){
		$this->FormaPag = $FormaPag;
	}

	public function getDesconto(){
		return $this->Desconto;
	}

	public function setDesconto($Desconto){
		$this->Desconto = $Desconto;
	}

	public function getValorFinal(){
		return $this->ValorFinal;
	}

	public function setValorFinal($ValorFinal){
		$this->ValorFinal = $ValorFinal;
	}

	public function getValorPago(){
		return $this->ValorPago;
	}

	public function setValorPago($ValorPago){
		$this->ValorPago = $ValorPago;
	}

	public function getSaldo(){
		return $this->Saldo;
	}

	public function setSaldo($Saldo){
		$this->Saldo = $Saldo;
	}

	public function getTroco(){
		return $this->Troco;
	}

	public function setTroco($Troco){
		$this->Troco = $Troco;
	}

	public function getPago(){
		return $this->Pago;
	}

	public function setPago($Pago){
		$this->Pago = $Pago;
	}

	public function getClienteID(){
		return $this->ClienteID;
	}

	public function setClienteID($ClienteID){
		$this->ClienteID = $ClienteID;
	}

	public function getEnderecoID(){
		return $this->EnderecoID;
	}

	public function setEnderecoID($EnderecoID){
		$this->EnderecoID = $EnderecoID;
	}

	public function getStatusPedidoID(){
		return $this->StatusPedidoID;
	}

	public function setStatusPedidoID($StatusPedidoID){
		$this->StatusPedidoID = $StatusPedidoID;
	}
}
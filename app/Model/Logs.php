<?php

namespace Marketaco;

class Logs
{
    private $LogsID;
	private $Data;
	private $Operador;
    private $Acao;

    /*Construtor*/
    function __constructor($Data, $Operador, $Acao)
    {
        $this->Data = $Data;
        $this->Operador = $Operador;
        $this->Acao = $Acao;
    }

    /*GETs and SETs*/
    public function getLogsID(){
		return $this->LogsID;
	}

	public function setLogsID($LogsID){
		$this->LogsID = $LogsID;
	}

	public function getData(){
		return $this->Data;
	}

	public function setData($Data){
		$this->Data = $Data;
	}

	public function getOperador(){
		return $this->Operador;
	}

	public function setOperador($Operador){
		$this->Operador = $Operador;
	}

	public function getAcao(){
		return $this->Acao;
	}

	public function setAcao($Acao){
		$this->Acao = $Acao;
	}
}
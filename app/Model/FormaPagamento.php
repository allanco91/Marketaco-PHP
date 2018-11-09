<?php

namespace Marketaco;

class FormaPagamento
{
    private $FormaPagamentoID;
    private $Nome;

    /*Construtor*/
    function __construct($FormaPagamentoID, $Nome)
    {
        $this->FormaPagamentoID = $FormaPagamentoID;
        $this->Nome = $Nome;
    }

    /*GETs and SETs*/
    public function getFormaPagamentoID(){
		return $this->FormaPagamentoID;
	}

	public function setFormaPagamentoID($FormaPagamentoID){
		$this->FormaPagamentoID = $FormaPagamentoID;
	}

	public function getNome(){
		return $this->Nome;
	}

	public function setNome($Nome){
		$this->Nome = $Nome;
	}
}
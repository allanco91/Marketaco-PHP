<?php

namespace Marketaco;

class Operador
{
    private $OperadorID;
	private $Nome;
	private $Login;
	private $Senha;
    private $Adm;
    
    /*Construtor*/
    function __construct($OperadorID, $Nome, $Login, $Senha, $Adm)
    {
        $this->OperadorID = $OperadorID;
        $this->Nome = $Nome;
        $this->Login = $Login;
        $this->Senha = $Senha;
        $this->Adm = $Adm;
    }

    /*GETs and SETs*/
    public function getOperadorID(){
		return $this->OperadorID;
	}

	public function setOperadorID($OperadorID){
		$this->OperadorID = $OperadorID;
	}

	public function getNome(){
		return $this->Nome;
	}

	public function setNome($Nome){
		$this->Nome = $Nome;
	}

	public function getLogin(){
		return $this->Login;
	}

	public function setLogin($Login){
		$this->Login = $Login;
	}

	public function getSenha(){
		return $this->Senha;
	}

	public function setSenha($Senha){
		$this->Senha = $Senha;
	}

	public function getAdm(){
		return $this->Adm;
	}

	public function setAdm($Adm){
		$this->Adm = $Adm;
	}
}
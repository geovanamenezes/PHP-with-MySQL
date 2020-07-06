<?php

class Conexao	
{
	private $conexaoBD;
	
	public function __construct(){
	
	}
	
	public function getInstance(){
		$this->conexaoBD = new PDO("mysql:host=localhost:3306;dbname=escola;charset=utf8", "root","");
		return $this->conexaoBD;
	}

	
}
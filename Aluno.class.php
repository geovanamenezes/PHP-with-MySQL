<?php 
	//Solicitando a conexão com o BANCO :)
	require_once "Conexao.class.php";

	//Criando a classe Aluno
	class Aluno{
		//Definindo variáveis
		private $prontuario;
		private $nome;
		private $curso;



		//Contrutor da classe
		function __construct($prontuario="", $nome="", $curso=""){
			$this->prontuario = $prontuario;
			$this->nome = $nome;
			$this->curso = $curso;	
		}

		
		//getters e setters
		public function getProntuario(){
			  return $this->prontuario;
		}

  		public function setProntuario($prontuario){
	  		$this->prontuario = $prontuario;
  		}

	  	public function getNome(){
			return $this->nome;
	  	}

	  	public function setNome($nome){
			$this->nome = $nome;
		}

	  	public function getCurso(){
		  	return $this->curso;
	 	}

	  	public function setCurso($curso){
		  	$this->curso = $curso;
	  	}


	  	//Função inserir aluno
		public function inserirAluno(){
			//criando uma conexão
			$resposta="";
			$conexao = new Conexao();
			$cn = $conexao->getInstance();

			//inserindo query a ser executada, os textos ":prontuário", ":nome" e ":curso" serão substituídos pelo valor das variáveis 
			$stmt = $cn->prepare('INSERT INTO alunos VALUES (:prontuario,:nome,:curso)');
   
			//substituindo os valores
		    $stmt->bindParam(':prontuario', $this->prontuario);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':curso', $this->curso);
    
			//executando a query no banco
		    $result = $stmt->execute();

		    //Verificando se o aluno foi inserido no banco ou não
			if($result==false){
				$resposta = "<h1>ERRO!</h1>Não foi possível inserir o aluno no banco. Por favor, tente novamente!";	
			}else{
				$resposta = "<h1>Aluno inserido com sucesso!<h1>";
			}

			return $resposta;
		}



		// Função Consultar todos os alunos
		public function consultarTodosAlunos(){
			//criando um conexão com o banco
			$conexao = new Conexao();
			$cn = $conexao->getInstance();

			// preparando query que será executada no bando para consultar todos os alunos cadastrados
			$stmt = $cn->prepare('SELECT * FROM alunos');
			//executando query
			$stmt->execute();

			//o resultado da consulta vem como um "array", então é necessário usar o código a seguir para salvar o resultado em uma variável.
			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//Então, retornamos o resultado:
			return $resultado;
		}



		// Função Consultar Aluno por Nome
		public function consultarPorNome($nome){
			//criando um conexão com o banco
			$conexao = new Conexao();
			$cn = $conexao->getInstance();

			// preparando query que será executada no bando para consultar alunos por nome. O texto ":nome" será substituido por outro valor
			$stmt = $cn->prepare('SELECT * FROM alunos WHERE nome LIKE :nome');
			// substituindo o ":nome" (obs: as porcentagens ao lado do $nome serve para ignorar os caracteres que estiverem a mais em ambos os lados na hora das pesquisa)
			$stmt->bindValue(':nome', "%$nome%");

			//executando query
			$stmt->execute();

			//o resultado da consulta vem como um "array", então é necessário usar o código a seguir para salvar o resultado em uma variável.
			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//Então, retornamos o resultado:
			return $resultado;
		}


		// Função Exclui aluno pelo Prontuário
		public function excluirAluno($prontuario){
			//criando uma conexão com o banco
			$conexao = new Conexao();
			$cn = $conexao->getInstance();

			// preparando query para deletar um aluno do banco
			$stmt = $cn->prepare('DELETE FROM alunos WHERE prontuario = :prontuario');
			//substituindo o texto ":prontuario" pelo valor do prontuario do aluno que será deletado
			$stmt->bindValue(':prontuario', $prontuario);
			// executando query
			$stmt->execute();
		}


		// Função Alterar dados do aluno
		public function alterarAluno($nome, $curso, $prontuario){
			//criando uma conexão com o banco
			$conexao = new Conexao();
			$cn = $conexao->getInstance();

			// preparando a query de atualização. OBS: os textos ":nome" e "curso" serão substituidos pelos novos valores de parametro, enquanto que o texto ":prontuario" não poderá ser alterado, portanto é um valor que precisaremos consultar no banco através da função: consultaProntuario().
			$stmt = $cn->prepare('UPDATE aluno SET nome=:nome, curso=:curso WHERE prontuario=:prontuario');
			// substituindo parametros e o valor
			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':curso', $curso);
			$stmt->bindValue(':prontuario', $prontuario);
			//executando a query
			$stmt->execute();

			//o resultado da consulta vem como um "array", então é necessário usar o código a seguir para salvar o resultado em uma variável.
			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// retornando todos os alunos salvos no banco para mostrar as alterações realizadas
			return $resultado;
		}


		// Função para consultar o prontuário no banco, a fim de atender os requisitos da função: alterarAluno()
		public function consultaProntuario(){
			//criando uma conexão com o banco
			$conexao = new Conexao();
			$cn = $conexao->getInstance();

			// preparando query de consulta
			$stmt = $cn->prepare('SELECT prontuario FROM alunos WHERE nome=:nome AND curso=:curso');


		}


	}




?>
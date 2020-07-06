<?php 
		// solicitando a classe Aluno
		require_once "Aluno.class.php";

		include_once "menu.php";

				// verificando se os posts foram instanciados
		if (isset($_POST["prontuario"]) && isset($_POST["nome"]) && isset($_POST["curso"])) {
			// atribuindo valores do post para variáveis
			$prontuario = $_POST["prontuario"];
			$nome = $_POST["nome"];
			$curso = $_POST["curso"];

			// criando um objeto aluno
			$aluno = new Aluno($prontuario, $nome, $curso);
			// inserindo aluno no banco
			$resposta = $aluno->inserirAluno();
		}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Recebendo Cadastro</title>
</head>
	<body>

		<div class="container mt-4" >		
			<div class="row">
				<div class="col-md-6 offset-md-3 text-center">
					<?php echo $resposta ?>
						
				</div>		
			</div>	
		</div>

	</body>
</html>
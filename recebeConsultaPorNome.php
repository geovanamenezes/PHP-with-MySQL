<?php
	// importando a classe Aluno 
	require_once "Aluno.class.php";
	// inserindo o menu na tela
	include_once "menu.php";
	//criando um objeto Aluno para poder utilizar as funções da classe
	$aluno = new Aluno();
	
	//caso o nome esteja sido instanciado, será exibido na tabela apenas os dados da pessoas solicitada
	if (isset($_POST['nome'])) {
		$nome = $_POST['nome'];
		//chamando a função para pesquisar por nome e guardando o resultado em uma variável
		$informacao = $aluno->consultarPorNome($nome);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Consulta Alunos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-4" >		
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h1 class="text-center">Consultar Cadastros</h1>
				<br>	
					<form style="width: 500px;" method="POST" action="recebeConsultaPorNome.php" class="form-inline my-2 my-lg-0">
						<input type="text" class="form-control" name="nome" style="width: 390px; margin-right: 15px;">
						<button type="submit" class="btn btn-success my-2 my-sm-0" style="align-items: center">Pesquisar</button>
					</form>
			</div>		
		</div>	
		<div class="row">
				Resultado da pesquisa por <?php echo $_POST['nome']; ?>
				<table class="table mt-5">
					<thead>
						<tr>
						    <th scope="col">Prontuario</th>
						    <th scope="col">Nome</th>
						    <th scope="col">Curso</th>
						    <th></th>
						    <th></th>
						</tr>
					</thead>
					<tbody>

						<?php 
							//Será criado um for para que em cada objeto do array seja criado uma linha na tabela exibindo as informações 
						  	foreach ($informacao as $info) {
						?>
						<!--CRIANDO AS LINHAS DA TABELA E EXIBINDO AS INFORMAÇÕES DE CADA OBJETO-->
						<tr>
							<th scope="row"><?php echo $info['prontuario']?></th>
							<td><?php echo $info['nome']?></td>
							<td><?php echo $info['curso']?></td>
							<th scope="col"><button type="button" class="btn btn-danger btn-sm">Excluir</button></th>
						    <th scope="col"><button type="button" class="btn btn-warning btn-sm">Alterar</button></th>
						</tr>
						<?php
						  	}
						?>
 
					</tbody>
				</table>
		</div>
	</div>
</body>
</html>
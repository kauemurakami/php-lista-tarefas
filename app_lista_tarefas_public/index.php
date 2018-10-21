<?php
	
	$acao = 'recuperarTarefasPendentes';
	require_once "../../app_lista_tarefas/tarefa_controller.php";

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
				<script type="text/javascript">
			function editar(id , txt_tarefa){
				//FORM DE EDIÇÃO
				let form = document.createElement('form');
				form.action = 'index.php?pag=index&acao=atualizar'
				form.method = 'post'
				form.className = 'row'

				//INPUT DE ENTRADA DO TEXTO
				let inputTarefa = document.createElement('input');
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = 'col-8 form-control'
				inputTarefa.value = txt_tarefa

				//cria um input hidden para a entrada do texto
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value =  id

				//BUTTON PARA ENVIO
				let button = document.createElement('button');
				button.type = 'submit'
				button.className = 'col-3 btn btn-info'
				button.innerHTML = 'Atualizar'

				//incluindo input no form
				form.appendChild(inputId)				
				//incluindo input tarefa no form
				form.appendChild(inputTarefa)
				//incluindo button no form
				form.appendChild(button)

				//teste
				//console.log(form)
				//alert(id)

				//selecionando div tarefa
				let tarefa = document.getElementById('tarefa_'+id)

				//limpar o texto de tarefas para inclusao de uma tarefa nova
				tarefa.innerHTML = ''

				//incluindo form na pagina
				tarefa.insertBefore(form, tarefa[0])

				//alert(txt_tarefa)
			}

			//funcao remover
			function remover(id){

				location.href = 'index.php?acao=remover&id='+id;

			}

			//funcao marcar como realizada
			function marcarRealizada(id){

				location.href = 'index.php?pag=index&acao=marcarRealizada&id='+id;

			}


		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

									<?php foreach($tarefas as $indice => $tarefa) {
									?>
									
								<div class="row mb-3 d-flex align-items-center tarefa">
									<!--recupera a tarefa e o id_status do ojeto Tarefa-->
									<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">  
										<?= $tarefa->tarefa ?> (<?= $tarefa->status ?>) 

									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>								
										<!-- @param1 id tarefa @param2 teto contido antes da edicao -->
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>,
										'<?= $tarefa->tarefa ?>')"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i>
									</div>
								</div>

								<!-- construindo informações recuperadas -->
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
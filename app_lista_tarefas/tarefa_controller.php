<?php

	require "../../app_lista_tarefas/tarefa.model.php";
	require "../../app_lista_tarefas/tarefa.service.php";
	require "../../app_lista_tarefas/conexao.php";

	#recupera o valor pasado via GET ou pelo escopo  caso ele seja passado 
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
	
	##echo $acao;


	if( $acao == 'inserir' ){

		#instanciando tarefa
		$tarefa = new Tarefa();

		#setando tarefa ao objeto Tarefa recebido via post pelo formulario tarefa 
		$tarefa->__set('tarefa', $_POST['tarefa']);

		# instânciando objeto conexao
		$conexao = new Conexao();

		#instanciando tarefa
		# @param1 objeto Conexao @param2 objeto Tarefa
		$tarefaService = new TarefaService($conexao, $tarefa);

		# executando metodo inserir do objeto tarefaService
		$tarefaService->inserir();

		header('Location: nova_tarefa.php?inclusao=1');
	} else if( $acao == 'recuperar'){
		# instanciando objetos para construtor.
		$tarefa = new Tarefa();
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao,$tarefa);
		# utilizando metodo recuperar do objeto tarefa service
		$tarefas = $tarefaService->recuperar();
		# variavel recebe retorno do metodo recuperar de tarefaService
	} else if( $acao == 'atualizar'){

		# instanciando objetos para construtor.
		$tarefa = new Tarefa();
		# setando valores ao objeto tarefa
		# @param1 $atributo do objeto tarefa @param2 variavel recebida via post[nomedoVAR]
		$tarefa->__set('id', $_POST['id']);
		$tarefa->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao,$tarefa);
		# utilizando metodo atualizar do objeto tarefa service

		if ($tarefaService->atualizar()){
			if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
				header('location: index.php');
			}else 
				header('location: todas_tarefas.php');

		} else if( $acao == 'remover'){
			# instanciando nova tarefa
			$tarefa = new Tarefa();
			# seta no objeto tarefa a variavel id recebida via get junto com a acao no id do objeto
			$tarefa->__set('id', $_GET['id']);

			$conexao = new Conexao();

			$tarefaService = new TarefaService($conexao,$tarefa);
			$tarefaService->remover();

			if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
				header('location: index.php');
			}else 
				header('location: todas_tarefas.php');
		
		} else if( $acao == 'marcarRealizada'){

			# instanciando nova tarefa
			
			$tarefa = new Tarefa();
			# seta no objeto tarefa a variavel id recebida via get junto com a acao no id do objeto
			$tarefa->__set('id', $_GET['id']);
			# @param1 $atributo @param2 2 valor de tarefa realizada
			$tarefa->__set('id_status', 2);

			$conexao = new Conexao();

			$tarefaService = new TarefaService($conexao,$tarefa);
			$tarefaService->marcarRealizada();
			if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
				header('location: index.php');
			}else 
				header('location: todas_tarefas.php');

		} else if( $acao == 'recuperarTarefasPendentes'){

		# instanciando objetos para construtor.
		$tarefa = new Tarefa();
		$tarefa->__set('id_status',1);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao,$tarefa);
		# utilizando metodo recuperar do objeto tarefa service
		$tarefas = $tarefaService->recuperarTarefasPendentes();
		# variavel recebe retorno do metodo recuperar tarefas pendentes de tarefaService
		if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
			header('location: index.php');
		}else 
			header('location: todas_tarefas.php');

		}

	}




?>
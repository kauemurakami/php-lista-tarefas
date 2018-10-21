<?php


//CRUD
class TarefaService {

	private $conexao;
	private $tarefa;

	public function __construct(Conexao $conexao, Tarefa $tarefa) {
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	public function inserir() { //create
		#query
		$query = 'insert into tb_tarefas(tarefa)values(:tarefa)';

		#preparando query com metodo prepare(@param query) do PDO
		$stmt = $this->conexao->prepare($query);

		#recebe o parametro tarefa passando o valor da tarefa atual do objeto Tarefa atual
		$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
		
		# executa a query ja preparada
		$stmt->execute();
	}

	public function recuperar() { //read
		# query com os indices a serem recuperados
		$query = 'select 
					t.id, s.status, t.tarefa 
				from 
					tb_tarefas as t
					left join tb_status as s on (t.id_status = s.id)
		';
		#compara a informação do id_status com o id do tb_tarefa onde define os status 1 ou 2

		# utilizando prepare contra sqlInj (nao é necessario)
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		# retorno de um array de objetos 'FETCH_OBJ'
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() { //update
		# query @param1 @param2 id para localizar o id da tarefa em relação ao id do objeto recebido
		$query = "update tb_tarefas set tarefa = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		# ?1 tarefa ?2 id
		$stmt->bindValue(1, $this->tarefa->__get('tarefa'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));
		return $stmt->execute();
	}

	public function remover() { //delete
		# criando query delete
		$query = 'delete from tb_tarefas where id = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id'));
		$stmt->execute();

	}

	public function marcarRealizada() { //marca realizada
		# query @param1 @param2 id para localizar o id da tarefa em relação ao id do objeto recebido
		$query = "update tb_tarefas set id_status = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		# ?1 tarefa ?2 id
		$stmt->bindValue(1, $this->tarefa->__get('id_status'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));
		return $stmt->execute();
	}

	public function recuperarTarefasPendentes() { //read tarefas pendentes
		# query com os indices a serem recuperados
		$query = 'select 
					t.id, s.status, t.tarefa 
				from 
					tb_tarefas as t
					left join tb_status as s on (t.id_status = s.id)
				where 
					t.id_status = id:id_status
		';
		#compara a informação do id_status com o id do tb_tarefa onde define os status 1 ou 2

		# utilizando prepare contra sqlInj (nao é necessario)
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->execute();
		# retorno de um array de objetos 'FETCH_OBJ'
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

}

?>
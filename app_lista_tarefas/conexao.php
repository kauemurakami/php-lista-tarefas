<?php

class Conexao {

	private $host = 'localhost';
	private $dbname = 'php_com_pdo';
	private $user = 'root';
	private $pass = '';

	# função conectar
	public function conectar() {
		try {

			#cria nova instancia PDO
			#@param1 driver @param2 host @param3 nome do banco @param4 usuario @param5 senha
			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"				
			);
			#retona objeto PDO conexao
			return $conexao;


		} catch (PDOException $e) {
			echo '<p>'.$e->getMessege().'</p>';
		}
	}
}

?>
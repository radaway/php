<?php

require_once(dirname(__FILE__) . '/../conf/config.php');
//require_once(PROJETO . '/conf/conexao.php');
Class novasql{
	public $tabela = null;
	public $schema = null;
	public $sqlerro = false;
	public $sqlretorno;
	public $campos;
	public $condicoes = false;
	private $conex;
	private $cmps;
	private $vlrs;
	private $updt;
	private $cnds;
	private $slct;
	private $ordm;
	private $like;
	public $result;
	private $like_ant;
	private $like_pos;
	private $ligacao = false;
	private $ligcmp;
	private $ligtab;
	private $ligsch;
	private $inner;

	//construtor default
	function __construct($schema, $tabela, $conexao = null){
		if ($conexao == null){
			$this->conex = connlocal();
		}else {
			$this->conex = $conexao;
		}
		$this->tabela = $tabela;
		$this->schema = $schema;
		$this->sqlretorno = "";
	}

	//gera log
	function geralog($sql){
		$log = str_replace("'", '"', $sql);
		if(!isset($_SESSION['user'])){
			$user = "null";
		} else {
			$user = "'{$_SESSION['user']}'";
		}
		//pg_query(connlocal(), "INSERT INTO public.sql_logs (sql, login, end_ip) VALUES ('{$log}', {$user}, '{$_SERVER['REMOTE_ADDR']}')");
	}

	//sql simples
	function sql($sql, $log = true){
		if ($log){
			$this->geralog($sql);
		}
		$this->result = pg_query($this->conex, $sql);
		return $this->result;
	}

	//gera lista escrita
	function gerList($campos, $condicoes, $ordem){
		//extrai dados para inserir
		$this->cmps = "";
		$this->vlrs = "";
		$this->updt = "";
		$this->slct = "";

		foreach($campos as $key => $val){
			if($val == ''){
				$val2 = "null";
			} else {
				$val2 = "'{$val}'";
			}
			$campos_key = array_keys($campos);
			if(end($campos_key) == $key){
				$this->cmps = $this->cmps . $key . " ";
				$this->vlrs = $this->vlrs . $val2 . " ";
				$this->updt = $this->updt . $key . " = " . $val2 ." ";
				$this->slct = $this->slct . $this->tabela . "." . $val." ";
			}else{
				$this->cmps = $this->cmps . $key . ",";
				$this->vlrs = $this->vlrs . $val2 . ",";
				$this->updt = $this->updt . $key . " = " . $val2 . ",";
				$this->slct = $this->slct . $this->tabela . "." . $val . ",";
			}
		}


		$this->cnds = "";
		if(is_array($condicoes)){
			foreach ($condicoes as $key => $val){
				$condicoes_key = array_keys($condicoes);
				if(end($condicoes_key) == $key){
					$this->cnds = $this->cnds . $key . " = '{$val}' ";
				}else{
					$this->cnds = $this->cnds . $key . " = '{$val}' AND ";
				}
			}
		}


		$this->ordm = "";
		if(is_array($ordem)){
			foreach ($ordem as $key => $val){
				$ordem_key = array_keys($ordem);
				if(end($ordem_key) == $key){
					$this->ordm = $this->ordm . $key . " " . $val . " ";
				}else{
					$this->ordm = $this->ordm . $key . " " . $val . ",";
				}
			}
		}
	}



	//função adicionar
	function insert($campos, $log = true){
		if (!is_array($campos) or !$campos){
			$this->sqlerro = true;
			$this->sqlretorno = "Não foi informado nenhum campo!";
			//break;
		}
		//extrai dados para inserir
		$this->gerList($campos, false, false);
		//gera sql
		$sql = "INSERT INTO {$this->schema}.{$this->tabela} ({$this->cmps}) VALUES ({$this->vlrs})";
		if ($log){
			$this->geralog($sql);
		}
		if(!pg_query($this->conex, $sql)){
			$this->sqlerro = true;
			$this->sqlretorno = $sql;
			$this->erro_msg = pg_last_error($this->conex);
		} else {
			$this->sqlerro = false;
			$this->sqlretorno = $sql;
		}

	}

	//função update
	function update($campos, $condicoes){
		if (!is_array($campos) or !$campos){
			$this->sqlerro = true;
			$this->sqlretorno = "Não foi informado nenhum campo!";
		}
		if (!is_array($condicoes) or !$condicoes){
			$this->sqlerro = true;
			$this->sqlretorno = "Não foi informado nenhum campo!";
		}
		//extrai dados para inserir
		$this->gerList($campos, $condicoes, false);
		$sql = "UPDATE {$this->schema}.{$this->tabela} SET {$this->updt} WHERE {$this->cnds}";
		$this->geralog($sql);
		if(!pg_query($this->conex, $sql)){
			$this->sqlerro = true;
			$this->sqlretorno = "Falha ao adicionar entrada no banco!";
		} else {
			$this->sqlerro = false;
			$this->sqlretorno = $sql;
		}
	}

	//funcao select
	function select($campos, $condicoes, $apartir=0, $quantidade=0, $ordem=null){
		$this->gerList($campos, $condicoes, $ordem);
		if (!is_array($campos) or !$campos){
			$sql = "SELECT {$this->tabela}.* ";
		} else {
			$sql = "SELECT {$this->slct} ";
		}
		if ($this->ligacao){
			$sql = $sql . $this->ligcmp;
		}

		$sql = $sql . "FROM {$this->schema}.{$this->tabela} ";

		if ($this->ligacao){
			$sql = $sql . $this->inner;
		}

		if (is_array($condicoes)){
			$sql = $sql . "WHERE {$this->cnds} ";
		}else{
			if (isset($condicoes)){
				$sql = $sql . "WHERE $condicoes ";
			}
		}
		if (is_array($ordem)){
			$sql = $sql . "ORDER BY {$this->ordm} ";
		}
		if($quantidade > 0){
		    $sql = $sql . "LIMIT {$quantidade} OFFSET {$apartir}";
		}

		//$this->geralog($sql);

		if($this->result = pg_query($this->conex, $sql)){
			$this->sqlerro = false;
			$this->sqlretorno = $sql;
		} else {
			$this->sqlerro = true;
			$this->sqlretorno = $sql;
		}

	}

	//função de leitura de registro
	function readnext(){
		if($this->result !== null){
			$retorno = pg_fetch_array($this->result);
		} else {
			return false;
		}
		if ($this->sqlretorno = $retorno){
			 return true;
		}else{
			$this->sqlretorno = "";
			return false;
		}
	}


	//funcao delete
	function delete($condicoes = false){
		if (!is_array($condicoes) or !$condicoes){
			$this->sqlerro = true;
			$this->sqlretorno = "Não foi informado nenhum campo!";
		}
		//extrai dados para inserir
		$this->gerList(false, $condicoes);
		$sql = "DELETE FROM {$this->schema}.{$this->tabela} WHERE {$this->cnds}";
		$this->geralog($sql);
		if(!pg_exec($this->conex, $sql)){
			$this->sqlerro = true;
			$this->sqlretorno = "Falha ao adicionar entrada no banco!";
		} else {
			$this->sqlerro = false;
			$this->sqlretorno = $sql;
		}
	}


	//funcao ligacao
	function ligacao($tabela, $campos, $ligacao){
		$this->ligacao = true;
		$this->ligsch = $tabela['schema'];
		$this->ligtab = $tabela['tabela'];
		$this->ligcmp = "";
		foreach ($campos as $val){
			$this->ligcmp = $this->ligcmp . "," . $this->ligtab . "." . $val . " AS " . $ligacao['origem'] . " ";
		}
		$this->inner = "INNER JOIN {$this->ligsch}.{$this->ligtab} ON ({$this->tabela}.{$ligacao['origem']} = {$this->ligtab}.{$ligacao['destino']}) ";
	}

	//funcao remove ligacao
	function dropLigacao(){
		$this->ligacao = false;
	}

	//conta registros
	function countReg($campo){
		$sql = "SELECT count({$campo}) FROM {$this->schema}.{$this->tabela}";
		if($this->result = pg_query($this->conex, $sql)){
			$this->sqlretorno = pg_fetch_assoc($this->result);
		}
	}
	
	function countRegWhere($campo,$where = ''){
		if(!empty($where)){
			$sql = "SELECT count({$campo}) FROM {$this->schema}.{$this->tabela} WHERE {$where}";
		}else{
			$sql = "SELECT count({$campo}) FROM {$this->schema}.{$this->tabela}";
		}
		if($this->result = pg_query($this->conex, $sql)){
			$this->sqlretorno = pg_fetch_assoc($this->result);
		}
	}

	function changeTable($schema,$tabela){
		$this->tabela = $tabela;
		$this->schema = $schema;
	}

	//destruct
	function __destruct() {
		pg_close($this->conex);
	}

}


?>

<?php
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
			return null;
		}else {
			$this->conex = $conexao;
		}
		//mysql_select_db($schema);
		$this->tabela = $tabela;
		$this->schema = $schema;
		$this->sqlretorno = "";
	}

	function sql($sql){
		$this->geralog($sql);
		$this->result = $this->conex->query($sql);
		return $this->result;
	}

	function insert_id(){
		return mysql_insert_id($this->conex);
	}

	//gera log
	function geralog($sql){
		$log = str_replace("'", '"', $sql);
		$log = str_replace("`", '"', $log);
		$user = 0;
		//mysql_query("INSERT INTO `sis`.`log` (`data`, `usuario`, `sql`) VALUES (CURRENT_TIMESTAMP, '{$user}', '{$log}')", $this->conex );
	}
	//gera lista escrita
	function gerList($campos, $condicoes, $ordem){
		//extrai dados para inserir
		$this->cmps = "";
		$this->vlrs = "";
		$this->updt = "";
		$this->slct = "";

		if (is_array($campos)){
		foreach($campos as $key => $val){
			if($val == ''){
				$val2 = "null";
			} else {
				$val2 = "'{$val}'";
			}
			$campos_key = array_keys($campos);
			if(end($campos_key) == $key){
				$this->cmps = $this->cmps . "`" . $key . "` ";
				$this->vlrs = $this->vlrs . $val2 . " ";
				$this->updt = $this->updt . "`" . $key . "` = {$val2} ";
				$this->slct = $this->slct . "`" . $this->tabela . "`.`" . $val . "` ";
			}else{
				$this->cmps = $this->cmps . "`" . $key . "`,";
				$this->vlrs = $this->vlrs . $val2 . ",";
				$this->updt = $this->updt . "`" . $key . "` = {$val2},";
				$this->slct = $this->slct . "`" . $this->tabela . "`.`" . $val . "`,";
			}
		}}


		$this->cnds = "";
		if(is_array($condicoes)){
		foreach ($condicoes as $key => $val){
			$condicoes_key = array_keys($condicoes);
			if(end($condicoes_key) == $key){
				$this->cnds = $this->cnds . "`" . $key . "` = '{$val}' ";
			}else{
				$this->cnds = $this->cnds . "`" . $key . "` = '{$val}' AND ";
			}
		}}


		$this->ordm = "";
		if (is_array($ordem)){
		foreach ($ordem as $key => $val){
			$ordem_key = array_keys($ordem);
			if(end($ordem_key) == $key){
				$this->ordm = $this->ordm . $key . " " . $val . " ";
			}else{
				$this->ordm = $this->ordm . $key . " " . $val . ",";
			}
		}}
	}



	//função adicionar
	function insert($campos){
		if (!is_array($campos) or !$campos){
			$this->sqlerro = true;
			$this->sqlretorno = "Não foi informado nenhum campo!";
		}
		//extrai dados para inserir
		$this->gerList($campos, false, false);
		//gera sql
		$sql = "INSERT INTO `{$this->schema}`.`{$this->tabela}` ({$this->cmps}) VALUES ({$this->vlrs})";
		$this->geralog($sql);
		if(!$this->conex->query($sql)){
			$this->sqlerro = true;
			$this->sqlretorno = $sql;
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
		if(!$this->conex->query($sql)){
			$this->sqlerro = true;
			$this->sqlretorno = "Falha ao adicionar entrada no banco!";
		} else {
			$this->sqlerro = false;
			$this->sqlretorno = $sql;
		}
	}

	//funcao select
	function select($campos, $condicoes, $apartir, $quantidade, $ordem){
		$this->gerList($campos, $condicoes, $ordem);
		if (!is_array($campos) or !$campos){
			$sql = "SELECT * ";
		} else {
			$sql = "SELECT {$this->slct} ";
		}
		if ($this->ligacao){
			$sql = $sql . $this->ligcmp;
		}

		$sql = $sql . "FROM `{$this->schema}`.`{$this->tabela}` ";

		if ($this->ligacao){
			$sql = $sql . $this->inner;
		}

		if (is_array($condicoes)){
			$sql = $sql . "WHERE {$this->cnds} ";
		}
		if (is_array($ordem)){
			$sql = $sql . "ORDER BY {$this->ordm} ";
		}
		if($quantidade > 0){
		    $sql = $sql . "LIMIT {$apartir} , {$quantidade} ";
		}

		//$this->geralog($sql);

		if($this->result = $this->conex->query($sql)){
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
			$retorno = mysqli_fetch_array($this->result,MYSQLI_ASSOC);
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
	function delete($condicoes = flase){
		if (!is_array($condicoes) or !$condicoes){
			$this->sqlerro = true;
			$this->sqlretorno = "Não foi informado nenhum campo!";
		}
		//extrai dados para inserir
		$this->gerList(false, $condicoes);
		$sql = "DELETE {$this->tabela} WHERE {$this->cnds}";
		$this->geralog($sql);
		if(!$this->conex->query($sql)){
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
			$this->ligcmp = $this->ligcmp . ",`" . $this->ligtab . "`.`" . $val . "` AS " . $ligacao['origem'] . " ";
		}
		$this->inner = "INNER JOIN `{$this->ligsch}`.`{$this->ligtab}` ON (`{$this->tabela}`.`{$ligacao['origem']}` = `{$this->ligtab}`.`{$ligacao['destino']}`) ";
	}

	//funcao remove ligacao

	function dropLigacao(){
		$this->ligacao = false;
	}

	//conta registros
	function countReg($campo){
		$sql = "SELECT count({$campo}) FROM `{$this->schema}`.`{$this->tabela}`";
		if($this->result = $this->conex->query($sql)){
			$this->sqlretorno = $this->conex->fetch_assoc($this->result);
		}
	}

	function mysql_select_db($db){
		$this->conex->query('use ' . $db);
	}

	function changeDatabase($db){
		$this->conex->query('use ' . $db);
	}

	//destruct
	function __destruct() {
		mysqli_close($this->conex);
	}

}


?>

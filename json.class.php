<?php

Class json{

	public $json;
	public $sqlerro = false;
	public $retorno;
	public $campo;
	public $condicao;
	public $result;
	public $column;
	public $size;


	//construtor default
	function __construct($json){
		if ($json == null){
			return false;
		}else {
			$this->json = $json;
			$this->column = 0;

			if(file_exists($json)){
				$current_data = file_get_contents($json);
				$array_data = json_decode($current_data, true);
				$this->size = count($array_data);
			}else{
				$this->size = 0;
			}

			return true;
		}
	}


	//função adicionar
	function insert($campos){
		if (!is_array($campos) or !$campos){
			$this->sqlerro = true;
			$this->sqlretorno = "Não foi informado nenhum campo!";
			return false;
		}

		if(file_exists($this->json)){
			$current_data = file_get_contents($this->json);
			$array_data = json_decode($current_data, true);
			$new_id = count($array_data) + 1;
			$campos['json_id'] = $new_id;
		} else {
			$campos['json_id'] = 1;
		}

		$extra = $campos;
		$array_data[] = $extra;
		$final_data = json_encode($array_data);
		file_put_contents($this->json, $final_data);
		$this->size++;

		return true;
	}

	//função update
	function update($campo, $json_id){

		$current_data = file_get_contents($this->json);
		$array_data = json_decode($current_data, true);

		foreach($array_data as $elemento) {
		    if($elemento['json_id'] == $json_id){
					$new_data[] = $campo;
				} else {
					$new_data[] = $elemento;
				}
		}

		$final_data = json_encode($new_data);
		file_put_contents($this->json, $final_data);
		return true;

	}

	//funcao select
	function select($campo){

		if(!file_exists($this->json)){
			return false;
		}

		$current_data = file_get_contents($this->json);
		$array_data = json_decode($current_data, true);

		foreach($campo as $key => $valor){
			$chave = $key;
			$valor = $valor;
		}

		foreach($array_data as $elemento) {
		    if(isset($elemento[$chave]) AND $elemento[$chave] == $valor){
					$this->retorno = $elemento;
					return true;
				}
		}

		return false;
	}

	//função de leitura de registro
	function readnext(){

		if(file_exists($this->json)){

			$current_data = file_get_contents($this->json);
			$array_data = json_decode($current_data, true);

			$size = count($array_data);

			if($this->column < $size AND is_array($array_data[$this->column])){
					$this->retorno = $array_data[$this->column];
					$this->column++;
					return true;
			} else {
				$this->retorno = false;
				return false;
			}
		}

	}

	//função de ler os
	function readthe($ini = 0,$end = 0){
		if($end < $ini){
			$this->retorno = array('error'=>'Operação impossivel');
			return false;
		}

		if(file_exists($this->json)){

			$current_data = file_get_contents($this->json);
			$array_data = json_decode($current_data, true);

			if($end > 0){
				while ($ini <= $end) {
					if(isset($array_data[$ini]) AND is_array($array_data[$ini])){
						$this->retorno[$ini] = $array_data[$ini];
						$ini++;
						$ok = 'ok';
					} else {
						$ini++;
						$this->retorno[$ini] = array();
						$ok = 'not';
					}
				}

				if($ok == 'ok'){
					return true;
				}else{
					return false;
				}

			}else{
				if(is_array($array_data[$ini])){
					$this->retorno = $array_data[$ini];
					return true;
				} else {
					$this->retorno = array();
					return false;
				}
			}


		}

	}


	//funcao delete
	function delete($json_id){

		$current_data = file_get_contents($this->json);
		$array_data = json_decode($current_data, true);

		$cnt = 0;
		foreach($array_data as $elemento) {

				if($elemento['json_id'] != $json_id){
					$cnt++;
				}

				if($elemento['json_id'] != $json_id){
					$elemento['json_id'] = $cnt;
					$new_data[] = $elemento;
				}
		}
		$this->size--;

		if($this->size == 0){
			unlink($this->json);
		}else{
			$final_data = json_encode($new_data);
			file_put_contents($this->json, $final_data);
		}

		return true;

	}

	//destruct
	function __destruct() {

	}

}


?>

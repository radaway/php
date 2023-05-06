<?php
Class form{

	public $action;
	public $campos;
	public $metodo;
	public $id;
	public $password;
	//onde
	// 1 = text
	// 2 = password
	// 3 = reset
	// 4 = submit
	// 5 = file
	// 6 = radio
	// 7 = checkbox
	// 8 = select
	// 9 = text com maskara
	// 10 = date
	// 11 = time
	// 12 = read only
	// 13 = hidden
	// 14 = button onclick
	// 15 = button action
	// 16 = button get
	// 17 = input complete
	// 18 = textarea
	// 19 = numero
	// 20 = linha de texto


	function __construct($action, $metodo = "POST",$password = 0){
		//contra quem o form vai disparar
		$this->action = $action;
		//qual o metodo da requisição
		$this->metodo = $metodo;
	}

	function formIni($id = "form1"){
		$this->id = $id;
		echo '<center><form action="' . $this->action . '" method="' . $this->metodo . '" id="' . $this->id . '">
		';
	}

	function formFim(){
		echo "</form></center>
";
		if($this->password == 1){
			echo '<style>@font-face {font-family: text-security-disc;src: url(../../font/text-security-disc.ttf);}</style>';
		}
	}

	function formPrint(){
		$this->formIni();
			foreach($this->campos as $print) {
    				$this->exibir($print);
			}
		$this->formFim();
	}

	function fieldsetOpen($nome = false,$width = '800px;',$color = '#000000;',$bg_color = '#FFFFFF'){
		if(!$nome){
			echo '<fieldset style="width: '.$width.' background-color: '.$bg_color.' border: 2px solid '.$color.'">';
		}else{
			echo '<fieldset style="width: '.$width.' background-color: '.$bg_color.' border: 2px solid '.$color.'">
			<legend align="center"><b>'.$nome.'</b></legend>';
		}

	}

	function fieldsetClose(){
		echo "</fieldset>";
	}

	function divId($id = 'resposta'){
		echo '<div id="'.$id.'"></div>';
	}

	function newTab($tabs,$color = '#FFFFFF;'){
		echo '<div class="tab" style="background-color: '. $color.'">';
		foreach ($tabs as $key => $value) {
				echo '<button class="tablinks" onclick="openTab(event, \'' . $key . '\')">' . $value . '</button>';
		}
		echo '</div>';
	}

	function tabItem($item){
		echo '<div id="'.$item.'" class="docs tabcontent">';
	}

	function tabItemClose(){
		echo '</div>';
	}

	function addSimpleText($text){
		echo '<center><b>' . $text . '</b></center>';
	}

	function addText($nome, $nome_exb, $valor, $tamanho = 50, $tamanho_conteudo = 15, $linha = 1, $label_size = '90'){
		if(empty($valor)){
			$text = array('tipo' => '1', 'nome' => $nome, 'nome_exb' => $nome_exb, 'tamanho' => $tamanho, 'tamanho_conteudo' => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
		}else{
			$text = array('tipo' => '1', 'nome' => $nome, 'nome_exb' => $nome_exb, 'valor' => $valor, 'tamanho' => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
}
		$this->campos[] = $text;
	}

	function addPassword($nome, $nome_exb, $valor, $tamanho = 50, $tamanho_conteudo = 15, $linha = 1, $label_size = '90',$save = 1){
		if(empty($valor)){
		$password = array("tipo" => "2", "nome" => $nome, "nome_exb" => $nome_exb, "tamanho" => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size,'save'=>$save);
		}else{
		$password = array("tipo" => "2", "nome" => $nome, "nome_exb" => $nome_exb, "valor" => $valor, "tamanho" => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size,'save'=>$save);
}
		$this->campos[] = $password;
	}

	function addReset($nome_exb, $linha = 1){
		$reset = array("tipo" => "3", "nome_exb" => $nome_exb, "linha" => $linha);
		$this->campos[] = $reset;
	}

	function addSubmit($nome_exb, $linha = 1){
		$submit = array("tipo" => "4", "nome_exb"=> $nome_exb, "linha" => $linha);
		$this->campos[] = $submit;
	}

	function addFile($nome, $nome_exb, $linha = 1, $label_size = '90'){
		$file = array("tipo" => "5", "nome" => $nome,"nome_exb" => $nome_exb,"linha" => $linha,"label_size" => $label_size);
		$this->campos[] = $file;
	}

	function addRadio($nome, $nome_exb, $valor, $local, $linha = 1){
		$radio = array("tipo" => "6", "nome" => $nome, "nome_exb" => $nome_exb, "valor" => $valor, "local" => $local);
		$this->campos[] = $radio;
	}

	function addCheckbox($nome, $nome_exb, $valor, $local, $linha = 1){
		$checkbox = array("tipo" => "7", "nome" => $nome, "nome_exb" => $nome_exb, "valor" => $valor, "local" => $local, "linha" => $linha);
		$this->campos[] = $checkbox;
	}

	function addSelect($nome, $nome_exb, $valor, $selected, $linha = 1, $label_size = '90'){
		$select = array("tipo" => "8", "nome" => $nome, "nome_exb" => $nome_exb, "selected"=>$selected, "valor" => $valor, "linha" => $linha,"label_size" => $label_size);
		$this->campos[] = $select;
	}

	function addTextMask($nome, $nome_exb, $valor, $mask, $tamanho = 50, $tamanho_conteudo = 15,$linha = 1, $label_size = '90'){
		if(empty($valor)){
			$text_mask = array('tipo' => '9', 'nome' => $nome, 'nome_exb' => $nome_exb, 'tamanho' => $tamanho, 'tamanho_conteudo' => $tamanho_conteudo, 'mask' => $mask,'linha' => $linha,"label_size" => $label_size);
		}else{
			$text_mask = array('tipo' => '9', 'nome' => $nome, 'nome_exb' => $nome_exb, 'valor' => $valor, 'tamanho' => $tamanho, "tamanho_conteudo" => $tamanho_conteudo, 'mask' => $mask,'linha' => $linha,"label_size" => $label_size);
}
		$this->campos[] = $text_mask;
	}

	function addData($nome, $nome_exb, $valor, $tamanho = 50, $tamanho_conteudo = 15, $linha = 1, $label_size = '90'){
		if(empty($valor)){
			$text = array('tipo' => '10', 'nome' => $nome, 'nome_exb' => $nome_exb, 'tamanho' => $tamanho, 'tamanho_conteudo' => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
		}else{
			$text = array('tipo' => '10', 'nome' => $nome, 'nome_exb' => $nome_exb, 'valor' => $valor, 'tamanho' => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
}
		$this->campos[] = $text;

	}

	function addTime($nome, $nome_exb, $valor, $tamanho = 50, $tamanho_conteudo = 15, $linha = 1){
		if(empty($valor)){
			$text = array('tipo' => '11', 'nome' => $nome, 'nome_exb' => $nome_exb, 'tamanho' => $tamanho, 'tamanho_conteudo' => $tamanho_conteudo,"linha" => $linha);
		}else{
			$text = array('tipo' => '11', 'nome' => $nome, 'nome_exb' => $nome_exb, 'valor' => $valor, 'tamanho' => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha);
}
		$this->campos[] = $text;
	}

	function addRead($nome, $nome_exb, $valor, $tamanho = 50, $tamanho_conteudo = 15, $linha = 1,$label_size = '90'){
		if(empty($valor)){
			$text = array('tipo' => '12', 'nome' => $nome, 'nome_exb' => $nome_exb, 'tamanho' => $tamanho, 'tamanho_conteudo' => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
		}else{
			$text = array('tipo' => '12', 'nome' => $nome, 'nome_exb' => $nome_exb, 'valor' => $valor, 'tamanho' => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
}
		$this->campos[] = $text;
	}

	function addHidden($nome, $valor, $linha = 1){
		if(empty($valor)){
			$text = array('tipo' => '13', 'nome' => $nome, "linha" => $linha);
		}else{
			$text = array('tipo' => '13', 'nome' => $nome, 'valor' => $valor, "linha" => $linha);
}
		$this->campos[] = $text;
	}

	function addButtonOnclick($nome_exb, $onclick, $linha = 1){
		$text = array('tipo' => '14', 'onclick' => $onclick, "linha" => $linha,'nome_exb'=>$nome_exb);
				$this->campos[] = $text;
	}

	function addButtonAction($nome, $nome_exb, $action, $cnf_msg, $linha = 1){
		if(empty($cnf_msg)){
			$text = array('tipo' => '15', 'nome' => $nome, 'action' => $action, "linha" => $linha,'nome_exb'=>$nome_exb);
		}else{
			$text = array('tipo' => '15', 'nome' => $nome, 'action' => $action, "linha" => $linha,'nome_exb'=>$nome_exb,'cnf_msg'=>$cnf_msg);
}
		$this->campos[] = $text;
	}

	function addButtonGet($nome_exb, $get, $linha = 1){
		$text = array('tipo' => '16', 'get' => $get, "linha" => $linha,'nome_exb'=>$nome_exb);
				$this->campos[] = $text;
	}

	function addTextComplete($nome, $nome_exb, $valor, $tamanho = 50, $tamanho_conteudo = 15, $linha = 1, $label_size = '90'){
		if(empty($valor)){
			$text = array('tipo' => '17', 'nome' => $nome, 'nome_exb' => $nome_exb, 'tamanho' => $tamanho, 'tamanho_conteudo' => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
		}else{
			$text = array('tipo' => '17', 'nome' => $nome, 'nome_exb' => $nome_exb, 'valor' => $valor, 'tamanho' => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha,"label_size" => $label_size);
}
		$this->campos[] = $text;
	}

	function addTextArea($nome, $nome_exb, $valor, $col = 50, $row = 5, $linha = 1,$label_size = '90'){
		$text = array('tipo' => '18', "linha" => $linha,'nome' => $nome,'valor' => $valor,'nome_exb'=>$nome_exb,'col' => $col,'row' => $row,"label_size" => $label_size);
		$this->campos[] = $text;
	}

	function addNumber($nome, $nome_exb, $valor, $tamanho = 50, $tamanho_conteudo = 15, $linha = 1, $move = 0){
		if(empty($valor)){
			$text = array('tipo' => '19', 'nome' => $nome, 'nome_exb' => $nome_exb, 'tamanho' => $tamanho, 'tamanho_conteudo' => $tamanho_conteudo,"linha" => $linha,'move'=>$move);
		}else{
			$text = array('tipo' => '19', 'nome' => $nome, 'nome_exb' => $nome_exb, 'valor' => $valor, 'tamanho' => $tamanho, "tamanho_conteudo" => $tamanho_conteudo,"linha" => $linha,'move'=>$move);
}
		$this->campos[] = $text;
	}

	function addLineText($texto){
		$text = array('tipo' => '20', 'texto' => $texto);
		$this->campos[] = $text;
	}

	function exibir($array){

		switch($array['tipo']){
			case 1:
				switch($array['linha']){
					case 1:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb']	.
						"</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
					} else {
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] .
						"</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
					}
					break;
					case 2:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}else{
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}
					break;
					case 3:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}
					break;
					case 4:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>
";
					}
					break;
				}
				break;
			case 2:
				switch($array['linha']){
					case 1:
						if(empty($array['valor'])){
							if($array['save']==1){
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required></p>";
							}else{
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required></p>";
								$this->password = 1;
							}
						}else{
							if($array['save']==1){
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required></p>";
							}else{
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required></p>";
								$this->password = 1;
							}
						}
						break;
					case 2:
						if(empty($array['valor'])){
							if($array['save']==1){
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required>";
							}else{
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required>";
								$this->password = 1;
							}
						}else{
							if($array['save']==1){
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required>";
							}else{
								echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required>";
								$this->password = 1;
							}
						}
						break;
					case 3:
						if(empty($array['valor'])){
							if($array['save']==1){
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required>";
							}else{
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required>";
								$this->password = 1;
							}
						}else{
							if($array['save']==1){
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required>";
							}else{
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required>";
								$this->password = 1;
							}
						}
						break;
					case 4:
						if(empty($array['valor'])){
							if($array['save']==1){
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required></p>";
							}else{
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required></p>";
								$this->password = 1;
							}
						}else{
							if($array['save']==1){
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"password\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" required></p>";
							}else{
								echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" style=\"font-family: 'text-security-disc';\" required></p>";
								$this->password = 1;
							}
						}
					break;
				}
				break;
			case 3:
				switch($array['linha']){
					case 1:
						echo "<p><input form=\"form1\" type=\"reset\" value=\"". $array['nome_exb'] ."\"></P>
";
					break;
					case 2:
						echo "<p><input form=\"form1\" type=\"reset\" value=\"". $array['nome_exb'] ."\">
";
					break;
					case 3:
						echo "<input form=\"form1\" type=\"reset\" value=\"". $array['nome_exb'] ."\">
";
					break;
					case 4:
						echo "<input form=\"form1\" type=\"reset\" value=\"". $array['nome_exb'] ."\"></P>
";
					break;

				}
				break;
			case 4:
				switch($array['linha']){
					case 1:
						echo "<p><input form=\"form1\" id=\"submit_".$this->id."\" type=\"submit\" value=\"". $array['nome_exb'] ."\"></p>
";
					break;
					case 2:
						echo "<p><input form=\"form1\" id=\"submit_".$this->id."\" type=\"submit\" value=\"". $array['nome_exb'] ."\">
";
					break;
					case 3:
						echo "<input form=\"form1\" id=\"submit_".$this->id."\" type=\"submit\" value=\"". $array['nome_exb'] ."\">
";
					break;
					case 4:
						echo "<input form=\"form1\" id=\"submit_".$this->id."\" type=\"submit\" value=\"". $array['nome_exb'] ."\"></p>
";
					break;

				}
				break;
			case 5:
				switch($array['linha']){
					case 1:
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"file\" name=\"". $array['nome'] ."\" value=\"". $array['nome'] ."\" id=\"". $array['nome'] ."\"></p>
";
					break;
					case 2:
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"file\" name=\"". $array['nome'] ."\" value=\"". $array['nome'] ."\" id=\"". $array['nome'] ."\">
";
					break;
					case 3:
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"file\" name=\"". $array['nome'] ."\" value=\"". $array['nome'] ."\" id=\"". $array['nome'] ."\">
";
					break;
					case 4:
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"file\" name=\"". $array['nome'] ."\" value=\"". $array['nome'] ."\" id=\"". $array['nome'] ."\"></p>
";
					break;
				}
				break;
			case 6:
				switch($array['linha']){
					case 1:
						if($array['local'] == 1){
							echo "<p>".$array['nome_exb']." | ";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo "
</p>
";
						}else{
							echo "<p>";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo " | ".$array['nome_exb']."
</p>
";
						}
					break;
					case 2:
						if($array['local'] == 1){
							echo "<p>".$array['nome_exb']." | ";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo "

";
						}else{
							echo "<p>";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo " | ".$array['nome_exb']."

";
						}
					break;
					case 3:
						if($array['local'] == 1){
							echo "".$array['nome_exb']." | ";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo "

";
						}else{
							echo "";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo " | ".$array['nome_exb']."

";
						}
					break;
					case 4:
						if($array['local'] == 1){
							echo "".$array['nome_exb']." | ";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo "
</p>
";
						}else{
							echo "";
							foreach($array['valor'] as $chave => $valor){
							echo "
<input form=\"form1\" type=\"radio\" name=\"". $array['nome'] ."\" value=\"". $chave ."\">" . $valor ;
							}
							echo " | ".$array['nome_exb']."
</p>
";
						}
					break;
				}
				break;
			case 7:
				switch($array['linha']){
					case 1:
						if($array['local'] == 1){
							if($array['valor'] == 1){
								echo "<p>" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked></p>
	";
							}else{
								echo "<p>" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\"></p>
	";
							}
						}else{
							if($array['valor'] == 1){
								echo "<p><input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked>" . $array['nome_exb'] . "</p>
	";
							}else{
								echo "<p><input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\">" . $array['nome_exb'] . "</p>
	";
							}
				}
					break;
					case 2:
						if($array['local'] == 1){
							if($array['valor'] == 1){
								echo "<p>" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked>
	";
							}else{
								echo "<p>" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\">
	";
							}
						}else{
							if($array['valor'] == 1){
								echo "<p><input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked>" . $array['nome_exb'] . "
	";
							}else{
								echo "<p><input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\">" . $array['nome_exb'] . "
	";
							}
				}
					break;
					case 3:
						if($array['local'] == 1){
							if($array['valor'] == 1){
								echo "" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked>
	";
							}else{
								echo "" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\">
	";
							}
						}else{
							if($array['valor'] == 1){
								echo "<input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked>" . $array['nome_exb'] . "
	";
							}else{
								echo "<input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\">" . $array['nome_exb'] . "
	";
							}
				}
					break;
					case 4:
						if($array['local'] == 1){
							if($array['valor'] == 1){
								echo "" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked></p>
	";
							}else{
								echo "" . $array['nome_exb'] . "<input form=\"form1\" type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\"></p>
	";
							}
						}else{
							if($array['valor'] == 1){
								echo "<input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\" checked>" . $array['nome_exb'] . "</p>
	";
							}else{
								echo "<input type=\"checkbox\" name=\"" . $array['nome'] . "\" id=\"". $array['nome'] ."\">" . $array['nome_exb'] . "</p>
	";
							}
				}
					break;
				}
				break;
			case 8:
				switch($array['linha']){
					case 1:
						echo "<p><label style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><select form=\"form1\" name=\"". $array['nome']."\" onchange=\"".$array['nome']."()\" id=\"". $array['nome'] ."\">";
							foreach($array['valor'] as $chave => $valor){
								echo '<option value="'. $chave;
								if($chave==$array['selected']){ echo '" selected>'; }else{ echo '">';}
								echo $valor . "</option>";
							}
						echo "
</select></p>
";
					break;
					case 2:
						echo "<p><label style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><select form=\"form1\" name=\"". $array['nome']."\" onchange=\"".$array['nome']."()\" id=\"". $array['nome'] ."\">";
							foreach($array['valor'] as $chave => $valor){
								echo "<option value=\"". $chave;
								if($chave==$array['selected']){ echo '" selected>'; }else{ echo '">';}
								echo $valor . "</option>";
						}
						echo "
</select>
";
					break;
					case 3:
						echo "<label style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><select form=\"form1\" name=\"". $array['nome']."\" onchange=\"".$array['nome']."()\" id=\"". $array['nome'] ."\">";
							foreach($array['valor'] as $chave => $valor){
								echo "<option value=\"". $chave;
								if($chave==$array['selected']){ echo '" selected>'; }else{ echo '">';}
								echo $valor . "</option>";
						}
						echo "
</select>
";
					break;
					case 4:
						echo "<label style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><select form=\"form1\" name=\"". $array['nome']."\" onchange=\"".$array['nome']."()\" id=\"". $array['nome'] ."\">";
							foreach($array['valor'] as $chave => $valor){
								echo "<option value=\"". $chave;
								if($chave==$array['selected']){ echo '" selected>'; }else{ echo '">';}
								echo $valor . "</option>";
							}
						echo "
</select></p>
";
				break;
				}
				break;
			case 9:
				switch ($array['linha']) {
    					case 1:
        					if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\"></p>
";
					}else{
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\"></p>
";
					}
        					break;
    					case 2:
        					if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\">
";
					}else{
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\">
";
					}
        					break;
    					case 3:
        					if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\">
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\">
";
					}
        					break;
					case 4:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\"></p>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" class=\"form-control ".$array['mask']."\"></p>
";
					}
						break;
				}
				break;
				case 10:
				switch($array['linha']){
					case 1:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb']	.
						"</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
					} else {
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] .
						"</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
					}
					break;
					case 2:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}else{
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}
					break;
					case 3:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}
					break;
					case 4:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"date\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>
";
					}
					break;
				}
				break;
				case 11:
				switch($array['linha']){
					case 1:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\">". $array['nome_exb']	.
						"</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
					} else {
						echo "<p><label for=\"". $array['nome'] ."\">". $array['nome_exb'] .
						"</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
					}
					break;
					case 2:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}else{
						echo "<p><label for=\"". $array['nome'] ."\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}
					break;
					case 3:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}else{
						echo "<label for=\"". $array['nome'] ."\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">
";
					}
					break;
					case 4:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"time\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>
";
					}
					break;
				}
				break;
				case 12:
				switch($array['linha']){
					case 1:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb']	.
						"</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly></p>";
					} else {
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] .
						"</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly></p>";
					}
					break;
					case 2:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly>
";
					}else{
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly>
";
					}
					break;
					case 3:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly>
";
					}
					break;
					case 4:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly></p>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" readonly></p>
";
					}
					break;
				}
				break;
				case 13:
				switch($array['linha']){
					case 1:
						if(empty($array['valor'])){
						echo "<p><input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\"></p>";
					} else {
						echo "<p><input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\"></p>";
					}
					break;
					case 2:
						if(empty($array['valor'])){
						echo "<p><input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\">
";
					}else{
						echo "<p><input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\">
";
					}
					break;
					case 3:
						if(empty($array['valor'])){
						echo "<input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\">
";
					}else{
						echo "<input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\">
";
					}
					break;
					case 4:
						if(empty($array['valor'])){
						echo "<input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\"></p>
";
					}else{
						echo "<input form=\"form1\" type=\"hidden\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\"></p>
";
					}
					break;
				}
				break;
				case 14:
				switch($array['linha']){
					case 1:
						echo "<p><input form=\"form1\" type=\"submit\" value=\"". $array['nome_exb'] ."\" onclick=\"".$array['onclick']."\"></p>";
						break;
					case 2:
						echo "<p><input form=\"form1\" type=\"submit\" value=\"". $array['nome_exb'] ."\" onclick=\"".$array['onclick']."\">&nbsp;";
						break;
					case 3:
						echo "<input form=\"form1\" type=\"submit\" value=\"". $array['nome_exb'] ."\" onclick=\"".$array['onclick']."\">&nbsp;";
						break;
					case 4:
						echo "<input form=\"form1\" type=\"submit\" value=\"". $array['nome_exb'] ."\" onclick=\"".$array['onclick']."\"></p>";
						break;
				}
				break;
				case 15:
				switch($array['linha']){
					case 1:
						if(empty($array['cnf_msg'])){
							if(is_array($array['action'])){
								foreach ($array['action'] as $key => $value) {
									echo "<p><button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\">". $array['nome_exb'] ."</button></p>";
								}
							}else{
								echo "<p><button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\">". $array['nome_exb'] ."</button></p>";
							}
					} else {
						if(is_array($array['action'])){
							foreach ($array['action'] as $key => $value) {
								echo "<p><button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button></p>";
							}
						}else{
								echo "<p><button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button></p>";
							}
					}
					break;
					case 2:
						if(empty($array['cnf_msg'])){
							if(is_array($array['action'])){
								foreach ($array['action'] as $key => $value) {
									echo "<p><button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\">". $array['nome_exb'] ."</button>";
								}
							}else{
									echo "<p><button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\">". $array['nome_exb'] ."</button>";
							}
					}else{
						if(is_array($array['action'])){
							foreach ($array['action'] as $key => $value) {
									echo "<p><button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button>";
								}
							}else{
									echo "<p><button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button>";
							}
					}
					break;
					case 3:
						if(empty($array['cnf_msg'])){
							if(is_array($array['action'])){
								foreach ($array['action'] as $key => $value) {
									echo "<button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\">". $array['nome_exb'] ."</button>";
								}
							}else{
								echo "<button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\">". $array['nome_exb'] ."</button>";
							}
					}else{
						if(is_array($array['action'])){
							foreach ($array['action'] as $key => $value) {
								echo "<button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button>";
								}
							}else{
								echo "<button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button>";
							}
					}
					break;
					case 4:
						if(empty($array['cnf_msg'])){
							if(is_array($array['action'])){
								foreach ($array['action'] as $key => $value) {
									echo "<button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\">". $array['nome_exb'] ."</button></p>";
									}
								}else{
									echo "<button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\" value=\"". $array['nome_exb'] ."\">". $array['nome_exb'] ."</button></p>";
								}
					}else{
						if(is_array($array['action'])){
									foreach ($array['action'] as $key => $value) {
										echo "<button form=\"form1\" formaction=\"".$value."\" formtarget=\"$key\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button></p>";
									}
								}else{
									echo "<button form=\"form1\" formaction=\"".$array['action']."\" id=\"". $array['nome'] ."\" onclick=\"return confirm('".$array['cnf_msg']."');\">". $array['nome_exb'] ."</button></p>";
								}
					}
					break;
				}
				break;
				case 16:
				switch($array['linha']){
					case 1:
						echo '<p><button form="form2" onclick="'. $array['get'] .'" style="font-weight:700">'. $array['nome_exb'] . '</button></p>';
						break;
					case 2:
						echo '<p><button form="form2" onclick="'. $array['get'] .'" style="font-weight:700">'. $array['nome_exb'] . '</button>';
						break;
					case 3:
						echo '&nbsp;<button form="form2" onclick="'. $array['get'] .'" style="font-weight:700">'. $array['nome_exb'] . '</button>';
						break;
					case 4:
						echo '&nbsp;<button form="form2" onclick="'. $array['get'] .'" style="font-weight:700">'. $array['nome_exb'] . '</button></p>';
						break;
				}
				break;
				case 17:
				switch($array['linha']){
					case 1:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb']	.
						"</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div></p>";
					} else {
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] .
						"</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div></p>";
					}
					break;
					case 2:
						if(empty($array['valor'])){
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div>
";
					}else{
						echo "<p><label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div>
";
					}
					break;
					case 3:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div>
";
					}
					break;
					case 4:
						if(empty($array['valor'])){
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div></p>
";
					}else{
						echo "<label for=\"". $array['nome'] ."\" style=\"width: ".$array['label_size']."px;\">". $array['nome_exb'] ."</label><input form=\"form1\" type=\"text\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" value=\"". $array['valor'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"><div id=\"complete_". $array['nome'] ."\"></div></p>
";
					}
					break;
				}
				break;
				case 18:
					switch($array['linha']){
						case 1:
							echo "<p><label style=\"width: ".$array['label_size']."px;\">" . $array['nome_exb'] . "</label> <textarea  name=\"".$array['nome']."\" rows=\"".$array['row']."\" cols=\"".$array['col']."\">". $array['valor'] ."</textarea></p>
	";
						break;
						case 2:
							echo "<p><label style=\"width: ".$array['label_size']."px;\">" . $array['nome_exb'] . "</label> <textarea  name=\"".$array['nome']."\" rows=\"".$array['row']."\" cols=\"".$array['col']."\">". $array['valor'] ."</textarea>
	";
						break;
						case 3:
							echo "<label style=\"width: ".$array['label_size']."px;\">" . $array['nome_exb'] . "</label> <textarea  name=\"".$array['nome']."\" rows=\"".$array['row']."\" cols=\"".$array['col']."\">". $array['valor'] ."</textarea>
	";
						break;
						case 4:
							echo "<label style=\"width: ".$array['label_size']."px;\">" . $array['nome_exb'] . "</label> <textarea  name=\"".$array['nome']."\" rows=\"".$array['row']."\" cols=\"".$array['col']."\">". $array['valor'] ."</textarea></p>
	";
						break;

					}
					break;
					case 19:
					switch($array['linha']){
						case 1:
							if(empty($array['valor'])){
								echo "<p><label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
							}else{
								echo "<p><label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" value=\"". $array['valor'] ."\"></p>";
							}
							break;
						case 2:
							if(empty($array['valor'])){
								echo "<p><label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">";
							}else{
								echo "<p><label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" value=\"". $array['valor'] ."\">";
							}
							break;
						case 3:
							if(empty($array['valor'])){
									echo "<label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\">";
							}else{
								echo "<label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" value=\"". $array['valor'] ."\">";
							}
							break;
						case 4:
							if(empty($array['valor'])){
									echo "<label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\"></p>";
							}else{
								echo "<label for=\"". $array['nome'] ."\" style=\"position: relative;right: ". $array['move'] ."px;\" >". $array['nome_exb'] ."</label><input style=\"position: relative;right: ". $array['move'] ."px;\" form=\"form1\" type=\"text\" oninput=\"this.value=this.value.replace(/[^0-9]/g,'');\" id=\"". $array['nome'] ."\" name=\"". $array['nome'] ."\" maxlength=\"". $array['tamanho_conteudo'] ."\" size=\"". $array['tamanho'] ."\" value=\"". $array['valor'] ."\"></p>";
							}
							break;
						}
						break;
						case 20:
							echo '<p><b>'. $array['texto'] . '</b></p>';
						break;

		}
	}

}
?>

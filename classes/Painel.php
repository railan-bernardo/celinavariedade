<?php

	

	class Painel

	{

		

		public static $cargos = [

		'0' => 'Normal',

		'1' => 'Sub Administrador',

		'2' => 'Administrador'];

		

		public static function logado(){

			return isset($_SESSION['login']) ? true : false;

		}



		public static function loggout(){

			setcookie('lembrar','true',time()-1,'/');

			session_destroy();

			header('Location: '.INCLUDE_PATH_PAINEL);

		}



		public static function carregarPagina(){

			if(isset($_GET['url'])){

				$url = explode('/',$_GET['url']);

				if(file_exists('pages/'.$url[0].'.php')){

					include('pages/'.$url[0].'.php');

				}else{

					//Página não existe!

					header('Location: '.INCLUDE_PATH_PAINEL);

				}

			}else{

				include('pages/home.php');

			}

		}



		public static function listarUsuariosOnline(){

			self::limparUsuariosOnline();

			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.online`");

			$sql->execute();

			return $sql->fetchAll();

		}



		public static function limparUsuariosOnline(){

			$date = date('Y-m-d H:i:s');

			$sql = MySql::conectar()->exec("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE");

		}



		public static function alert($tipo,$mensagem){

			if($tipo == 'sucesso'){

				echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';

			}else if($tipo == 'erro'){

				echo '<div class="box-alert erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';

			}

		}



		public static function imagemValida($imagem){

			if($imagem['type'] == 'image/jpeg' ||

				$imagem['type'] == 'image/jpg' ||

				$imagem['type'] == 'imagem/jpg' ||

				$imagem['type'] == 'image/png' ||

				$imagem['type'] == 'imagem/png'){

				$tamanho = intval($imagem['size']/1024);

				if($tamanho < 3000)

					return true;

				else

					return false;

			}else{

				return false;

			}

		}



		public static function imagensValidas($imagens){

			for($i = 0; $i < count($imagens['type']); $i++){

				if($imagens['type'][$i] == 'image/jpeg' ||

					$imagens['type'][$i] == 'image/jpg' ||

					$imagens['type'][$i] == 'imagem/jpg'||

					$imagens['type'][$i] == 'image/png' ||

					$imagens['type'][$i] == 'imagem/png'){

					$tamanho = intval($imagens['size'][$i] / 1024);

					if($tamanho < 3000){



					}

				}else{

					return false;

				}

			}



			return true;

		}



		public static function slugify($text, $tabela)

		{

			$text = preg_replace('~[^\pL\d]+~u', '-', $text);

			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

			$text = preg_replace('~[^-\w]+~', '', $text);

			$text = trim($text, '-');

			$text = preg_replace('~-+~', '-', $text);

			$text = strtolower($text);



			if (empty($text)) {

				return 'n-a';

			}



			$s = MySql::conectar()->prepare("SELECT * FROM $tabela WHERE slug = ?");

			$s->execute(array($text));

			if($s->rowCount() > 0){

				return false;

			}

			return $text;

		}

		public static function slugifyUpdate($text, $tabela, $id)
		{
			$text = preg_replace('~[^\pL\d]+~u', '-', $text);
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
			$text = preg_replace('~[^-\w]+~', '', $text);
			$text = trim($text, '-');
			$text = preg_replace('~-+~', '-', $text);
			$text = strtolower($text);

			if (empty($text)) {
				return 'n-a';
			}

			$s = Mysql::conectar()->prepare("SELECT * FROM $tabela WHERE slug = ? AND id <> ?");
			$s->execute(array($text, $id));
			if($s->rowCount() > 0){
				return false;
			}
			return $text;
		}

		public static function uploadFile($file){

			$formatoArquivo = explode('.',$file['name']);

			$imageNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];

			if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL."/uploads/".$imageNome))

				return $imageNome;

			else

				return false;

		}



		public static function uploadImagemPiscina($files, $tabela, $id){

			for($i = 0; $i < count($files['type']); $i++){

				$formatoArquivo = explode('.', $files['name'][$i]);

				$imageNome = uniqid().".".$formatoArquivo[count($formatoArquivo) - 1];

				if(move_uploaded_file($files['tmp_name'][$i], BASE_DIR_PAINEL."/uploads/".$imageNome)){

					$arr = ['nome' => $imageNome, 'piscina_id' => $id, 'order_id' => '0', 'nome_tabela' =>'piscina_imagens'];

					Painel::insert($arr);

				}else{

					return false;

				}

			}

			return true;

		}



		public static function uploadImagemEquipamentos($files, $tabela, $id){

			for($i = 0; $i < count($files['type']); $i++){

				$formatoArquivo = explode('.', $files['name'][$i]);

				$imageNome = uniqid().".".$formatoArquivo[count($formatoArquivo) - 1];

				

				if(move_uploaded_file($files['tmp_name'][$i], BASE_DIR_PAINEL."/uploads/".$imageNome)){

					$arr = ['nome' => $imageNome, 'equipamento_id' => $id, 'order_id' => '0', 'nome_tabela' => 'equipamento_imagens'];

					Painel::insert($arr);

				}else{

					return false;

				}

			}

			return true;

		}



		public static function uploadImagensAntesEDepois($files, $tabela, $id){

			for($i = 0; $i < count($files['type']); $i++){

				$formatoArquivo = explode('.', $files['name'][$i]);

				$imageNome = uniqid().".".$formatoArquivo[count($formatoArquivo) - 1];

				if(move_uploaded_file($files['tmp_name'][$i], BASE_DIR_PAINEL."/uploads/".$imageNome)){

					$arr = ['nome' => $imageNome, 'obra_id' => $id, 'order_id' => '0', 'nome_tabela' => 'antesedepois_imagens'];

					Painel::insert($arr);

				}else{

					return false;

				}

			}

			return true;

		}



		public static function uploadImagem($files, $tabela, $id){

			for($i = 0; $i < count($files['type']); $i++){

				$formatoArquivo = explode('.', $files['name'][$i]);

				$imageNome = uniqid().".".$formatoArquivo[count($formatoArquivo) - 1];

				if(move_uploaded_file($files['tmp_name'][$i], BASE_DIR_PAINEL."/uploads/".$imageNome)){

					$arr = ['nome' => $imageNome, 'antesedepois_id' => $id, 'order_id' => '0', 'nome_tabela' => $tabela];

					Painel::insert($arr);

				}else{

					return false;

				}

			}

			return true;

		}



		public static function uploadImagensObra($files, $tabela, $id){

			for($i = 0; $i < count($files['type']); $i++){

				$formatoArquivo = explode('.', $files['name'][$i]);

				$imageNome = uniqid().".".$formatoArquivo[count($formatoArquivo) - 1];

				if(move_uploaded_file($files['tmp_name'][$i], BASE_DIR_PAINEL."/uploads/".$imageNome)){

					$arr = ['nome' => $imageNome, 'obra_id' => $id, 'order_id' => '0', 'nome_tabela' => 'obra_imagens'];

					Painel::insert($arr);

				}else{

					return false;

				}

			}

			return true;

		}



		public static function uploadBanner($file, $id){

			if(Painel::imagemValida($file)){

				$formatoArquivo = explode('.', $file['name']);

				$imageNome = uniqid().".".$formatoArquivo[count($formatoArquivo) - 1];

				if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL."/uploads/".$imageNome)){

					$sql = MySql::conectar()->prepare("UPDATE site_config SET bannersuperior = ? WHERE id = ?");

					$sql->execute(array($imageNome, $id));

				}else{

					return false;

				}

			}else{

				return false;

			}

			return true;

		}



		public static function deleteFile($file){

			@unlink('uploads/'.$file);

		}



		public static function insert($arr){

			$certo = true;

			$nome_tabela = $arr['nome_tabela'];

			$query = "INSERT INTO `$nome_tabela` VALUES (null";

			foreach ($arr as $key => $value) {

				$nome = $key;

				$valor = $value;

				if($nome == 'acao' || $nome == 'nome_tabela')

					continue;

				if($value == ''){

					$certo = false;

					break;

				}

				$query.=",?";

				$parametros[] = $value;

			}



			$query.=")";

			if($certo == true){

				$sql = MySql::conectar()->prepare($query);

				$sql->execute($parametros);

			}

			return $certo;

		}



		public static function update($arr,$single = false){

			$certo = true;

			$first = false;

			$nome_tabela = $arr['nome_tabela'];



			$query = "UPDATE `$nome_tabela` SET ";

			foreach ($arr as $key => $value) {

				$nome = $key;

				$valor = $value;

				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')

					continue;

				if($value == ''){

					$certo = false;

					break;

				}

				

				if($first == false){

					$first = true;

					$query.="$nome=?";

				}

				else{

					$query.=",$nome=?";

				}

				$parametros[] = $value;

			}



			if($certo == true){

				if($single == false){

					$parametros[] = $arr['id'];

					$sql = MySql::conectar()->prepare($query.' WHERE id=?');

					$sql->execute($parametros);

				}else{

					$sql = MySql::conectar()->prepare($query);

					$sql->execute($parametros);

					

				}

			}

			return $certo;

		}



		public static function selectAll($tabela,$start = null,$end = null){

			if($start == null && $end == null)

				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC");

			else

				$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC LIMIT $start,$end");



			$sql->execute();

			return $sql->fetchAll();

		}



		public static function selectAllMensagem($start = null, $end = null){

			$sql = Mysql::conectar()->prepare("SELECT * FROM mensagem ORDER BY horario ASC LIMIT $start, $end");

			$sql->execute();

			return $sql->fetchAll();

		}



		public static function deletar($tabela,$id=false){

			if($id == false){

				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");

			}else{

				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = $id");

			}

			$sql->execute();

		}



		public static function redirect($url){

			echo '<script>location.href="'.$url.'"</script>';

			die();

		}



		/*

			Metodo especifico para selecionar apenas 1 registro.

		*/

		public static function select($table,$query = '',$arr = ''){

			if($query != false){

				$sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");

				$sql->execute($arr);

			}else{

				$sql = MySql::conectar()->prepare("SELECT * FROM `$table`");

				$sql->execute();

			}

			return $sql->fetch();

		}



		public static function orderItem($tabela,$orderType,$idItem){

			if($orderType == 'up'){

				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));

				$order_id = $infoItemAtual['order_id'];

				$itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");

				$itemBefore->execute();

				if($itemBefore->rowCount() == 0)

					return;

				$itemBefore = $itemBefore->fetch();

				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));

				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));

			}else if($orderType == 'down'){

				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));

				$order_id = $infoItemAtual['order_id'];

				$itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");

				$itemBefore->execute();

				if($itemBefore->rowCount() == 0)

					return;

				$itemBefore = $itemBefore->fetch();

				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));

				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));

			}

		}

		

	}



?>
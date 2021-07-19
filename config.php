<?php

	//Aqui coloca o domínio do site com https ou http
	define('INCLUDE_PATH','https://www.celinvariedades.com.br/');
	//Aqui coloca do domínio do site apontando para o painel de controle (não precisa alterar nada)
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

	define('BASE', dirname(__FILE__));
	define('BASE_DIR_PAINEL',__DIR__.'/painel');

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoLoad.php');
		}
		require('classes/'.$class.'.php');
	};
	
	spl_autoload_register($autoload);



	//Conectar com banco de dados!
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','celina');

	//Aqui altera o nome da empresa
	define('NOME_EMPRESA','Nevaska Distribuidora');

	//Funções do painel
	function pegaCargo($indice){
		return Painel::$cargos[$indice];
	}

	function selecionadoMenu($par){
		/*<i class="fa fa-angle-double-right" aria-hidden="true"></i>*/
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo 'style="display:none;"';
		}
	}

	function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel/pages/permissao_negada.php');
			die();
		}
	}
?>
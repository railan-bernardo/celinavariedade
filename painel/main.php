<?php

	if(isset($_GET['loggout'])){

		Painel::loggout();

	}

	

$sql = MySql::conectar()->prepare("SELECT * FROM mensagem WHERE visualizada = FALSE");

$sql->execute();

$mensagem_num = $sql->rowCount();



?>

<!DOCTYPE html>

<html>

<head>

	<title>Painel de Controle</title>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/font-awesome.min.css">

	<link href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css" rel="stylesheet" />

</head>

<body>



<div class="menu">

	<div class="menu-wraper">

	<div class="box-usuario">

		<?php

			if($_SESSION['img'] == ''){

		?>

			<div class="avatar-usuario">

				<i class="fa fa-user"></i>

			</div><!--avatar-usuario-->

		<?php }else{ ?>

			<div class="imagem-usuario">

				<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" />

			</div><!--avatar-usuario-->

		<?php } ?>

		<div class="nome-usuario">

			<p><?php echo $_SESSION['nome']; ?></p>

			<p><?php echo pegaCargo($_SESSION['cargo']); ?></p>

		</div><!--nome-usuario-->

	</div><!--box-usuario-->

	<div class="items-menu">
	<h2><a <?php selecionadoMenu('listar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-noticias">Notícias</a></h2>
		<h2><a <?php selecionadoMenu('listar-leis'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-leis">Leis / Decretos</a></h2>
				<h2><a <?php selecionadoMenu('listar-foto'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-foto">Galeria de Fotos</a></h2>
	<h2><a <?php selecionadoMenu('listar-secretariados'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-secretariados">Secretariados</a></h2>
	<h2><a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Slides</a></h2>
	</div><!--items-menu-->

	</div><!--menu-wraper-->

</div><!--menu-->



<header>

	<div class="center">

		<div class="menu-btn">

			<i class="fa fa-bars"></i>

		</div><!--menu-btn-->



		<div class="loggout">

			<a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a;padding: 15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i class="fa fa-home"></i> <span>Página Inicial</span></a>

			<a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"> <i class="fa fa-window-close"></i> <span>Sair</span></a>

		</div><!--loggout-->



		<div class="clear"></div>

	</div>

</header>



<div class="content">



	<?php Painel::carregarPagina(); ?>





</div><!--content-->



<script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>

<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>

<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>

 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

  <script>

  tinymce.init({ 

  	selector:'.tinymce',

  	plugins: "image",

  	height:300

   });

  </script>

</body>

</html>
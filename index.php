<?php error_reporting(E_ERROR | E_PARSE);  //Comentar essa linha caso seja necessário debugar?> 
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php include('config.php'); ?>

<?php Site::updateUsuarioOnline(); ?>

<?php Site::contador(); ?>

<?php

	$infoSite = MySql::conectar()->prepare("SELECT * FROM `site_config`");

	$infoSite->execute();

	$infoSite = $infoSite->fetch();

?>

<!DOCTYPE html>

<html>

<head>

	<title>Nevaska Distribuidora - Correias Transportadoras, Mangueiras Hidráulicas, Terminais e Conexões, Rolamentos, Polias</title>

	<link rel="stylesheet" href="../estilo/font-awesome.min.css">


	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

	<link rel="stylesheet" href="../estilo/simple-lightbox.css?v2.2.1" />
	
	 <link rel='stylesheet' id='styleContraste' href="../estilo/style.css"  type='text/css' media='all' />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="keywords" content="nevaska distribuidora">

	<meta name="description" content="Nevaska Distribuidora ">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,400;1,900&display=swap" rel="stylesheet">

	<link rel="icon" href="../favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="../favicon.png">
	<link rel="apple-touch-icon" href="../favicon.png">

	<meta charset="utf-8" />

</head>

<base base="<?php echo INCLUDE_PATH; ?>" />

	<?php

		$url = isset($_GET['url']) ? explode('/', @$_GET['url'])[0] : 'home';

		//$slug = isset($_GET['url'][1]) ? explode('/',$_GET['url'])[1] : '';

		if(isset(explode('/', @$_GET['url'])[1])){

			$slug = isset($_GET['url'][1]) ? explode('/',$_GET['url'])[1] : '';

		}

		switch ($url) {

			case 'depoimentos':

				echo '<target target="depoimentos" />';

				break;



			case 'servicos':

				echo '<target target="servicos" />';

				break;

		}

	?>
<header>
    <div class="whatsapp">
        <img src="../img/whats.gif">
    </div>
        <div class="idioma">
 <div id="google_translate_element" class="boxTradutor"></div>

    <a href="javascript:trocarIdioma('pt')"><img alt="pt" src="../images/br.jpg" class="traducao"></a>
    <a href="javascript:trocarIdioma('en')"><img alt="en" src="../images/usa.jpg" class="traducao"></a>
    </div>
    </div>
	        	    <a href="../home">
<div class="logo" alt="Marca">
</div>
</a>
	<div class="menu">

		<i id="menuBtn" class="fa fa-bars"></i>

	</div>
<div class="topo">
    <div class="container-superior">
        <ul id="menu">
        <li id="home"><a href="<?php echo INCLUDE_PATH; ?>/sobre">Quem Somos</a></li>
        <li id="home"><a href="<?php echo INCLUDE_PATH; ?>/contato">Faça seu Orçamento</a></li>
        <li>
            <a href="#">Produtos ￬</a>
            <ul class="hidden">
		    <li><a href="../noticia/correia-elevadora">Correias Elevadoras</a></li>
		    <li><a href="../noticia/correias-transportadoras">Correias Transportadoras</a></li>
		    <li><a href="../noticia/correias-industriais">Correias Industriais</a></li>
		    <li><a href="../noticia/mangueira-hidrulica">Mangueiras Hidráulicas</a></li>
		    <li><a href="../noticia/mangueiras-industriais">Mangueiras Industriais</a></li>
		    <li><a href="../noticia/mangotes-e-descarga">Mangotes e Descarga</a></li>
<li><a href="../noticia/terminais-hidraulicos">Conexões e Terminais</a></li>
<li><a href="../noticia/rolamentos-e-mancais">Rolamentos e Mancais</a></li>
<li><a href="../noticia/polias">Polias</a></li>
            </ul>
        </li>
                <li>
            <a href="#" class="txtFontC">Catálogo ￬</a>
            <ul class="hidden">
                <li><a href="../catalogo/catalogo-final-terminais.pdf"  class="txtFontC">Terminais e Adaptadores</a>
                </li>
                <li><a href="../catalogo/sauber.pdf"  class="txtFontC">Mangueiras Hidráulicas</a></li>
                <li><a href="../catalogo/correias-transportadora(novo).pdf"  class="txtFontC">Correias Transportadoras</a></li>
                <li><a href="../catalogo/correias(novo).pdf"  class="txtFontC">Correias Industriais</a></li>
                <li><a href="../catalogo/correias-v.pdf"  class="txtFontC">Correias Industriais</a></li>
                <li><a href="../catalogo/canecas-plasticas(novo).pdf"  class="txtFontC">Canecas</a></li>
            </ul>
        </li>
        <li id="home"><a href="<?php echo INCLUDE_PATH; ?>/contato">Trabalhe Conosco</a></li>
        <li id="home"><a href="https://www.google.com/maps/dir//nevaska+distribuidora/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x935ef67ccc046a15:0x7f57c32f35432982?sa=X&ved=2ahUKEwiirPSLiOzvAhWYHbkGHUXEDqAQ9RcwFnoECCcQBQ" target="_new">Localização</a></li>
        <li id="home"><a href="<?php echo INCLUDE_PATH; ?>/contato">Contato</a></li>
    </ul>
</div>
</div>
	</div><!--container-principal-->
</header>


	<div class="container-principal">

	<?php

		if(file_exists('pages/'.$url.'.php')){

			include('pages/'.$url.'.php');

		}else{

			//Podemos fazer o que quiser, pois a página não existe.

			if($url != 'depoimentos' && $url != 'servicos'){

				$pagina404 = true;

				include('pages/404.php');

			}else{

				include('pages/home.php');

			}

		}



	?>



	</div><!--container-principal-->



<footer>
<div class="meio">
	<div class="footer-top">
		<div class="footer-item-menor">
		    <div class="icone">
		        <i class="fa fa-whatsapp"></i>
		    </div>
				<div class="item-text">
					<p>Suporte / Vendas</p>
					<p>(62) 3942-7010</p>
				</div>

		</div>
		<div class="footer-item">
		    <div class="icone">
		        <i class="fa fa-map-marker"></i>
		    </div>
				<div class="item-text">
					<p>Rua das Palmas 737 </p>
					<p>Parque Oeste Industrial, Goiânia-GO</p>
				</div>

		</div>
		<div class="footer-item-menor">
		    <div class="icone">
		        <i class="fa fa-clock-o"></i>
		    </div>
				<div class="item-text">
					<p>De segunda a sexta-feira</p>
					<p>das 8h às 18h</p>
				</div>

		</div>
	</div><!--footer-top-->
	</div>
</footer>
<footer>
    <div class="footer-bottom">

		<div id="copyright" class="footer-bottom-item">

			<h5 class="center">© Copyright 2021 Nevaska Distribuidora. Todos direitos reservados. By Bagagem.digital</h5>

		</div>

	</div><!--footer-bottom-->
</footer>

  
    <script type="text/javascript">
    var comboGoogleTradutor = null; //Varialvel global

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'pt',
            includedLanguages: 'pt,en'
        }, 'google_translate_element');

        comboGoogleTradutor = document.getElementById("google_translate_element").querySelector(".goog-te-combo");
    }

    function changeEvent(el) {
        if (el.fireEvent) {
            el.fireEvent('onchange');
        } else {
            var evObj = document.createEvent("HTMLEvents");

            evObj.initEvent("change", false, true);
            el.dispatchEvent(evObj);
        }
    }

    function trocarIdioma(sigla) {
        if (comboGoogleTradutor) {
            comboGoogleTradutor.value = sigla;
            changeEvent(comboGoogleTradutor);//Dispara a troca
        }
    }
    </script>
        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>

	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>

	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>

	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

    <!-- ACESSIBILIDADE JS -->
    <script src="<?php echo INCLUDE_PATH; ?>js/acessibilidade.js"></script>


	<?php

		if($url == 'contato'){

	?>

	<?php } ?>

	<!--<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>-->

</body>

</html>
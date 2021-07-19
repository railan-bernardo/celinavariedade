<?php 
	$slide = [];
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.slides`");
	$sql->execute();
	$result = $sql->fetchAll();
?>

<div class="banner">
<div class="owl-carousel">

            <?php

	for($i = 0; $i < $sql->rowCount(); $i++){



?>

                    <div>
     <img src="<?php echo INCLUDE_PATH; ?>painel/uploads/<?php echo $result[$i]['slide']; ?>">
                    </div>
            <?php } ?>
</div>
</div>
<div class="container-superior">
<div class="col-sm-7">
<h3>SOLUÇÕES EM</h3>
<h2>SUPRIMENTOS INDUSTRIAIS</h2>
<p>Somos uma das maiores distribuidoras do Centro-Oeste.</p>
<p>Com mais de 2.000 clientes.</p>
</br>
<p>Com uma linha completa de produtos, atendemos os principais </p>
<p>segmentos: Agrícola, Automotivo, Industrial e Outros.</p>
</br>
<p>Qualidade, eficiência, preço justo e atendimento.</p>
<p>Conte com nossa Gente!</p>
<div class="marcas"></div>
</p>
</div>
<div class="col-sm-5 sauber">
</div>
</div>

<script>
    (function() {
        var $gallery = new SimpleLightbox('.gallery a', {});
    })();
</script>
<link rel="stylesheet" href="../estilo/owl.carousel.min.css">
<link rel="stylesheet" href="../estilo/owl.theme.default.min.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
<script>
$('.owl-carousel').owlCarousel({
    items:1,
    margin:30,
        autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true
});
</script>
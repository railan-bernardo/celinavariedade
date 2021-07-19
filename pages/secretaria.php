<?php

$sql = Mysql::conectar()->prepare("SELECT * FROM secretariado WHERE slug = ?");
$sql->execute(array($slug));
$secretariado = $sql->fetch();
?>
<section class="faixa">
    <div class="container">
    <p class="txtFontC"><?php echo $secretariado['nome']; ?></p>
    </div>
    </section>
<section class="detalhado">
    <div class="container-secao">
        <div class="gallery">
        <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$secretariado['capa']; ?>');" class="img-categoria"></div>
        </div><!--gallery-->
            <div class="description txtFontC">
        <?php echo $secretariado['descricao']; ?>
    </div>
    </div><!--container-->
</section>
<script src="<?php echo INCLUDE_PATH.'/js/'; ?>/simple-lightbox.js?v2.2.1"></script>
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
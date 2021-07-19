<?php

$sql = Mysql::conectar()->prepare("SELECT * FROM noticia WHERE slug = ?");
$sql->execute(array($slug));
$noticia = $sql->fetch();

$sql = Mysql::conectar()->prepare("SELECT * FROM noticia_imagens WHERE noticia_id = ?");
$sql->execute(array($noticia['id']));
$imagens = $sql->fetchAll();
?>
<section class="faixa">
    <div class="container">
    <p><?php echo $noticia['nome']; ?></p>
    </div>
    </section>
<section class="detalhado">
    <div class="container-secao">
        <div class="gallery">
        <div class="owl-carousel">

            <?php foreach($imagens as $key => $value){ ?>
                <a href="<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$value['nome']; ?>" class="big">
                    <div>
      
                              <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$value['nome']; ?>');" class="img-categoria"></div>
                    </div></a>
            <?php } ?>
</div>
        </div><!--gallery-->
            <div class="description">
        <?php echo $noticia['descricao']; ?>
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
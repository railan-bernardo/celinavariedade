	<?php
$sql = Mysql::conectar()->prepare("SELECT * FROM foto ORDER by id DESC");
$sql->execute(array(''));
$result = $sql->fetchAll();
?>
<section class="faixa">
    <div class="container">
    <p class="txtFontC">GALERIA DE FOTOS</p>
    </div>
    </section>
    <section class="geral">
	<div class="container-secao">

    <?php
		for($i = 0; $i < $sql->rowCount(); $i++){
		?>
<div class="col-geral">
    <div class="gallery">
<a href="<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$result[$i]['capa']; ?>" class="big">
            <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$result[$i]['capa']; ?>');" class="img-noticia-menor"></div>
          	</a>
</div>
</div>
<?php

		}

?>
	</div>
	</section>
	<script src="<?php echo INCLUDE_PATH.'/js/'; ?>/simple-lightbox.js?v2.2.1"></script>
<script>
    (function() {
        var $gallery = new SimpleLightbox('.gallery a', {});
    })();
</script>
	<?php
$sql = Mysql::conectar()->prepare("SELECT * FROM noticia ORDER by id DESC");
$sql->execute(array(''));
$result = $sql->fetchAll();
?>
<section class="faixa">
    <div class="container">
    <p>Notícias</p>
    </div>
    </section>
    <section class="geral">
	<div class="container-secao">

    <?php
		for($i = 0; $i < $sql->rowCount(); $i++){
		?>
<div class="col-geral">
<a href="/noticia/<?php echo $result[$i]['slug']; ?>">
            <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$result[$i]['capa']; ?>');" class="img-noticia-menor"></div>
            <h5><?php echo $result[$i]['data']; ?> | <?php echo $result[$i]['tipo']; ?></h5>
          	<p><?php echo $result[$i]['nome']; ?></p>
          	</a>
			<div class="texto">
				<a href="/noticia/<?php echo $result[$i]['slug']; ?>" class="veja-mais">Ver mais</a>
			</div>
</div>

<?php

		}

?>
	</div>
	</section>
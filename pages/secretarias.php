	<?php
$sql = Mysql::conectar()->prepare("SELECT * FROM secretariado WHERE tipo = ? ORDER by nome DESC");
$sql->execute(array('1'));
$result = $sql->fetchAll();
?>
<section class="faixa">
    <div class="container">
    <p class="txtFontC">SECRETARIAS</p>
    </div>
    </section>
    <section class="geral">
	<div class="container-secao">

    <?php
		for($i = 0; $i < $sql->rowCount(); $i++){
		?>
<div class="col-geral">
<a href="/secretaria/<?php echo $result[$i]['slug']; ?>">
            <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$result[$i]['capa']; ?>');" class="img-noticia-menor"></div>
          	<p class="txtFontC"><?php echo $result[$i]['nome']; ?></p>
          	</a>
			<div class="texto">
				<a href="/secretaria/<?php echo $result[$i]['slug']; ?>" class="veja-mais">Veja mais</a>
			</div>
</div>

<?php

		}

?>
	</div>
	</section>
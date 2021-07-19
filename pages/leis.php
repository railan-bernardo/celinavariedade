	<?php
$sql = Mysql::conectar()->prepare("SELECT * FROM lei WHERE tipo = ? ORDER by id DESC");
$sql->execute(array('Leis'));
$result = $sql->fetchAll();
?>
<section class="faixa">
    <div class="container">
    <p class="txtFontC">LEIS</p>
    </div>
    </section>
    <section class="geral">
	<div class="container-secao">

    <?php
		for($i = 0; $i < $sql->rowCount(); $i++){
		?>
<div class="col-geral">
          	<p class="txtFontC"><?php echo $result[$i]['nome']; ?></p>
          	<p class="txtFontC"><?php echo $result[$i]['descricao']; ?></p>
			<div class="texto">
				<a href="<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$result[$i]['capa']; ?>" class="veja-mais">Baixar</a>
			</div>
</div>

<?php

		}

?>
	</div>
	</section>
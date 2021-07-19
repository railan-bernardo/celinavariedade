	<?php
$sql = Mysql::conectar()->prepare("SELECT * FROM servico WHERE tipo = ?");
$sql->execute(array('Serviços'));
$result = $sql->fetchAll();
?>
<section class="faixa">
    <div class="container">
    <p>Serviços</p>
    </div>
    </section>
    <section class="geral">
	<div class="container">

    <?php
		for($i = 0; $i < $sql->rowCount(); $i++){
		?>
<div class="col-sm-3">
<a href="/categoria/<?php echo $result[$i]['slug']; ?>">
            <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$result[$i]['capa']; ?>');" class="img-servico"></div>
          	<p><?php echo $result[$i]['nome']; ?></p>
          	</a>
			<div class="texto">
				<a href="/categoria/<?php echo $result[$i]['slug']; ?>" class="veja-mais">Ver mais</a>
			</div>
</div>

<?php

		}

?>
	</div>
	</section>
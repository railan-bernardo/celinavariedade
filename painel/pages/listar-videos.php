<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		$selectVid = MySql::conectar()->prepare("SELECT * FROM `videos` WHERE id = ?");
		$selectVid->execute(array($_GET['excluir']));

		$vid = $selectVid->fetch();
		Painel::deleteFile($vid);
		Painel::deletar('videos',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-videos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('videos',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;
	
	$piscinas = Painel::selectAll('videos',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2 class="topo-item"><i class="fa fa-id-card-o" aria-hidden="true"></i> Videos Cadastrados</h2>
	<div class="adicionar"><a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-video"><i class="fa fa-plus" aria-hidden="true"></i> <h3>Cadastrar vídeo</h3></a></div>
	<div class="clear"></div>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome</td>
			<td>URL</td>
			<td>#</td>
			<td>#</td>
		</tr>

		<?php
			foreach ($piscinas as $key => $value) {
		?>
		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td><?php echo $value['link']; ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-videos?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-videos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
		</tr>

		<?php } ?>

	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('videos')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-videos?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-videos?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->


</div><!--box-content-->
<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		$selectImagem = MySql::conectar()->prepare("SELECT capa FROM `secretariado` WHERE id = ?");
		$selectImagem->execute(array($_GET['excluir']));

		$imagem = $selectImagem->fetch()['capa'];
		Painel::deleteFile($imagem);
		Painel::deletar('secretariado',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-secretariados');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('secretariado',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 40;
	
	$secretariados = Painel::selectAll('secretariado',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2 class="topo-item"><i class="fa fa-id-card-o" aria-hidden="true"></i> Secretariado Cadastrados</h2>
	<div class="adicionar"><a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-secretariado"><i class="fa fa-plus" aria-hidden="true"></i> <h3>Cadastrar</h3></a></div>
	<div class="clear"></div>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome</td>
			<td>Imagem principal</td>
			<td>#</td>
			<td>#</td>
		</tr>

		<?php
			foreach ($secretariados as $key => $value) {
		?>
		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td><img style="width: 50px;height:50px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa']; ?>" /></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-secretariado?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-secretariados?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
		</tr>

		<?php } ?>

	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('secretariado')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-secretariados?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-secretariados?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->


</div><!--box-content-->
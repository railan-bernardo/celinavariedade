<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('sobre_itens',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-item-sobre');
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 4;
	
	$piscinas = Painel::selectAll('sobre_itens',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2 class="topo-item"><i class="fa fa-id-card-o" aria-hidden="true"></i> Items Cadastrados</h2>
	<div class="adicionar"><a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-item"><i class="fa fa-plus" aria-hidden="true"></i> <h3>Cadastrar item</h3></a></div>
	<div class="clear"></div>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Título</td>
			<td>Conteúdo</td>
			<td>#</td>
			<td>#</td>
		</tr>

		<?php
			foreach ($piscinas as $key => $value) {
		?>
		<tr>
			<td title="<?php echo $value['header']; ?>"><?php echo mb_substr($value['header'], 0, 25); ?></td>
			<td><?php echo mb_substr($value['body'], 0, 50); ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-item-sobre?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-item-sobre?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
		</tr>

		<?php } ?>

	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('sobre_itens')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-item-sobre?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-item-sobre?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->


</div><!--box-content-->
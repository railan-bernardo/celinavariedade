<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);

		Painel::deletar('mensagem',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'visualizar-mensagens');
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;
	
	//$mensagens = Painel::selectAll('mensagem',($paginaAtual - 1) * $porPagina,$porPagina);
	$mensagens = Painel::selectAllMensagem(($paginaAtual - 1) * $porPagina,$porPagina);
?>
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Caixa de mensagem</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome</td>
			<td>Prévia</td>
			<td>Email</td>
            <td>Telefone</td>
            <td>#</td>
            <td>#</td>
            <td>Vista</td>
		</tr>

		<?php
			foreach ($mensagens as $key => $value) {
		?>
		<tr>
			<td><?php echo substr($value['nome'], 0, 20); ?></td>
			<td><p><?php echo substr($value['conteudo'], 0, 30); ?></p></td>
            <td><p><?php echo substr($value['email'], 0, 20); ?></p></td>
            <td><p><?php echo substr($value['telefone'], 0, 20); ?></p></td>
            <td><a class="btn view" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-mensagem?id=<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Abrir</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-mensagens?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
            <td>
                <?php if($value['visualizada'] != '0'){ ?>
                    <i class="fa fa-check-circle"></i>
                <?php }else{ ?>
                    <i class="fa fa-bell"></i>
                <?php } ?>
            </td>
        </tr>

		<?php } ?>

	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('mensagem')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'visualizar-mensagem?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'visualizar-mensagens?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->


</div><!--box-content-->
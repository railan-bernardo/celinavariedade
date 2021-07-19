<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Foto</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

		if(isset($_POST['acao'])){
			$nome = $_POST['nome'];
				$imagemCapa = $_FILES['capa'];
						//A imagem é valida
						$capa = Painel::uploadFile($imagemCapa);
						include('../classes/lib/WideImage.php');
						$tabela = 'foto';
						$arr = ['nome' => $nome,'capa' => $capa, 'order_id' => '0', 'nome_tabela' => $tabela];
						Painel::insert($arr);
						Painel::alert('sucesso','O cadastro da Foto foi realizado com sucesso!');

		}

		?>
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" required>
		</div><!--form-group-->
				<div class="form-group">
			<label>Anexo</label>
			<input type="file" name="capa" required>
		</div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->
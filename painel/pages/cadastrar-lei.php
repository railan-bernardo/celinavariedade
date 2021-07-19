<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Lei / Decreto</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

		if(isset($_POST['acao'])){
		    $data = $_POST['data'];
			$nome = $_POST['nome'];
			$slug = Painel::slugify($nome, 'lei');
			if($slug){
				$tipo = $_POST['tipo'];
				$descricao = $_POST['descricao'];
				$imagemCapa = $_FILES['capa'];
				if($nome == ''){
					Painel::alert('erro','O campo nome não pode ficar vázio!');
				}else{
						//A imagem é valida
						$capa = Painel::uploadFile($imagemCapa);
						include('../classes/lib/WideImage.php');
						$tabela = 'lei';
						$arr = ['data' => $data, 'nome' => $nome, 'slug' => $slug, 'tipo' => $tipo, 'descricao' => $descricao, 'capa' => $capa, 'order_id' => '0', 'nome_tabela' => $tabela];
						Painel::insert($arr);
						Painel::alert('sucesso','O cadastro da Lei / Decreto foi realizado com sucesso!');
					}
				}

		}

		?>
		<div class="form-group">
			<label>Data:</label>
		<input type="text" name="data" value="<?=date('d/m/Y')?>">
		</div><!--form-group-->
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" required>
		</div><!--form-group-->
		<div class="form-group">
			<label>Tipo do Notícia</label>
			<select name="tipo">
				<option value="Decretos">Decretos</option>
				<option value="Leis">Leis</option>
				
			</select>
		</div><!--form-group-->
		<div class="form-group">
			<label>Descrição</label>
			<textarea placeholder="Descrição" name="descricao" required></textarea>
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
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('descricao');
</script>


<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Notícia</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

		if(isset($_POST['acao'])){
		    $data = $_POST['data'];
			$nome = $_POST['nome'];
			$slug = Painel::slugify($nome, 'noticia');
			if($slug){
				$tipo = $_POST['tipo'];
				$descricao = $_POST['descricao'];
				$imagemCapa = $_FILES['capa'];
				$imagens = $_FILES['imagens'];
					if(Painel::imagensValidas($imagens) == false){
						Painel::alert('erro', 'O formato de um dos arquivos não está correto!');
					}else{
						//A imagem é valida
						$capa = Painel::uploadFile($imagemCapa);
						include('../classes/lib/WideImage.php');
						$tabela = 'noticia';
						$arr = ['data' => $data, 'nome' => $nome, 'slug' => $slug, 'tipo' => $tipo, 'descricao' => $descricao, 'capa' => $capa, 'order_id' => '0', 'nome_tabela' => $tabela];
						Painel::insert($arr);
						$sql = Mysql::conectar()->prepare("SELECT * FROM `noticia` WHERE nome = ?");
						$sql->execute(array($nome));
						$result = $sql->fetch();
						$id = $result['id'];
						if(Painel::uploadImagemnoticia($imagens, 'noticia_imagens', $id)){
							Painel::alert('sucesso', 'O cadastro do Notícia foi realizado com sucesso!');
						}else{
							Painel::alert('erro', 'Ocorreu um erro no upload das imagens!');
						}
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
				<option value="Saúde">Saúde</option>
				<option value="Covid-19">Covid-19</option>
				<option value="Cultura e Lazer">Cultura e Lazer</option>
				<option value="Licitação">Licitação</option>
				<option value="Esporte">Esporte</option>
				<option value="Informativo">Informativo</option>
				
			</select>
		</div><!--form-group-->
		<div class="form-group">
			<label>Descrição</label>
			<textarea placeholder="Descrição" name="descricao" required></textarea>
		</div><!--form-group-->
				<div class="form-group">
			<label>Imagem principal Notícia (foto que será mostrada na página inicial e quando for listada)</label>
			<input type="file" name="capa" required>
		</div><!--form-group-->
		<div class="form-group">
			<label>Imagens para slides</label>
			<input type="file" name="imagens[]" multiple="multiple" required>
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
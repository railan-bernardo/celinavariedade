<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Secretariado</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

					if(isset($_POST['acao'])){
			$nome = $_POST['nome'];
			$slug = Painel::slugify($nome, 'secretariado');
			if($slug){
				$nome = $_POST['nome'];
				$descricao = $_POST['descricao'];
				$imagem = $_FILES['imagem'];
				if($nome == ''){
					Painel::alert('erro','O campo nome não pode ficar vázio!');
				}else{
					//Podemos cadastrar!
					if(Painel::imagemValida($imagem) == false){
						Painel::alert('erro','O formato especificado não está correto!');
					}else{
						//Apenas cadastrar no banco de dados!
						include('../classes/lib/WideImage.php');
						$imagem = Painel::uploadFile($imagem);
						//WideImage::load('uploads/'.$imagem)->resize(100)->rotate(180)->saveToFile('uploads/'.$imagem);
						$arr = ['nome'=>$nome, 'slug' => $slug, 'descricao'=>$descricao, 'capa'=>$imagem,'tipo'=>'1', 'order_id'=>'0', 'nome_tabela'=>'secretariado'];
						Painel::insert($arr);
						Painel::alert('sucesso','O cadastro do secretariado foi realizado com sucesso!');
					}
				}
			}
			}
		?>

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->
		<div class="form-group">
			<label>Descrição</label>
			<textarea placeholder="Descrição" name="descricao" required></textarea>
		</div><!--form-group-->
		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
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
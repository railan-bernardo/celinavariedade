<?php 
	$site = Painel::select('site_config',false);
?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Configurações do Site</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				if(Painel::update($_POST,true)){
					Painel::alert('sucesso','O site foi editado com sucesso!');
					$site = Painel::select('site_config',false);
				}else{
					Painel::alert('erro','Campos vázios não são permitidos.');
				}
			}
		?>

		<div class="form-group">
			<label>Título do site:</label>
			<input type="text" name="titulo" value="<?php echo $site['titulo'] ?>" required>
		</div><!--form-group-->
		<div class="form-group">
			<label>Telefone da empresa</label>
			<input type="text" name="telefone" placeholder="(99) 99999-9999" value="<?php echo $site['telefone'] ?>" required>
		</div><!--form-group-->
		<div class="form-group">
			<label>Whatsapp<span class="red"> (sem espaços, traços e parênteses)</span> DDD e número:</label>
			<input type="text" name="whatsapp" placeholder="11999999999" value="<?php echo $site['whatsapp']; ?>" required>
		</div><!--form-group-->
		<div class="form-group">
			<label>Usuário Instagram:</label>
			<input type="text" name="copyright" placeholder="@rqualityinspecoes" value="<?php echo $site['copyright'] ?>" required>
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do site para SEO:</label>
			<textarea name="descricao" placeholder="Site de venda de piscinas e equipamentos similares" required><?php echo $site['descricao']; ?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Meta tags para SEO <span class="red">(separe por vírgulas).</span>  Máximo 10 tags: </label>
			<input type="text" name="metatags" placeholder="projetos, equipamentos..." value="<?php echo $site['metatags']; ?>" required>
		</div><!--form-group-->
	
		<div class="form-group"></div><!--form-group-->
		<div class="form-group">
			<input type="hidden" name="nome_tabela" value="site_config" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->
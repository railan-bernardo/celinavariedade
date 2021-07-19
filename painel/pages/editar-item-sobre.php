<?php 

/*Fazendo update*/
if(isset($_POST['acao'])){
    if(Painel::update($_POST)){
        Painel::alert("sucesso", "O vídeo foi atualizado com sucesso!");
    }else{
        Painel::alert("erro", "Campos vazios não são permitidos!");
    }
}
/*Fim do update*/

	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$item = Painel::select('sobre_itens','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
    }



 ?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Item</h2>

    <form method="post" enctype="multipart/form-data">

		<div class="form-group">
			<label>Título:</label>
			<input type="text" name="header" value="<?php echo $item['header']; ?>">
		</div><!--form-group-->
        
        <div class="form-group">
			<label>Descrição:</label>
				<textarea name="body" placeholder="Sobre a empresa"><?php echo $item['body'] ?></textarea>
        </div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="sobre_itens" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

    </form>

</div><!--box-content-->
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('body');
</script>
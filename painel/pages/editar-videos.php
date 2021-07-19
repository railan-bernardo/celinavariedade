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
		$videos = Painel::select('videos','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
    }



 ?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Vídeo</h2>

    <form method="post" enctype="multipart/form-data">

		<div class="form-group">
			<label>Título vídeo:</label>
			<input type="text" name="nome" value="<?php echo $videos['nome']; ?>">
		</div><!--form-group-->
        
        <div class="form-group">
			<label>URL do vídeo:</label>
			<input type="text" name="link" value="<?php echo $videos['link'] ?>">
        </div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="videos" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

    </form>

</div><!--box-content-->
<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$secretariado = Painel::select('secretariado','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Secretariado</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
	/*Update da secretariado*/
if(isset($_POST['acao'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    if($_FILES['capa']['name'] != ''){
        if(Painel::imagemValida($_FILES['capa'])){
            $capa = Painel::uploadFile($_FILES['capa']);
            $slug = Painel::slugifyUpdate($nome, 'secretariado', $id);
            if($slug){
                $arr = ['id' => $id, 'nome'=>$nome, 'slug' => $slug, 'descricao'=>$descricao, 'capa'=>$imagem,'tipo'=>'1', 'order_id'=>'0', 'nome_tabela'=>'secretariado'];
                Painel::update($arr);
                Painel::alert("sucesso", "secretariado atualizada com sucesso!");
            }else{
                Painel::alert('erro', 'Já existe outra secretariado com esse nome. Por favor, insira outro');
            }
        }else{
            Painel::alert("erro", "O formato da imagem principal é inválida!");
        }
    }else{
        $slug = Painel::slugifyUpdate($nome, 'secretariado', $id);
        if($slug){
            $arr = ['id' => $id, 'nome'=>$nome, 'slug' => $slug, 'descricao'=>$descricao, 'tipo'=>'1', 'order_id'=>'0', 'nome_tabela'=>'secretariado'];
            Painel::update($arr);
            Painel::alert('sucesso', 'secretariado atualizada com sucesso!');
        }else{
            Painel::alert('erro', 'Já existe outra secretariado com esse nome. Por favor, insira outro');
        }
    }
}
/*Fim do update da secretariado*/
		?>

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" value="<?php echo $secretariado['nome']; ?>">
		</div><!--form-group-->
				<div class="form-group">
			<label>Descrição</label>
			<textarea placeholder="Descrição" name="descricao"><?php echo $secretariado['descricao']; ?></textarea>
		</div><!--form-group-->
		<div class="form-group">
			<label>Imagem <span class="red">(só faça upload se quiser alterar o secretariado antigo)</span></label>
			<input type="file" name="capa"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="secretariado" />
			<input type="submit" name="acao" value="Salvar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('descricao');
</script>
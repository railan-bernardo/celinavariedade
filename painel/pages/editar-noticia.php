<?php 
/*Excluir imagem da noticia*/
if(isset($_GET['excluir-imagem'])){
    $img_id = $_GET['excluir-imagem'];
    $id = $_GET['id'];
    $sql = Mysql::conectar()->prepare("DELETE FROM noticia_imagens WHERE id = ?");
    $sql->execute(array($img_id));
    header("Location: ".INCLUDE_PATH_PAINEL."/editar-noticia?id=$id");
}
/*Fim da exclusão da imagem da noticia*/

/*Update da noticia*/
if(isset($_POST['acao'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    if($_FILES['capa']['name'] != ''){
        if(Painel::imagemValida($_FILES['capa'])){
            $capa = Painel::uploadFile($_FILES['capa']);
            $slug = Painel::slugifyUpdate($nome, 'noticia', $id);
            if($slug){
                $arr = ['id' => $id, 'nome' => $nome, 'slug' => $slug,
                  'tipo' => $tipo, 'descricao' => $descricao, 'capa' => $capa, 'order_id' => '0',
                  'nome_tabela' => 'noticia'];
                Painel::update($arr);
                Painel::alert("sucesso", "noticia atualizada com sucesso!");
            }else{
                Painel::alert('erro', 'Já existe outra noticia com esse nome. Por favor, insira outro');
            }
        }else{
            Painel::alert("erro", "O formato da imagem principal é inválida!");
        }
    }else{
        $slug = Painel::slugifyUpdate($nome, 'noticia', $id);
        if($slug){
            $arr = ['id' => $id, 'nome' => $nome, 'slug' => $slug,
                  'tipo' => $tipo, 'descricao' => $descricao, 'order_id' => '0',
                  'nome_tabela' => 'noticia'];
            Painel::update($arr);
            Painel::alert('sucesso', 'noticia atualizada com sucesso!');
        }else{
            Painel::alert('erro', 'Já existe outra noticia com esse nome. Por favor, insira outro');
        }
    }
}
/*Fim do update da noticia*/

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $noticia = Painel::select('noticia','id = ?',array($id));
}else{
    Painel::alert('erro','Você precisa passar o parametro ID.');
    die();
}
 ?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar noticia</h2>

	<form method="post" enctype="multipart/form-data">
        
        <?php
            $sql = Mysql::conectar()->prepare("SELECT * FROM noticia_imagens WHERE noticia_imagens.noticia_id = ?");
            $sql->execute(array($id));
            
            $imagens_num = $sql->rowCount();
            $imagens = $sql->fetchAll();

		?>

		<div class="form-group">
			<label>Nome da noticia:</label>
			<input type="text" name="nome" value="<?php echo $noticia['nome']; ?>">
		</div><!--form-group-->
        <div class="form-group">
			<label>Tipo:</label>
			<select name="tipo">
                <option value="Saúde" <?php if($noticia['tipo'] == 'Saúde'){ echo "selected"; } ?>>Saúde</option>
                <option value="Covid-19" <?php if($noticia['tipo'] == 'Covid-19'){ echo "selected"; } ?>>Covid-19</option>
                <option value="Cultura e Lazer" <?php if($noticia['tipo'] == 'Cultura e Lazer'){ echo "selected"; } ?>>Cultura e Lazer</option>
                <option value="Licitação" <?php if($noticia['tipo'] == 'Licitação'){ echo "selected"; } ?>>Licitação</option>
                <option value="Esporte" <?php if($noticia['tipo'] == 'Esporte'){ echo "selected"; } ?>>Esporte</option>
                <option value="Informativo" <?php if($noticia['tipo'] == 'Informativo'){ echo "selected"; } ?>>Informativo</option>
            </select>
        </div><!--form-group-->
        <div class="form-group">
			<label>Descrição da noticia:</label>
			<textarea name="descricao" placeholder="Descrição da noticia de até 300 caracteres..."><?php echo $noticia['descricao']; ?></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <label>Trocar foto principal (só faça upload de uma foto se quiser trocar a foto principal antiga)</label>
            <input type="file" name="capa">
        </div>
        <div class="imagem-list">
            <h2>Imagens Serviço</h2>
            <ul>
                <?php
                    for($i = 0; $i < $imagens_num; $i++){
                ?>

                <div class="imagem-item">
                    <img src="<?php echo INCLUDE_PATH_PAINEL; ?>/uploads/<?php echo $imagens[$i]['nome']; ?>">
			        <a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-noticia?id=<?php echo $id; ?>&excluir-imagem=<?php echo $imagens[$i]['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
                </div>

                <?php
                    }
                ?>
            </ul>
        </div>
        <div class="clear"></div>

        
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="noticia" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

    </form>
    <div class="linha"></div>
    <form method="POST" action="<?php echo INCLUDE_PATH_PAINEL; ?>adicionar-foto-noticia" enctype="multipart/form-data">
        <div class="form-group">
            <label>Adicionar novas fotos da noticia</label>
            <input type="file" name="imagens[]" multiple="multiple">
        </div><!--form-group-->

        <div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="noticia" />
			<input type="submit" name="acao" value="Salvar!">
		</div><!--form-group-->
    </form>



</div><!--box-content-->
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('descricao');
</script>
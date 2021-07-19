<?php 
/*Excluir imagem da piscina*/
if(isset($_GET['excluir-imagem'])){
    $img_id = $_GET['excluir-imagem'];
    $id = $_GET['id'];
    $sql = Mysql::conectar()->prepare("DELETE FROM piscina_imagens WHERE id = ?");
    $sql->execute(array($img_id));
    header("Location: ".INCLUDE_PATH_PAINEL."/editar-piscina?id=$id");
}
/*Fim da exclusão da imagem da piscina*/

/*Update da piscina*/
if(isset($_POST['acao'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $principal = $_POST['principal'];
    $descricao = $_POST['descricao'];
    if($_FILES['capa']['name'] != ''){
        if(Painel::imagemValida($_FILES['capa'])){
            $capa = Painel::uploadFile($_FILES['capa']);
            $slug = Painel::slugifyUpdate($nome, 'piscina', $id);
            if($slug){
                $arr = ['id' => $id, 'nome' => $nome, 'slug' => $slug,
                  'tipo' => $tipo, 'principal' => $principal, 'descricao' => $descricao, 'capa' => $capa, 'order_id' => '0',
                  'nome_tabela' => 'piscina'];
                Painel::update($arr);
                Painel::alert("sucesso", "Piscina atualizada com sucesso!");
            }else{
                Painel::alert('erro', 'Já existe outra piscina com esse nome. Por favor, insira outro');
            }
        }else{
            Painel::alert("erro", "O formato da imagem principal é inválida!");
        }
    }else{
        $slug = Painel::slugifyUpdate($nome, 'piscina', $id);
        if($slug){
            $arr = ['id' => $id, 'nome' => $nome, 'slug' => $slug,
                  'tipo' => $tipo, 'principal' => $principal, 'descricao' => $descricao, 'order_id' => '0',
                  'nome_tabela' => 'piscina'];
            Painel::update($arr);
            Painel::alert('sucesso', 'Piscina atualizada com sucesso!');
        }else{
            Painel::alert('erro', 'Já existe outra piscina com esse nome. Por favor, insira outro');
        }
    }
}
/*Fim do update da piscina*/

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $piscina = Painel::select('piscina','id = ?',array($id));
}else{
    Painel::alert('erro','Você precisa passar o parametro ID.');
    die();
}
 ?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Piscina</h2>

	<form method="post" enctype="multipart/form-data">
        
        <?php
            $sql = Mysql::conectar()->prepare("SELECT * FROM piscina_imagens WHERE piscina_imagens.piscina_id = ?");
            $sql->execute(array($id));
            
            $imagens_num = $sql->rowCount();
            $imagens = $sql->fetchAll();

		?>

		<div class="form-group">
			<label>Nome da piscina:</label>
			<input type="text" name="nome" value="<?php echo $piscina['nome']; ?>">
		</div><!--form-group-->
        <div class="form-group">
			<label>Tipo:</label>
			<select name="tipo">
                <option value="Engenharia" <?php if($piscina['tipo'] == 'Engenharia e Projetos'){ echo "selected"; } ?>>Engenharia e Projetos</option>
                <option value="Serviços" <?php if($piscina['tipo'] == 'Serviços'){ echo "selected"; } ?>>Serviços</option>
                <option value="Inspeções" <?php if($piscina['tipo'] == 'Inspeções'){ echo "selected"; } ?>>Inspeções</option>
            </select>
        </div><!--form-group-->
        		<div class="form-group">
			<label>Mostrar na Home:</label>
			<select name="principal">
                <option value="Não" <?php if($piscina['principal'] == 'Não'){ echo "selected"; } ?>>Não</option>
                <option value="Sim" <?php if($piscina['principal'] == 'Sim'){ echo "selected"; } ?>>Sim</option>
            </select>
        </div><!--form-group-->
        <div class="form-group">
			<label>Descrição da piscina:</label>
			<textarea name="descricao" placeholder="Descrição da piscina de até 300 caracteres..."><?php echo $piscina['descricao']; ?></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <label>Trocar foto principal (só faça upload de uma foto se quiser trocar a foto principal antiga)</label>
            <input type="file" name="capa">
        </div>
        <div class="imagem-list">
            <h2>Imagens dessa piscina</h2>
            <ul>
                <?php
                    for($i = 0; $i < $imagens_num; $i++){
                ?>

                <div class="imagem-item">
                    <img src="<?php echo INCLUDE_PATH_PAINEL; ?>/uploads/<?php echo $imagens[$i]['nome']; ?>">
			        <a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-piscina?id=<?php echo $id; ?>&excluir-imagem=<?php echo $imagens[$i]['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
                </div>

                <?php
                    }
                ?>
            </ul>
        </div>
        <div class="clear"></div>

        
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="piscina" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

    </form>
    <div class="linha"></div>
    <form method="POST" action="<?php echo INCLUDE_PATH_PAINEL; ?>/adicionar-foto-piscina" enctype="multipart/form-data">
        <div class="form-group">
            <label>Adicionar novas fotos da piscina</label>
            <input type="file" name="imagens[]" multiple="multiple">
        </div><!--form-group-->

        <div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="piscina" />
			<input type="submit" name="acao" value="Salvar!">
		</div><!--form-group-->
    </form>



</div><!--box-content-->
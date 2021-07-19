<?php 

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $mensagem = Painel::select('mensagem','id = ?',array($id));
    $sql = Mysql::conectar()->prepare("UPDATE mensagem SET visualizada = TRUE WHERE id = ?");
    $sql->execute(array($_GET['id']));
}else{
    Painel::alert('erro','Você precisa passar o parametro ID.');
    die();
}
 ?>
<div class="box-content">
	<h2><i class="fa fa-envelope-o"></i> Detalhes da mensagem enviada</h2>

	<form>
		<div class="form-group">
			<label>Mensagem de:</label>
			<input type="text" name="nome" value="<?php echo $mensagem['nome']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Email:</label>
            <input type="email" value="<?php echo $mensagem['email']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" value="<?php echo $mensagem['telefone']; ?>">
        </div>
        <div class="form-group">
            <label>Horário que a mensagem foi enviada:</label>
            <input type="text" value="<?php echo $mensagem['horario']; ?>">
        </div>
        <div class="form-group">
			<label>Conteúdo da mensagem:</label>
			<textarea name="descricao" placeholder="Descrição da obra de até 300 caracteres..."><?php echo $mensagem['conteudo']; ?></textarea>
        </div><!--form-group-->

 
        <div class="clear"></div>
    </form>
</div><!--box-content-->
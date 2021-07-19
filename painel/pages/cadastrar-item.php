<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Item para a página Sobre</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

			if(isset($_POST['acao'])){
                $header = $_POST['header'];
                $body = $_POST['body'];
				if($header == '' || $body == ''){
					Painel::alert('erro','Nenhum campo pode ficar vazio!');
				}else{
					$arr = ['header' => $header, 'body' => $body, 'order_id' => '0', 'nome_tabela' => 'sobre_itens'];
					Painel::insert($arr);
					Painel::alert('sucesso','O cadastro do item foi realizado com sucesso!');
				}
			}
		?>

		<div class="form-group">
			<label>Título do item:</label>
			<input type="text" name="header" placeholder="Ex.: Em quanto tempo retornamos o contato no Whatsapp?">
		</div><!--form-group-->

        <div class="form-group">
            <label>Conteúdo do item</label>
            <textarea name="body" placeholder="Ex.: Respondendo imediatamente no horário comercial"></textarea>
        </div><!--form-grou-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->
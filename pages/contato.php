<section class="faixa">
    <div class="container">
    <p>FALE CONOSCO</p>
    </div>
    </section>
<div class="contato-container">

		<form method="post" action="">

<?php
	if(isset($_POST['acao'])){
		$now = date('Y-m-d H:i:s');
		$sql = Mysql::conectar()->prepare("INSERT INTO mensagem(nome, email, telefone, conteudo, horario) VALUES(?, ?, ?, ?, ?)");
		$sql->execute(array($_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['conteudo'], $now));
		echo "<p>A mensagem foi enviada com sucesso. Em breve retornaremos com sua resposta...</p>";
	}
?>

			<h2>Tem alguma dúvida, sugestão e/ou reclamação? Entre em contato conosco.</h2>

			<input required type="text" name="nome" placeholder="Nome..." required>
			<div></div>
			<input required type="email" name="email" placeholder="E-mail.." required>
			<div></div>
			<input required type="text" name="telefone" placeholder="Telefone..." required>
			<div></div>
			<textarea required placeholder="Sua mensagem..." name="conteudo" required></textarea>
			<div></div>
			<input type="hidden" name="identificador" value="form_contato" />
			<input type="submit" name="acao" value="Enviar">
		</form>
</div><!--contato-container-->
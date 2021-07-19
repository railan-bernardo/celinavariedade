<?php

$sql = Mysql::conectar()->prepare("SELECT * FROM sobre_itens");
$sql->execute();
$itens = $sql->fetchAll();

$descricao = str_replace("</p>", "<br>", $infoSite['descricao_sobre']);

?>
<section class="faixa">
    <div class="container">

    <p>SOBRE A NEVASKA</p>
  
    </div>
    </section>
<section class="sobre-nos">
    <div class="container">
        <div class="items">

        <div class="item">
<p>A Nevaska Distribuidora de Correias e Peças oferece qualidade em produtos e serviços. Contamos com uma equipe treinada para lhe proporcionar bons negócios. Nosso compromisso principal é com o cliente. Pontualidade na entrega e um pós-venda ativo.</p>
</br>
<h3>Missão</h3>
<p>No mercado globalizado, a Nevaska Distribuidora visa atender às necessidades de seus clientes, proporcionando segurança e qualidade em seus produtos e serviços aqui comercializados, gerando assim bons negócios.</p>
</br>
<h3>Visão</h3>

<p>Ser a melhor alternativa do mercado, com qualidade e custo-benefício em nossos produtos.</p>
</br>
<h3>Valores</h3>

<p>Responsabilidade, técnica, transparência empresarial, idoneidade pessoal e comercial, compromisso,continuidade, perseverança e fé.</p><p>A Nevaska Distribuidora de Correias e Peças oferece qualidade em produtos e serviços. Contamos com uma equipe treinada para lhe proporcionar bons negócios. Nosso compromisso principal é com o cliente. Pontualidade na entrega e um pós-venda ativo.</p>
</br>
<div class="col-sm-4">
     <a href="../img/foto_estrutura_1.jpeg" class="big">
    <img src="../img/foto_estrutura_1.jpeg">
    </a>
</div>
<div class="col-sm-4">
    <a href="../img/foto_estrutura_2.jpeg" class="big">
    <img src="../img/foto_estrutura_2.jpeg">
    </a>
</div>
<div class="col-sm-4">
    <a href="../img/foto_estrutura_3.jpeg" class="big">
    <img src="../img/foto_estrutura_3.jpeg">
    </a>
</div>
<div class="col-sm-4">
    <a href="../img/foto_estrutura_4.jpeg" class="big">
    <img src="../img/foto_estrutura_4.jpeg">
    </a>
</div>
<div class="col-sm-4">
    <a href="../img/foto_estrutura_5.jpeg" class="big">
    <img src="../img/foto_estrutura_5.jpeg">
    </a>
</div>
        </div>

        </div>
    </div>

</section>
<script src="<?php echo INCLUDE_PATH.'/js/'; ?>/simple-lightbox.js?v2.2.1"></script>
<script>
    (function() {
        var $gallery = new SimpleLightbox('.col-sm-4 a', {});
    })();
</script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
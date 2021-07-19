<?php

if($_FILES['imagens']){
    $imagens = $_FILES['imagens'];
    $id = $_POST['id'];
    if(Painel::imagensValidas($imagens) == false){
        Painel::alert('erro', 'O formato de uma das fotos não está correto!');
    }else{
        if(Painel::uploadImagemEquipamentos($imagens, 'equipamento_imagens', $id)){
            Painel::alert('sucesso', 'As imagens foram adicionadas com sucesso!');
            header("Location: ".INCLUDE_PATH_PAINEL."/editar-equipamento?id=$id");
        }else{
            Painel::alert('erro', 'Ocorreu um erro no upload das imagens!');
        }
    }
}

?>
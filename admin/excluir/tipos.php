<?php
    //se nao existir a variavel page
    if ( !isset ($page) ) exit;

    //verificar se existe um usuario cadastrado
    $sql = "select id from tipo 
        where id = :id limit 1";
    //preparar o sql para execução com o banco
    $consultatipo = $pdo->prepare($sql);
    //passar o parametro
    $consultatipo->bindParam(":id", $id);
    //executar o sql
    $consultatipo->execute();

    $tipo = $consultatipo->fetch(PDO::FETCH_OBJ);

    //verificar se existe um produto
    if ( empty($produto->id) ) {
        mensagemErro('Não foi possível excluir esta categoria, pois existe um produto relacionado a ela');
    }

    //sql para excluir
    $sql = "delete from tipo where id = :id limit 1";
    $consultatipo = $pdo->prepare($sql);
    $consultatipo->bindParam(":id", $id);
    
    //verificar se consegue executar
    if ( $consultatipo->execute() ){
        //encaminhar para a tela de listagem
        echo "<script>location.href='listar/tipos';</script>";
        exit;
    }

    mensagemErro('Não foi possível excluir');
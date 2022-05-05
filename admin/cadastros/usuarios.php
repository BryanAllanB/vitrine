<?php
    if ( !isset($page)) exit;

    $nome= $login= $ativo= $email= NULL;

    if ( !empty($id)) {
        $sql= "select * from usuario where id= :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados= $consulta->fecth(PDO::FETCH_OBJ);

        $nome= $dados->nome;
        $login= $dados->login;
        $email= $dados->email;
        $ativo= $dados->ativo;
    }
?>
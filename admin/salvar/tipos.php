<?php
    //se não existir a variavel page
    if ( !isset( $page )) exit;

    if ( $_POST ) {
        //recuperar os dados digitados
        $id = trim($_POST["id"] ?? NULL);
        $tipo = trim($_POST["tipos"] ?? NULL);

        //verificar se o o tipo esta em branco
        if ( empty( $tipo ) ) {
            mensagemErro("Preencha o tipo de usuário");
        }

        //verificar se esta tipo ja não esta cadastrada
        $sql = "select * from tipo 
                    where tipo= :tipos and id <> :id 
                    limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":tipos", $tipo);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //verificar se trouxe resultado
        if ( !empty( $dados->id ) ){
            mensagemErro("Já existe um tipo cadastrado com esse nome");
        }

        //verificar se ira inserir ou se irá atualizar
        if (empty( $id )) {
            $sql= "insert into tipo (tipo) values (:tipos)";
            $consulta=$pdo->prepare($sql);
            $consulta->bindParam(":tipos", $tipo);
        } else {
            $sql = "update tipo set tipo=:tipos where id=:id limit 1";
            $consulta=$pdo->prepare($sql);
            $consulta->bindParam(":tipos", $tipo);
            $consulta->bindParam(":id", $id);
        }

        if (!$consulta->execute()) {
            mensagemErro("Não foi possivel salvar os dados");
        } 
        echo "<script>location.href='listar/tipos';</script>";
        exit;
    }

    //mostrar uma mensagem de erro
    mensagemErro("Requisição invalida");
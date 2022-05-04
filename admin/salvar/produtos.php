<?php
    //se nao existir a variavel page
    if ( !isset ($page) ) exit;

    if ( $_POST ){
        
        //print_r ($_POST);
        
        //print_r($_FILES);

        //recuperar os dados enviados

        foreach ( $_POST as $key => $value) {
            //echo (<p>$key - $value</p>);

            $$key= trim ($value ?? NULL);
        }

        // echo $valor;

        //pegar os nomes dos arquivos
        // print_r ($_FILES["imagem1"]);
        $imagem1= $_FILES["imagem1"]["name"] ?? NULL;
        $imagem2= $_FILES["imagem2"]["name"] ?? NULL;

        //validar os campos
        if ( empty ($valor)) {
            mensagemErro("Preencha o valor");
        } else if (empty ($categoria_id)) {
            mensagemErro("Selecione uma categoria");
        } else if (empty ($id) and empty($imagem1)) {
            mensagemErro("Selecione a primeira Imagem");
        } else if (empty ($id) and empty($imagem2)) {
            mensagemErro("Selecione a segunda Imagem");
        }

        if (!empty ($imagem1)) {
            $imagem1 = time()."_{$imagem1}";
            
            //copiar a imagem para o servidor
            if (!move_uploaded_file($_FILES["imagem1"]["tmp_name"], "../produtos/{$imagem1}")) {
                mensagemErro("Erro ao copiar arquivo1");
            }
        }
        if (!empty ($imagem2)) {
            $imagem2 = time()."_{$imagem2}";
            
            //copiar a imagem para o servidor
            if (!move_uploaded_file($_FILES["imagem2"]["tmp_name"], "../produtos/{$imagem2}")) {
                mensagemErro("Erro ao copiar arquivo2");
            }
        }

        //4.800,00 -> 4900.00
        $valor = str_replace(".", "", $valor);
        //4900,00 -> 4900.00
        $valor = str_replace(",", ".", $valor);
        // echo $valor;

        //inserir ou atualizar os dados
        if (empty($id)) {
            $sql = "insert into produto (nome, categoria_id, valor, descricao, imagem1, imagem2) values 
                (:nome, :categoria_id, :valor, :descricao, :imagem1, :imagem2)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":categoria_id", $categoria_id);
            $consulta->bindParam(":valor", $valor);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":imagem1", $imagem1);
            $consulta->bindParam(":imagem2", $imagem2);
        } else {

            //verificar se as imagens estão em branco, caso esteja, inserir a imagem que já esta gravada dentro do banco
            $sql= "select imagem1, imagem2 from produto 
                        where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->execute();

            $dados= $consulta->fetch(PDO::FETCH_OBJ);

            if (empty ($imagem1)) $imagem1 =$dados->imagem1;
            if (empty ($imagem2)) $imagem2 =$dados->imagem2;

            $sql = "update produto set nome = :nome, categoria_id = :categoria_id, valor= :valor,
                    descricao= :descricao, imagem1= :imagem1, imagem2= :imagem2 where id = :id limit 1";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindParam(":nome", $nome);
                    $consulta->bindParam(":categoria_id", $categoria_id);
                    $consulta->bindParam(":valor", $valor);
                    $consulta->bindParam(":descricao", $descricao);
                    $consulta->bindParam(":imagem1", $imagem1);
                    $consulta->bindParam(":imagem2", $imagem2);
                    $consulta->bindParam(":id", $id);
        }

        if ($consulta->execute()) {
            //enviar a tela para a listagem

            echo "<script>location.href='listar/produtos';</script>";
        } else {
            mensagemErro("Erro ao salvar dados");
        }
    }
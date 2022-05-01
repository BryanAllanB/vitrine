<main>
<?php
    //recuperar o id categoria
    $id = $p[1] ?? NULL;

    //verificar se o id esta vazio
    if( empty($id) ){
        ?>
            <h1>Erro!</h1>
            <h2 class="center">categoria Invalida!</h2>
        <?php
    } else {
        //selecionar a categoria com o id
        $sql = "select nome from categoria where id = :id limit 1";
        $consulta_categoria= $pdo->prepare($sql);
        $consulta_categoria->bindParam(":id", $id);
        $consulta_categoria->execute();
        $dados = $consulta_categoria->FETCH(PDO::FETCH_OBJ);

        $nome = $dados-> nome;

        echo "<h1>catergorias: {$nome}</h1>";

        //selecionar os produtos da categoria
        $sql = "select * from produto where categoria_id= :id order by nome";

        //preparar para a execução
        $consulta = $pdo->prepare($sql);

        //passar o parametro :id
        $consulta->bindParam(":id", $id);
        //$consulta->binParam(":nome", $nome);

        //executar 
        $consulta->execute();

        ?>
        <div class="grid">
            <?php
                while ( $dados = $consulta->FETCH(PDO::FETCH_OBJ) ) {
                    //separar os dados
                    $id = $dados->id;
                    $nome = $dados->nome;
                    $valor = $dados->valor;
                    $imagem1 = $dados->imagem1;

                    $valor = number_format($valor, 2, ",", ".");

                    echo 
                        "<div class='coluna center'>
                            <img src='produtos/{$imagem1}'>
                            <h2>{$nome}</h2>
                            <p class='valor'> R$ {$valor}</p>
                            <p>
                                <a href='produto/{$id}' class='btn'>
                                    <i class=\"fa-solid fa-magnifying-glass\"></i>
                                    Detalhes
                                </a>    
                            </p>
                        </div>";
                }
            ?>
        </div>
        <?php
        
    }

?>
</main>
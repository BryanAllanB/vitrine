<?php
    session_start();

    if ( ( isset($_SESSION["usuario"]["id"] ) AND ($_POST) ) )  {
        include "../config.php";

        //recuperar o nome
        //$dataIncial = trim ( $_POST["dataInicial"] ?? NULL );
        //$dataIncial = "%{$dataInicial}%";

        $sql = "select id, usuario_id, tabela, acao, data, ip from log order by data";
        //$sql = "select id, nome from usuario where nome like :nome OR login like :nome order by nome";
        $consulta = $pdo->prepare($sql);
        //$consulta->bindParam(":usuario_id",$usuario_id);
        $consulta->execute();

        $conta = $consulta->rowCount();


        $sql_usuario = "select id, nome from usuario";
        $consulta_nome= $pdo->prepare($sql_usuario);
        $consulta_nome->execute();
        
        $dados_usuario = $consulta_nome->fetch(PDO::FETCH_OBJ);

        while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {

            ?>
            <tr>
                <td><?=$dados->id?></td>
                <td><?=$dados_usuario->nome?></td>
                <td><?=$dados->tabela?></td>
                <td><?=$dados->acao?></td>
                <td><?=$dados->data?></td>
                <td><?=$dados->ip?></td>
            </tr>
            <?php
        }
    }   
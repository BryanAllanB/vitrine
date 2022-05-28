<?php
    session_start();

    if ( ( isset($_SESSION["usuario"]["id"] ) AND ($_POST) ) )  {
        include "../config.php";
        //recuperar o nome
        $nome = trim ( $_POST["nome"] ?? NULL );
        $nome = "%{$nome}%";

        $sql = "select id, nome, login, ativo from usuario where nome like :nome OR login like :nome order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome",$nome);
        $consulta->execute();

        $conta = $consulta->rowCount();

        while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)) {
            $ativo = "Ativo";
            if ( $dados->ativo == "N") {
                $ativo = "Inativo";
            }
            ?>
            <tr>
                <td><?=$dados->id?></td>
                <td><?=$dados->nome?></td>
                <td><?=$dados->login?></td>
                <td><?=$ativo?></td>
            </tr>
            <?php
        }
    }   
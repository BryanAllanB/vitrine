<?php
    //se não existir a variavel page
    if ( !isset ($page) ) exit;

    $tipo = NULL;

    if ( !empty( $id ) ) {
        $sql = "select * from tipo where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $tipo = $dados->tipo ?? NULL;
    }
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro Usuário</h2>

        <div class="float-right">
            <a href="listar/tipos" title="Listar Usuários" class="btn btn-success">
                Listar Usuários
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formTipo" method="post" action="salvar/tipos" data-parsley-validate="">
            <label for="id">ID tipo</label>
            <input type="text" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            <label for="tipo">Tipo usuario</label>
            <input type="text" name="tipos" id="id" class="form-control" 
                required data-parsley-require-message="Por favor, preencha este campo" value="<?=$tipo?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar dados
            </button>
        </form>
    </div>
</div>



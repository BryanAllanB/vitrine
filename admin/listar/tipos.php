<?php
    if (!isset ( $page )) exit;
?>
<div class="card">
    <div class="card-header">
        <h2 class="float-left">Listar Tipo</h2>
        <div class="float-right">
            <a href="cadastros/tipos" title="Cadastrar novo tipo" class="btn btn-success">
                Cadastrar Tipo
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Tipo Usuário</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    //selecionar todos os tipos
                    $consulta= $pdo->prepare("select * from tipo order by tipo");
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                        ?>
                        <tr>
                            <td><?=$dados->id?></td>
                            <td><?=$dados->tipo?></td>
                            <td width="100px">
                                <a href="cadastros/tipos/<?=$dados->id?>" title="Editar Registro" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="javascript:excluir(<?=$dados->id?>)" title="Excluir Dados"
                                class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    } //fim do while
                ?>
            </tbody>
        </table>
    </div>

</div>
<script>
    $(".table").dataTable();
    function excluir(id) {
        Swal.fire({
            title: 'Você deseja realmente excluir este item?',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                location.href='excluir/tipos/'+id;
            } 
        })
    }
</script>
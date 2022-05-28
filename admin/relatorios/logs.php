<?php
    if ( !isset ( $page ) ) exit;
?>
<div class="card">
    <div class="card-header">
        Relatório de logs
    </div>
    <div class="card-body">
        <form name="formBusca">
            <div class="row d-flex align-items-end">
                <div class="col-12 col-md-4">
                    <label for="dataInicial">Data Inicial:</label>
                    <input type="date" name="dataInicial" id="dataInicial" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                    <label for="dataFinal">Data Final:</label>
                    <input type="date" name="dataFinal" id="dataFinal" class="form-control">
                </div>
                <div class="col-12 col-md-2">
                    <button type="button" id="submit" class="btn btn-success">Buscar</button>
                </div>
            </div>
        </form>

        <p class="text-center">Resultados da Busca</p>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Ação</td>
                    <td>Tabela</td>
                    <td>Data</td>
                    <td>IP</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    

</div>

<script>
    $("#submit").click(function(){
        var dataInicial = $("#dataInicial").val();
        var dataFinal = $("#dataFinal").val();

        $("tbody").html("<tr><td colspan='5' class='text-center'><img src='images/loading.gif'> Aguarde, carregando...</td></tr>");

        $.post("rel-logs.php",{dataInicial:dataInicial,datasFinal:dataFinal}, function(dados){
            $("tbody").html(dados);
        })
    })
</script>

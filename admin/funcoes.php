<?php
    // função para mostrar janelas de error
    function mensagemErro($msg) {
        ?>
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?=$msg?>',
                }).then((result) => {
                    history.back();
                })
            </script>

            <?php
            exit;
    }//fim da função
<?php
    $logs = $_REQUEST['logs'];
?>

<div class="d-flex align-items-center flex-column">
    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Lista de Log das ações</h3>
        <a href="?link=home" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
    </div>

    <div class="table-responsive-md w-50">

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>Codigo na tabela</th>
                    <th>Tabela</th>
                    <th>Ação</th>
                    <th>Dia/Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log) { ?>
                    <tr class="align-bottom">
                        <td class="text-center align-middle"><?php echo $log->codigo_tabela; ?></td>
                        <td class="text-center align-middle"><?php echo $log->tabela; ?></td>
                        <td class="text-center align-middle"><?php echo $log->descricao; ?></td>
                        <td class="text-center align-middle"><?php echo $log->dia_hora; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>


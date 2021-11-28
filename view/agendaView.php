<?php
    $agendas = $_REQUEST['agendas'];
    $mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">

    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Lista de Agendas</h3>
    </div>

    <?php if(!empty($mensagem)){ ?>
    <div class="alert alert-info" role="alert">
        <?php echo $mensagem; ?>
    </div>
    <?php } ?>

    <div class="w-100 table-responsive">

        <table class="table table-bordered table-striped">
            <thead class="">
                <tr class="text-center">
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Endereco</th>
                    <th>Cidade</th>
                    <th>Uf</th>
                    <th>Cep</th>
                    <th>Email</th>
                    <th>Fone</th>
                    <th>Dia</th>
                    <th>Mês</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agendas as $agenda) { ?>
                <tr class="align-bottom">
                    <td class="text-center align-middle"><?php echo $agenda->cod; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->nome; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->endereco; ?>
                    </td>
                    <td class="text-center align-middle" style="white-space: nowrap">
                        <?php echo $agenda->Cidade; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->UF; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->CEP; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->email; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->fone; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->dia; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->mes; ?></td>
                    <td class="text-center align-middle" style="white-space: nowrap"><?php echo $agenda->ano; ?></td>


                    <td class="align-middle">
                        <a href="?link=agendas&metodo=deletarAgenda&codigo=<?php echo $agenda->cod; ?>"
                            class="w-100 btn btn-danger my-1">Apagar</a>
                        <a href="?link=agendas&metodo=alterarAgenda&codigo=<?php echo $agenda->cod; ?>"
                            class="w-100 btn btn-info my-1">Alterar</a>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>
    <a href="?link=agendas&metodo=criarAgenda" class="mb-2 mt-2 py-3 btn btn-primary btn-block">Nova agenda</a>
    <a href="?link=agendas&metodo=criarAgendaXml" class="mb-5 py-3 btn btn-secondary btn-block">Nova agenda
        XML</a>
</div>
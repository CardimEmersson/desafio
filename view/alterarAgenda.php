<?php
    $mensagem = $_REQUEST['mensagem'];
    $agenda = $_REQUEST['alteraragenda'];
?>
<div class="d-flex align-items-center flex-column">

    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Alterar agenda</h3>
        <a href="?link=agendas&metodo=exibirAgendas" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
    </div>

    <?php if(!empty($mensagem)){ ?>
    <div class="alert alert-info" role="alert">
        <?php echo $mensagem; ?>
    </div>
    <?php } ?>

    <form action="?link=agendas&metodo=atualizarAgenda" method="post" enctype="multipart/form-data"
        class="w-75 d-flex flex-column mb-5">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $agenda->nome; ?>"
                    maxlength="100" required>
            </div>

            <div class="form-group col-md-6">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco"
                    value="<?php echo $agenda->endereco; ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="cidade" class="">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $agenda->Cidade; ?>"
                    required>
            </div>

            <div class="form-group col-md-2">
                <label for="uf">UF</label>
                <input type="text" class="form-control" id="uf" name="uf" value="<?php echo $agenda->UF; ?>" required>
            </div>

            <div class="form-group col-md-5">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" data-mask="00000-000"
                    value="<?php echo $agenda->CEP; ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $agenda->email; ?>"
                    required>
            </div>

            <div class="form-group col-md-6">
                <label for="fone">fone</label>
                <input type="tel" class="form-control" id="fone" name="fone" data-mask="(00) 00000-0000"
                    value="<?php echo $agenda->fone; ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="dia">dia</label>
                <input type="number" class="form-control" id="dia" name="dia" value="<?php echo $agenda->dia; ?>"
                    required data-mask="00">
            </div>

            <div class="form-group col-md-4">
                <label for="mes">mês</label>
                <input type="number" class="form-control" id="mes" name="mes" value="<?php echo $agenda->mes; ?>"
                    required data-mask="00">
            </div>
            <div class="form-group col-md-4">
                <label for="ano">ano</label>
                <input type="number" class="form-control" id="ano" name="ano" value="<?php echo $agenda->ano; ?>"
                    required data-mask="0000">
            </div>
        </div>

        <input type="hidden" id="codigo" name="codigo" value="<?php echo $agenda->cod; ?>">

        <button type="submit" class="btn btn-success btn-lg py-2 mx-5">Alterar</button>

    </form>

</div>
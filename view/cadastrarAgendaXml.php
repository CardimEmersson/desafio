<?php
    $mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">

  <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
    <h3 class="">Cadastrar XML agenda</h3>
    <a href="?link=agendas&metodo=exibirAgendas" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
  </div>

  <?php if(!empty($mensagem)){ ?>
  <div class="alert alert-info" role="alert">
    <?php echo $mensagem; ?>
  </div>
  <?php } ?>

  <form action="?link=agendas&metodo=criarXml" method="post" enctype="multipart/form-data"
    class="w-75 d-flex flex-column mb-5">

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" maxlength="100" required>
      </div>

      <div class="form-group col-md-6">
        <label for="endereco">Endereço</label>
        <input type="text" class="form-control" id="endereco" name="endereco" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="cidade" class="">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" required>
      </div>

      <div class="form-group col-md-2">
        <label for="uf">UF</label>
        <input type="text" class="form-control" id="uf" name="uf" required>
      </div>

      <div class="form-group col-md-5">
        <label for="cep">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" data-mask="00000-000" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="form-group col-md-6">
        <label for="fone">telefone</label>
        <input type="tel" class="form-control" id="fone" name="fone" data-mask="(00) 00000-0000" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="dia">Dia</label>
        <input type="number" class="form-control" id="dia" name="dia" required max="31" maxlength="2">
      </div>

      <div class="form-group col-md-4">
        <label for="mes">Mês</label>
        <input type="number" class="form-control" id="mes" name="mes" required max="12" maxlength="2">
      </div>
      <div class="form-group col-md-4">
        <label for="ano">Ano</label>
        <input type="number" class="form-control" id="ano" name="ano" required maxlength="4">
      </div>
    </div>

    <button type="submit" class="btn btn-success btn-lg py-2 mx-5">Cadastrar XML</button>

  </form>

</div>
<?php
    $categorias = $_REQUEST['categorias'];
    $mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">
    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Lista de Categorias</h3>
        <a href="?link=home" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
    </div>
    <?php if(!empty($mensagem)){ ?>
        <div class="alert alert-info" role="alert">
            <?php echo $mensagem; ?>
        </div> 
    <?php } ?>
    <div class="table-responsive-md w-50">

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria) { ?>
                    <tr class="align-bottom">
                        <td class="text-center align-middle"><?php echo $categoria->codigo; ?></td>
                        <td class="text-center align-middle"><?php echo $categoria->nome; ?></td>
                        <td class="d-flex justify-content-between">
                            <a href="?link=categorias&metodo=deletarCategoria&codigo=<?php echo $categoria->codigo; ?>" class="w-50 btn btn-danger my-1">Apagar</a>
                            <a href="?link=categorias&metodo=alterarCategoria&codigo=<?php echo $categoria->codigo; ?>" class="w-50 btn btn-info my-1 mx-1">Alterar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <a href="?link=categorias&metodo=criarCategoria" class="w-50 mb-5 py-3 btn btn-primary btn-lg">Nova categoria</a>
</div>


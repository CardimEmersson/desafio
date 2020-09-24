<?php
    $mensagem = $_REQUEST['mensagem'];
?>
<div class="d-flex align-items-center  flex-column">
    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Cadastrar categoria</h3>
        <a href="?link=categorias&metodo=exibirCategorias" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
        
    </div>
    <?php if(!empty($mensagem)){ ?>
        <div class="alert alert-info" role="alert">
            <?php echo $mensagem; ?>
        </div> 
    <?php } ?>
    <form action="?link=categorias&metodo=cadastrarCategoria" method="post" class="w-75 d-flex flex-column mb-5">
        <div class="form-row d-flex justify-content-center">
            <div class="form-group col-md-10 ">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" maxlength="100" required>
            </div>
            
        </div>
        
        <button type="submit" class="w-50 btn btn-success btn-lg py-2 mx-5 align-self-center">Cadastrar</button>
    </form>

</div>
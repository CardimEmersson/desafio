<?php
    $produtos = $_REQUEST['produtos'];
    $categorias = $_REQUEST['categorias'];
    $mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">
    
    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Lista de Produtos</h3>
        <a href="?link=home" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
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
                    <th>Preco</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Imagem do produto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto) { ?>
                    <tr class="align-bottom">
                        <td class="text-center align-middle"><?php echo $produto->codigo; ?></td>
                        <td class="text-center align-middle"><?php echo $produto->nome; ?></td>
                        <td class="text-center align-middle">R$<?php echo $produto->preco; ?></td>
                        <td class="text-center align-middle">
                            <p><?php echo $produto->descricao; ?></td></p>
                        <td class="text-center align-middle"><?php echo $produto->quantidade; ?></td>
                        <td class="text-center align-middle">
                            <?php
                                foreach($categorias as $categoria){
                                    if($produto->codigo == $categoria->codigo_produto) {
                                        echo $categoria->categoria;
                                        echo "<br>";
                                    }
                                }  
                            ?>
                        </td>
                        <td class="text-center align-middle">
                            
                            <img 
                                height=80 
                                width=100 
                                src="public/imagens/<?php echo $produto->url_imagem; ?>"
                            >
                        </td>
                        <td class="align-middle">
                            <a href="?link=produtos&metodo=deletarProduto&codigo=<?php echo $produto->codigo; ?>" class="w-100 btn btn-danger my-1">Apagar</a>
                            <a href="?link=produtos&metodo=alterarProduto&codigo=<?php echo $produto->codigo; ?>" class="w-100 btn btn-info my-1">Alterar</a>
                        </td>
                    </tr>
                    
                <?php } ?>
            </tbody>
        </table>
        
    </div>
    <a href="?link=produtos&metodo=criarProduto" class="mb-5 py-3 btn btn-primary btn-block">Novo produto</a>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Tem certeza que deseja excluir?
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <div class="modal-footer">
                                    <a href="?link=produtos&metodo=deletarProduto&codigo=<?php echo $produto->codigo; ?>" class="btn btn-block btn-danger" >Excluir</a>
                                </div>
                            </div>
                        </div>



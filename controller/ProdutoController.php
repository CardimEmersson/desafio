<?php
include_once 'model/Produto.php';
include_once 'utils/ValidarImagem.php';

class ProdutoController
{
    public $produto;

    public function __construct()
    {
        $this->produto = new Produto();
        $_REQUEST['mensagem'] = $this->produto->getMensagem();
    }

    public function exibirProdutos()
    {

        $produtos = $this->produto->listarTudo('produto');
        $categorias = $this->produto->listarCategorias();
        
        if(!empty($produtos) && !empty($categorias)){
            $_REQUEST['produtos'] = $produtos;
            $_REQUEST['categorias'] = $categorias;
        } else {
            $_REQUEST['produtos'] = array();
            $_REQUEST['categorias'] = array();
            $_REQUEST['mensagem'] = '';
        }
        
        require_once 'view/produtoView.php';
    }
    
    public function criarProduto()
    {
        $this->listarCategorias();

        include_once 'View/cadastrarProduto.php';
    }

    public function alterarProduto()
    {
        $this->listarCategorias();

        if (isset($_REQUEST['codigo'])) {

            $cadProduto = new Produto();

            $cadProduto = $this->produto->listar('*', 'produto', 'codigo', $_REQUEST['codigo']);
            $cadProdutoCategoria = $this->produto->buscarCategorias($_REQUEST['codigo']);
            
            $_REQUEST['alterarproduto'] = $cadProduto;
            $_REQUEST['alterarprodutocategoria'] = $cadProdutoCategoria;
        }
        include_once 'View/alterarProduto.php';
    }
    
    public function cadastrarProduto()
    {

        $novoProduto = $this->verificarCampos();

        if (!empty($novoProduto)) {
            $nome = $novoProduto->getNome();
            $imagem = $novoProduto->getImagem();
            $preco = $novoProduto->getPreco();
            $descricao = $novoProduto->getDescricao();
            $quantidade = $novoProduto->getQuantidade();
            $categorias = $novoProduto->getCategoria();

            $this->produto->inserir(
                "produto",
                "nome, url_imagem, preco, descricao, quantidade",
                "'$nome', '$imagem', '$preco', '$descricao', '$quantidade'"
            );

            $_REQUEST['mensagem'] = $this->produto->getMensagem();

            $chave = $this->produto->ultimoRegistro('codigo', 'produto');

            foreach ($categorias as $categoria) {
                $this->produto->inserir(
                    "produto_categoria",
                    "codigo_produto, codigo_categoria",
                    "'$chave->codigo', '$categoria'"
                );
            }

            $this->produto->inserir(
                'log_acoes',
                'codigo_tabela, tabela, descricao',
                "'$chave->codigo' ,'produto', 'inserção'"
            );

            
            $this->criarProduto();
        } else {
            //$_REQUEST['mensagem'] = "Houve um problema ao enviar o formulario!";
            $this->criarProduto();
        }
    }

    public function deletarProduto()
    {
        if (isset($_REQUEST['codigo'])) {
            $chave = $_REQUEST['codigo'];
            if ($this->deletarImagem($chave)) {

                $this->produto->excluir('produto_categoria', 'codigo_produto', $chave);

                $this->produto->excluir('produto', 'codigo', $chave);
                
                $_REQUEST['mensagem'] = $this->produto->getMensagem();

                $this->produto->inserir(
                    'log_acoes',
                    'codigo_tabela, tabela, descricao',
                    "'$chave' ,'produto', 'exclusão'"
                );
                
                $this->exibirProdutos();
            } else {
                $this->exibirProdutos();
            }
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar excluir o produto";
            $this->exibirProdutos();
        }
    }

    public function atualizarProduto()
    {
        if (isset($_POST['codigo'])) {
            $chave = $_POST['codigo'];
            if ($this->deletarImagem($chave)) {
                $this->produto->alterar('produto', "url_imagem = ''", 'codigo', $chave);
                $novoProduto = $this->verificarCampos();

                if (!empty($novoProduto)) {
                    $nome = $novoProduto->getNome();
                    $imagem = $novoProduto->getImagem();
                    $preco = $novoProduto->getPreco();
                    $descricao = $novoProduto->getDescricao();
                    $quantidade = $novoProduto->getQuantidade();

                    $categorias = $novoProduto->getCategoria();

                    $this->produto->alterar(
                        'produto',
                        "nome = '$nome', url_imagem = '$imagem', preco = '$preco', descricao = '$descricao', quantidade = '$quantidade'",
                        'codigo',
                        $chave
                    );
                    
                    $_REQUEST['mensagem'] = $this->produto->getMensagem();

                    $this->produto->excluir(
                        'produto_categoria',
                        'codigo_produto',
                        $chave
                    );

                    foreach ($categorias as $categoria) {
                        $this->produto->inserir(
                            "produto_categoria",
                            "codigo_produto, codigo_categoria",
                            "'$chave', '$categoria'"
                        );
                    }

                    $this->produto->inserir(
                        'log_acoes',
                        'codigo_tabela, tabela, descricao',
                        "'$chave' ,'produto', 'alteração'"
                    );

                    header("location: ?link=produtos&metodo=exibirProduto");
                    exit;
                } else {
                    $this->exibirProdutos();
                }
            } else {
                
                $this->exibirProdutos();
            }
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar alterar o produto";
            $this->exibirProdutos();
        }
    }
    //////////////////////////////////////
    private function listarCategorias()
    {
        $listaCategorias = $this->produto->listarTudo('categoria');
        if(!empty($listaCategorias)){
            $_REQUEST['listaCategorias'] = $listaCategorias;
        } else {
            $_REQUEST['listaCategorias'] = array();
            $_REQUEST['mensagem'] = $this->produto->getMensagem();
        }
    }

    private function verificarCampos()
    {
        if (isset($_POST['nome'])) {
            $nomeImagem = $this->verificarImagem($_FILES['arquivo']);
            
            if(empty($nomeImagem)){
                $_REQUEST["mensagem"] = $nomeImagem->getMensagem();
                return null;
            }

            $preco = $this->validaPreco($_POST['preco']);

            $novoProduto = new Produto();

            $novoProduto->setNome($_POST['nome']);
            $novoProduto->setImagem($nomeImagem);
            $novoProduto->setPreco($preco);
            $novoProduto->setDescricao($_POST['descricao']);
            $novoProduto->setQuantidade($_POST['quantidade']);
            $novoProduto->setCategoria($_POST['categoria']);

            return $novoProduto;

        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar alterar o produto";
            return null;
        }
    }

    private function verificarImagem($arquivo)
    {
        $imagem = $arquivo;
        $nomeImagem = $imagem['name'];

        $existe = $this->produto->listar('url_imagem', 'produto', 'url_imagem', "'$nomeImagem'");

        if (!$existe) {

            $up = new ValidarImagem();
            $nomeImagem = $up->uploadImagem($imagem);
            
            if ($nomeImagem) {
                return $nomeImagem;
            } else {
                $mensagem = $up->getMensagem();
                $_REQUEST['mensagem'] = $mensagem;
                return null;
            }
        } else {
            $_REQUEST['mensagem'] = "já existe imagem com esse nome!";
            return null;
        }
    }

    private function deletarImagem($codigo)
    {
        $imagem = $this->produto->listar('url_imagem', 'produto', 'codigo', $codigo);
        $nomeImagem = $imagem->url_imagem;
        $deletar = new ValidarImagem();
        
        if ($deletar->excluirImagem($nomeImagem)) {
            return true;
        } else {
            $_REQUEST['mensagem'] = "Não foi possível excluir a imagem da pasta!";
            return false;
        }
    }

    private function validaPreco($valor)
    {
        $verificaPonto = ".";
        if (strpos("[" . $valor . "]", "$verificaPonto")) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
        } else {
            $valor = str_replace(',', '.', $valor);
        }
        return $valor;
    }
}

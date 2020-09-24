<?php
    include_once 'model/Categoria.php';
    
    class CategoriaController
    {
        public $categoria;
        
        public function __construct()
        {
            $this->categoria = new Categoria();
            $_REQUEST['mensagem'] = $this->categoria->getMensagem();
        }

        public function exibirCategorias()
        {
            $categorias = $this->categoria->listarTudo('categoria');

            if(!empty($categorias)) {
                $_REQUEST['categorias'] = $categorias;
            } else {
                $_REQUEST['categorias'] = array();
                $_REQUEST['mensagem'] = $this->categoria->getMensagem();
            }

            require_once 'view/categoriaView.php';
        }
        
        public function criarCategoria()
        {
            include_once 'View/cadastrarCategoria.php';
        }

        public function alterarCategoria()
        {
            if(isset($_REQUEST['codigo'])) {

                $cadCategoria = new Categoria();
                $cadCategoria = $this->categoria->listar('*', 'categoria', 'codigo', $_REQUEST['codigo']);
                $_REQUEST['alterarcategoria'] = $cadCategoria;
            }
            include_once 'View/alterarCategoria.php';
        }

        public function cadastrarCategoria()
        {
            $novaCategoria = $this->verificarCampos();
            
            if(!empty($novaCategoria)) {
                $nome = $novaCategoria->getNome();
                
                $this->categoria->inserir(
                    "categoria",
                    "nome", 
                    "'$nome'"
                );
                
                $chave = $this->categoria->ultimoRegistro('codigo', 'categoria');

                $this->categoria->inserir(
                    'log_acoes',
                    'codigo_tabela, tabela, descricao',
                    "'$chave->codigo', 'categoria', 'inserção'"
                );
                
                $_REQUEST['mensagem'] = $this->categoria->getMensagem();
                $this->criarCategoria();

            } else {
                $_REQUEST['mensagem'] = "Houve um problema ao enviar o formulario!";
                $this->criarCategoria();
            }
        }

        public function deletarCategoria()
        {
            if(isset($_REQUEST['codigo'])) {
                $chave = $_REQUEST['codigo'];
                $this->categoria->excluir('produto_categoria', 'codigo_categoria', $chave);

                $this->categoria->excluir('categoria','codigo', $chave);
                
                $_REQUEST['mensagem'] = $this->categoria->getMensagem();
                
                $this->categoria->inserir(
                    'log_acoes',
                    'codigo_tabela, tabela, descricao',
                    "'$chave' ,'categoria', 'exclusão'"
                );
                
                $this->exibirCategorias();

            } else {
                $_REQUEST['mensagem'] = "Houve um problema ao tentar excluir a categoria";
                $this->exibirCategorias();
            }
        }

        public function atualizarCategoria()
        {
            if(isset($_POST['codigo'])) {
                $chave = $_POST['codigo'];
                $novaCategoria = $this->verificarCampos();
                if(!empty($novaCategoria)) {
                    $nome = $novaCategoria->getNome();
                    
                    $this->categoria->alterar(
                        'categoria',
                        "nome = '$nome'",
                        'codigo', 
                        $chave
                    );
                    $_REQUEST['mensagem'] = $this->categoria->getMensagem();

                    $this->categoria->inserir(
                        'log_acoes',
                        'codigo_tabela, tabela, descricao',
                        "'$chave', 'categoria', 'alteração'"
                    );
                
                    $this->exibirCategorias();

                } else {
                    $_REQUEST['mensagem'] = "Houve um problema ao enviar o formulario!";
                    $this->exibirCategorias();
                }

            } else {
                $_REQUEST['mensagem'] = "Houve um problema ao tentar alterar a categoria";
                $this->exibirCategorias();
            }
        }

        private function verificarCampos()
        {
            if(isset($_POST['nome'])) {
    
                $novaCategoria = new Categoria();

                $novaCategoria->setNome($_POST['nome']);
                
                return $novaCategoria;
                
            } else {
                return null;
            }
        }
    }

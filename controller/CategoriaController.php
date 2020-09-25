<?php
    /**
	 * <b>Categoria Controller:</b>
	 * Essa é uma classe que tem como objetivo realizar controle da categoria na aplicação.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    include_once 'model/Categoria.php';
    
    class CategoriaController
    {
        /**@var object Instância da classe categoria */
        public $categoria;
        
        public function __construct()
        {
            $this->categoria = new Categoria();
            $_REQUEST['mensagem'] = $this->categoria->getMensagem();
        }

        /**
        * <b>Exibir categorias:</b>
        * Realizará a chamada para página de exibição das categorias
        */
        public function exibirCategorias()
        {
            $categorias = $this->categoria->listarTudo('categoria');

            if(!empty($categorias)) {
                $_REQUEST['categorias'] = $categorias;
            } else {
                $_REQUEST['categorias'] = array();
                $_REQUEST['mensagem'] = '';
            }

            require_once 'view/categoriaView.php';
        }
        
        /**
         * <b>Criar categoria:</b>
         * Realizará a chamada para página de cadastro das categorias
         */
        public function criarCategoria()
        {
            include_once 'View/cadastrarCategoria.php';
        }

        /**
         * <b>Alterar categoria:</b>
         * Realizará a chamada para a página de alteração de uma determinada categoria
         */
        public function alterarCategoria()
        {
            if (isset($_REQUEST['codigo'])) {

                $cadCategoria = new Categoria();
                $cadCategoria = $this->categoria->listar('*', 'categoria', 'codigo', $_REQUEST['codigo']);
                $_REQUEST['alterarcategoria'] = $cadCategoria;
            }
            include_once 'View/alterarCategoria.php';
        }

        /**
         * <b>Cadastrar categoria:</b>
         * Realizará a chamada para cadastro dos dados da categoria enviada via formulario
         */
        public function cadastrarCategoria()
        {
            $novaCategoria = $this->verificarCampos();
            
            if (!empty($novaCategoria)) {
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

        /**
         * <b>Deletar categoria:</b>
         * Realizará a chamada para exclusão de um registro de categoria
         */
        public function deletarCategoria()
        {
            if (isset($_REQUEST['codigo'])) {
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

        /**
         * <b>Atualizar categoria:</b>
         * Realizará a chamada para alteração de um registro de categoria
         */
        public function atualizarCategoria()
        {
            if (isset($_POST['codigo'])) {
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

        /**
         * <b>Verificar campos:</b>
         * Realizará a validação das informações enviadas via formulario
         * @return Categoria $novaCategoria = objeto com os dados validados
         * @return null 
         */
        private function verificarCampos()
        {
            if (isset($_POST['nome'])) {
    
                $novaCategoria = new Categoria();

                $novaCategoria->setNome($_POST['nome']);
                
                return $novaCategoria;
                
            } else {
                return null;
            }
        }
    }

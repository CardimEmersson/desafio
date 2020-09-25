<?php
    /**
	 * <b>Controller:</b>
	 * Essa é uma classe que tem como objetivo realizar controle 
     * das requisições feitas pelo usuario na aplicação.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    include_once 'ProdutoController.php';
    include_once 'CategoriaController.php';
    include_once 'LogController.php';
    

    class Controller
    {
        /**@var object Instância da classe produtoController */
        private $produtoController;
        /**@var object Instância da classe categoriaController */
        private $categoriaController;
        /**@var object Instância da classe logController */
        private $logController;
        
        public function __construct()
        {
            $this->produtoController = new ProdutoController();
            $this->categoriaController = new CategoriaController();
            $this->logController = new LogController();
        }
        
        /**
         * <b>Home:</b>
         * Realizará a chamada para página inicial da aplicação
         */
        public function home()
        {
            require_once 'view/home.php';
        }

        /**
         * <b>Produtos:</b>
         * Realizará a chamada para página de exibição dos produtos e 
         * irá controlar as requisições referentes ao produto
         */
        public function produtos()
        {
            if (isset($_REQUEST["metodo"])){
                $metodo = $_REQUEST["metodo"];

                switch ($metodo) {
                    case 'criarProduto' :
                        $this->produtoController->criarProduto();
                    break;
                    case 'deletarProduto':
                        $this->produtoController->deletarProduto();
                        break;
                    case 'alterarProduto':
                        $this->produtoController->alterarProduto();
                        break;
                    case 'cadastrarProduto':
                        $this->produtoController->cadastrarProduto();
                    break;
                    case 'atualizarProduto':
                        $this->produtoController->atualizarProduto();
                    break;
                    case 'deletarProduto':
                        $this->produtoController->deletarProduto();
                    break;
                    default:
                        $this->produtoController->exibirProdutos();
                        break;
                }
            } else {
                $this->produtoController->exibirProdutos();
            }
        }

        /**
         * <b>Categorias:</b>
         * Realizará a chamada para página de exibição das categorias e 
         * irá controlar as requisições referentes a categoria
         */
        public function categorias()
        {
            if (isset($_REQUEST["metodo"])) {
                $metodo = $_REQUEST["metodo"];

                switch ($metodo) {
                    case 'criarCategoria' :
                        $this->categoriaController->criarCategoria();
                    break;
                    case 'deletarCategoria':
                        $this->categoriaController->deletarCategoria();
                        break;
                    case 'alterarCategoria':
                        $this->categoriaController->alterarCategoria();
                        break;
                        case 'cadastrarCategoria':
                            $this->categoriaController->cadastrarCategoria();
                        break;
                        case 'atualizarCategoria':
                            $this->categoriaController->atualizarCategoria();
                        break;
                        case 'deletarCategoria':
                            $this->categoriaController->deletarCategoria();
                        break;
                    default:
                        $this->categoriaController->exibirCategorias();
                        break;
                }
            } else {
                $this->categoriaController->exibirCategorias();
            }
        }

        /**
         * <b>Log:</b>
         * Realizará a chamada para página de exibição dos logs de ações
         */
        public function log()
        {
            if (isset($_REQUEST["metodo"])) {
                $metodo = $_REQUEST["metodo"];
                
                switch ($metodo) {
                    case 'exibirLogs':
                        $this->logController->exibirLogs();
                        break;
                }
            } else {
                $this->logController->exibirLogs();
            }

        }

    }

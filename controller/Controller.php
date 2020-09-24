<?php

    include_once 'ProdutoController.php';
    include_once 'CategoriaController.php';
    include_once 'LogController.php';
    

    class Controller
    {
        private $produtoController;
        private $categoriaController;
        private $logController;
        
        public function __construct()
        {
            $this->produtoController = new ProdutoController();
            $this->categoriaController = new CategoriaController();
            $this->logController = new LogController();
        }
        
        public function home()
        {
            require_once 'view/home.php';
        }

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

        public function categorias()
        {
            if (isset($_REQUEST["metodo"])){
                $metodo = $_REQUEST["metodo"];
            }
            if (isset($_REQUEST["metodo"])){
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

        public function log()
        {
            if (isset($_REQUEST["metodo"])){
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

<?php
    /**
	 * <b>Controller:</b>
	 * Essa é uma classe que tem como objetivo realizar controle 
     * das requisições feitas pelo usuario na aplicação.
	 * @author Emersson cardim
	 * @copyright (c) 2021, Emersson C. Mota
	 * @access public
	 * 
	 */
    include_once 'AgendaController.php';
    
    class Controller
    {
        /**@var object Instância da classe agendaController */
        private $agendaController;
        
        public function __construct()
        {
            $this->agendaController = new AgendaController();
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
         * <b>Agendas:</b>
         * Realizará a chamada para página de exibição das agendas e 
         * irá controlar as requisições referentes a agenda
         */
        public function agendas()
        {
            if (isset($_REQUEST["metodo"])){
                $metodo = $_REQUEST["metodo"];

                switch ($metodo) {
                    case 'criarAgenda' :
                        $this->agendaController->criarAgenda();
                    break;
                    case 'deletarAgenda':
                        $this->agendaController->deletarAgenda();
                        break;
                    case 'alterarAgenda':
                        $this->agendaController->alterarAgenda();
                        break;
                    case 'cadastrarAgenda':
                        $this->agendaController->cadastrarAgenda();
                    break;
                    case 'atualizarAgenda':
                        $this->agendaController->atualizarAgenda();
                    break;
                    case 'deletarAgenda':
                        $this->agendaController->deletarAgenda();
                    break;
                    case 'criarXml':
                        $this->agendaController->criarXml();
                    break;
                    case 'criarAgendaXml':
                        $this->agendaController->criarAgendaXml();
                    break;
                    default:
                        $this->agendaController->exibirAgendas();
                        break;
                }
            } else {
                $this->agendaController->exibirAgendas();
            }
        }

    }
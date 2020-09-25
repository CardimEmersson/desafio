<?php
 /**
	 * <b>Log Controller:</b>
	 * Essa é uma classe que tem como objetivo realizar a chamada para exibição dos 
     * registros da tabela log_ações
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    include_once 'model/Log.php';

    class LogController
    {
        /**@var object Instância da classe log */
        public $log;

        public function __construct()
        {
            $this->log = new Log();
            $_REQUEST['mensagem'] = $this->log->getMensagem();
        }

        /**
         * <b>Exibir logs:</b>
         * Realizará a chamada para listagem dos registros da tabela log_ações 
         * e exibirá na pagina de log
         */
        public function exibirLogs()
        {
            
            $logs = $this->log->listarLogs();

            if (!empty($logs)) {
                $_REQUEST['logs'] = $logs;
            } else {
                $_REQUEST['logs'] = array();
                $_REQUEST['mensagem'] = $this->log->getMensagem();
            }

            require_once 'view/logView.php';
        }

        
    }
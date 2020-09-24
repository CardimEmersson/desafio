<?php
    include_once 'model/Log.php';

    class LogController
    {
        public $log;

        public function __construct()
        {
            $this->log = new Log();
            $_REQUEST['mensagem'] = $this->log->getMensagem();
        }

        public function exibirLogs()
        {
            
            $logs = $this->log->listarTudo('log_acoes');

            if(!empty($logs)) {
                $_REQUEST['logs'] = $logs;
            } else {
                $_REQUEST['logs'] = array();
                $_REQUEST['mensagem'] = $this->log->getMensagem();
            }

            require_once 'view/logView.php';
        }

        
    }
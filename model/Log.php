<?php
    require_once 'Model.php';
    class Log extends Model
    {

        public $pdo;

        public function __construct()
        {
            try{
                $this->pdo = Conexao::getConexao();

            } catch (PDOException $e){
                $this->mensagem = $e->getMessage();
                die($this->mensagem);
            }
        }

    }

<?php
    /**
	 * <b>Log:</b>
	 * Essa é uma classe que tem como objetivo realizar o registro das ações de 
     * inserção, exclusão e alteração das tabelas produto e categoria no banco de dados, 
     * ela herda funções da classe pai chamada Model.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    require_once 'Model.php';
    class Log extends Model
    {
        /**@var object Instância da conexão */
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

         /**
         * <b>Listar logs:</b>
         * Realizará uma busca de todos os logs cadastrados em ordem decrescente
         * @return object Log das ações
         * @return null
         */
        public function listarLogs()
        {
            try {
                $sql = "SELECT * FROM log_acoes ORDER BY dia_hora DESC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $dados_recebidos = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $dados_recebidos;
            } catch (Exception $e) {
                $this->mensagem = $e->getMessage();
                return null;
            }
        }

    }

<?php
    /**
	 * <b>Agenda:</b>
	 * Essa é uma classe que tem como objetivo realizar a manipulação dos dados 
     * da tabela pessoa do banco de dados, ela herda funções da classe pai chamada Model.
	 * @author Emersson cardim
	 * @copyright (c) 2021, Emersson C. Mota
	 * @access public
	 * 
	 */
    require_once 'Model.php';
    class Agenda extends Model
    {
        /**@var string nome */
        private $nome;
        /**@var string endereco */
        private $endereco;
        /**@var string cidade */
        private $cidade;
        /**@var string UF */
        private $uf;
        /**@var string cep */
        private $cep;
        /**@var string email */
        private $email;
        /**@var string fone */
        private $fone;
        /**@var string dia */
        private $dia;
        /**@var string mes */
        private $mes;
        /**@var string ano */
        private $ano;

        /**@var object Instância da conexão */
        public $pdo;

        public function __construct()
        {
            try{
                $this->pdo = Conexao::getConexao();

            } catch (PDOException $e){
                $this->mensagem = $e->getMessage();
            }
        }

        /**@return string nome*/
        public function getNome()
        {
            return $this->nome;
        }
        /**@param string atribuir a variável nome*/
        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        /**@return string endereço*/
        public function getEndereco()
        {
            return $this->endereco;
        }
        /**@param string atribuir a variável endereco*/
        public function setEndereco($endereco)
        {
            $this->endereco = $endereco;
        }

        /**@return string cidade*/
        public function getCidade()
        {
            return $this->cidade;
        }
        /**@param string atribuir a variável cidade*/
        public function setCidade($cidade)
        {
            $this->cidade = $cidade;
        }
        
        /**@return string uf*/
        public function getUf()
        {
            return $this->uf;
        }
        /**@param string atribuir a variável uf*/
        public function setUf($uf)
        {
            $this->uf = $uf;
        }
       
        /**@return string cep*/
        public function getCep()
        {
            return $this->cep;
        }
        /**@param string atribuir a variável cep*/
        public function setCep($cep)
        {
            $this->cep = $cep;
        }

        /**@return string email*/
        public function getEmail()
        {
            return $this->email;
        }
        /**@param string atribuir a variável email*/
        public function setEmail($email)
        {
            $this->email = $email;
        }
        
        /**@return string telefone*/
        public function getFone()
        {
            return $this->fone;
        }
        /**@param string atribuir a variável telefone*/
        public function setFone($fone)
        {
            $this->fone = $fone;
        }
       
        /**@return string dia*/
        public function getDia()
        {
            return $this->dia;
        }
        /**@param string atribuir a variável dia*/
        public function setDia($dia)
        {
            $this->dia = $dia;
        }

        /**@return string mês*/
        public function getMes()
        {
            return $this->mes;
        }
        /**@param string atribuir a variável mês*/
        public function setmes($mes)
        {
            $this->mes = $mes;
        }
        
        /**@return string ano*/
        public function getAno()
        {
            return $this->ano;
        }
        /**@param string atribuir a variável ano*/
        public function setAno($ano)
        {
            $this->ano = $ano;
        }

    }
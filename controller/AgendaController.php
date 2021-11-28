<?php
    /**
	 * <b>Agenda Controller:</b>
	 * Essa é uma classe que tem como objetivo realizar controle da tabela agenda na aplicação.
	 * @author Emersson cardim
	 * @copyright (c) 2021, Emersson C. Mota
	 * @access public
	 * 
	 */
    require_once 'utils/ConexaoFtp.php';
    include_once 'model/Agenda.php';

    class AgendaController
    {
        /**@var object Instância da classe agenda */
        public $agenda;

        /**@var object Instância da classe ConexaoFTP */
        private $conexaoAgendaXml;

        public function __construct()
        {
            $this->agenda = new Agenda();
            $_REQUEST['mensagem'] = $this->agenda->getMensagem();
        }

        /**
         * <b>Exibir agendas:</b>
         * Realizará a chamada para página de exibição das agendas
         */
        public function exibirAgendas()
        {

            $agendas = $this->agenda->listarTudo('agenda');
            
            if (!empty($agendas)) {
                $_REQUEST['agendas'] = $agendas;
            } else {
                $_REQUEST['agendas'] = array();
                $_REQUEST['mensagem'] = '';
            }
            
            require_once 'view/agendaView.php';
        }
        
        /**
         * <b>Criar agenda:</b>
         * Realizará a chamada para página de cadastro de agenda
         */
        public function criarAgenda()
        {
            include_once 'View/cadastrarAgenda.php';
        }

        /**
         * <b>Criar agenda Xml:</b>
         * Realizará a chamada para página de cadastro de agenda Xml
         */
        public function criarAgendaXml()
        {
            include_once 'View/cadastrarAgendaXml.php';
        }

        /**
         * <b>Alterar agenda:</b>
         * Realizará a chamada para a página de alteração de uma determinada agenda
         */
        public function alterarAgenda()
        {
            if (isset($_REQUEST['codigo'])) {

                $agendaCadastrada = new Agenda();

                $agendaCadastrada = $this->agenda->listar('*', 'agenda', 'cod', $_REQUEST['codigo']);
                
                $_REQUEST['alteraragenda'] = $agendaCadastrada;
            }
            include_once 'View/alterarAgenda.php';
        }
        
        /**
         * <b>Cadastrar agenda:</b>
         * Realizará a chamada para cadastro dos dados da agenda enviada via formulario
         */
        public function cadastrarAgenda()
        {

            $novaAgenda = $this->verificarCampos();

            if (!empty($novaAgenda)) {
                $nome = $novaAgenda->getNome();
                $endereco = $novaAgenda->getEndereco();
                $cidade = $novaAgenda->getCidade();
                $uf = $novaAgenda->getUf();
                $cep = $novaAgenda->getCep();
                $email = $novaAgenda->getEmail();
                $fone = $novaAgenda->getFone();
                $dia = $novaAgenda->getDia();
                $mes = $novaAgenda->getMes();
                $ano = $novaAgenda->getAno();

                $this->agenda->inserir(
                    "agenda",
                    "nome, endereco, Cidade, UF, CEP, email, fone, dia, mes, ano",
                    "'$nome', '$endereco', '$cidade', '$uf', '$cep', '$email', '$fone', '$dia', '$mes', '$ano'"
                );

                $_REQUEST['mensagem'] = $this->agenda->getMensagem();
            } 

            $this->criarAgenda();
        }

        /**
         * <b>Deletar agenda:</b>
         * Realizará a chamada para exclusão de um registro de agenda
         */
        public function deletarAgenda()
        {
            if (isset($_REQUEST['codigo'])) {
                $chave = $_REQUEST['codigo'];
               
                $this->agenda->excluir('agenda', 'cod', $chave);
    
                $_REQUEST['mensagem'] = $this->agenda->getMensagem();
 
            } else {
                $_REQUEST['mensagem'] = "Houve um problema ao tentar excluir a agenda";
            }
            
            $this->exibirAgendas();
        }

        /**
         * <b>Atualizar agenda:</b>
         * Realizará a chamada para alteração de um registro de agenda
         */
        public function atualizarAgenda()
        {
            if (isset($_POST['codigo'])) {

                $chave = $_POST['codigo'];

                $novaAgenda = $this->verificarCampos();

                    if (!empty($novaAgenda)) {
                        $nome = $novaAgenda->getNome();
                        $endereco = $novaAgenda->getEndereco();
                        $cidade = $novaAgenda->getCidade();
                        $uf = $novaAgenda->getUf();
                        $cep = $novaAgenda->getCep();
                        $email = $novaAgenda->getEmail();
                        $fone = $novaAgenda->getFone();
                        $dia = $novaAgenda->getDia();
                        $mes = $novaAgenda->getMes();
                        $ano = $novaAgenda->getAno();


                        $this->agenda->alterar(
                            'agenda',
                            "nome = '$nome', endereco = '$endereco', Cidade = '$cidade', UF = '$uf', CEP = '$cep', email = '$email', fone = '$fone', dia = '$dia', mes = '$mes', ano = '$ano'", 'cod',
                            $chave
                        );
                        
                        $_REQUEST['mensagem'] = $this->agenda->getMensagem();

                        header("location: ?link=agendas&metodo=exibirAgenda");
                        exit;
                    }
            } else {
              $_REQUEST['mensagem'] = "Houve um problema ao tentar alterar a agenda";
            }
            $this->exibirAgendas();
        }
        
        /**
         * <b>Verificar campos:</b>
         * Realizará a validação das informações enviadas via formulario
         * @return Agenda $novaAgenda = objeto com os dados validados
         * @return null 
         */
        private function verificarCampos()
        {
            if (isset($_POST['nome'])) {
                $novaAgenda = new Agenda();

                $nome = $novaAgenda->getNome();
                $endereco = $novaAgenda->getEndereco();
                $cidade = $novaAgenda->getCidade();
                $uf = $novaAgenda->getUf();
                $cep = $novaAgenda->getCep();
                $email = $novaAgenda->getEmail();
                $fone = $novaAgenda->getFone();
                $dia = $novaAgenda->getDia();
                $mes = $novaAgenda->getMes();
                $ano = $novaAgenda->getAno();

                $novaAgenda->setNome($_POST['nome']);
                $novaAgenda->setEndereco($_POST['endereco']);
                $novaAgenda->setCidade($_POST['cidade']);
                $novaAgenda->setUf($_POST['uf']);
                $novaAgenda->setCep($_POST['cep']);
                $novaAgenda->setEmail($_POST['email']);
                $novaAgenda->setFone($_POST['fone']);
                $novaAgenda->setDia($_POST['dia']);
                $novaAgenda->setMes($_POST['mes']);
                $novaAgenda->setAno($_POST['ano']);

                return $novaAgenda;

            } else {
              return null;
            }
        }


        /**
         * <b>Cadastrar XML:</b>
         */

         public function criarXml() {

            $novaAgenda = $this->verificarCampos();

            if (!empty($novaAgenda)) {
                $nome = $novaAgenda->getNome();
                $endereco = $novaAgenda->getEndereco();
                $cidade = $novaAgenda->getCidade();
                $uf = $novaAgenda->getUf();
                $cep = $novaAgenda->getCep();
                $email = $novaAgenda->getEmail();
                $fone = $novaAgenda->getFone();
                $dia = $novaAgenda->getDia();
                $mes = $novaAgenda->getMes();
                $ano = $novaAgenda->getAno();
            
            
                $xml = '<?xml version="1.0" encoding="utf-8"?>';
$xml .= '<links>';

    $xml .= '<agenda>';
        $xml .= '<nome>'. $nome .'</nome>';
        $xml .= '<endereco>'. $endereco.'</endereco>';
        $xml .= '<cidade>'. $cidade.'</cidade>';
        $xml .= '<uf>'. $uf.'</uf>';
        $xml .= '<cep>'. $cep.'</cep>';
        $xml .= '<email>'. $email.'</email>';
        $xml .= '<fone>'. $fone.'</fone>';
        $xml .= '<nascimento>'. $dia.'/'.$mes.'/'.$ano.'</nascimento>';
        $xml .= '</agenda>';

    $xml .= '</links>';


$fp = fopen('emersson-cardim.xml', 'w+');
fwrite($fp, $xml);
fclose($fp);

$this->conexaoAgendaXml = new ConexaoFtp();

$_REQUEST['mensagem'] = "XML Cadastrado com sucesso!";
} else {
$_REQUEST['mensagem'] = "Houve um erro ao tentar criar o XML";
}

$this->criarAgendaXml();

}
}
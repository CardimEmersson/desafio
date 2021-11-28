<?php

	/**
	 * <b>Conexao:</b>
	 * Essa é uma classe que tem como objetivo realizar a conexão com o banco de dados.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
	class ConexaoFtp
	{
    public $ftp_con;

    public function __construct()
		{
      $ftp_con = ftp_connect('ftp.mps.kinghost.net');
      $login = ftp_login($ftp_con,'mps','ads2021');
      ftp_pasv($ftp_con, true);

      $file = 'C:\xampp\htdocs\sistemas-distribuidos\emersson-cardim.xml';

			var_dump($ftp_con);
			var_dump($login);

      ftp_put($ftp_con,"sds2021/emersson/xml/emersson-cardim.xml", $file, FTP_BINARY);
      ftp_close($ftp_con);
		}
  }
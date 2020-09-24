<?php
	class Conexao
	{

		public static $pdo;
		
		private function __construct()
		{

		}
		
		//Faz a conexão com o banco de dados
		public static function getConexao()
		{	
			if(!isset(self::$pdo)){
				try {
					self::$pdo = new PDO('mysql:host=localhost; dbname=desafio_iboss', 'root', ''); 
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$pdo->exec('set names utf8');
					return self::$pdo;
				} catch (PDOException $e) {
					die($e->getMessage());
				}
			} else {
				return self::$pdo;
			}				    	
		}
	}

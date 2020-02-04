<?php
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DB_NAME','guia_taubate');
	define('PORTS','3306');

	class Conexao{
		private static $conexao;

		private function __construct(){

		}

		public static function getConexao(){
			if(empty(self::$conexao)){
				try {
					self::$conexao = new PDO("mysql:host=".HOST.";dbname=".DB_NAME.";ports=".PORTS, USER,PASSWORD);
					self::$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				} catch (Exception $e) {
					$e->getMessage();
				}
			}

			return self::$conexao;
		}
	}

?>
<?php
include("config.php");
class connexion {
	
	static private $tabUTF8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
	
	static private $pdo;
	
	static public function pdo() { return self::$pdo; }
	
	static public function connect(){
		try{
			self::$pdo = new PDO("mysql:host=".HOSTNAME.";dbname=".DATABASE,LOGIN,PASSWORD,self::$tabUTF8);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			echo "erreur de connexion : ".$e->getMessage()."<br>";
		}
		
	}
	
}
?>


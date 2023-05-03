<?php
//fn de connexion Base de données
function getPDO(){
	
	try {
		
		$pdo = new PDO('mysql:host=localhost;dbname=c0vmsoft_db','c0cra7789','!atB7wTMdHBh');
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		
		return $pdo;
		
	}
	catch (PDOException $e){
		echo $e->getMessage();
	}

}
?>
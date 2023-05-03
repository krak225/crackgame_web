
		<?php
		//Copyright: Armand Kouassi (@krak225 , krak225@gmail.com, +225 08779408)
		//Fonction de connexion à la Base de données
		function getPDO(){		
			
			$pdo = new PDO("mysql:host=91.216.107.185;dbname=crakg1835031","crakg1835031","rc9f0v63ig");
			// $pdo = new PDO("mysql:host=localhost;dbname=crakg1835031","root","");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
			
			return $pdo;
		}

		?>

		
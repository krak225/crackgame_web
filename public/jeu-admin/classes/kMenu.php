
		<?php
		class kMenu{
			
		
			public $menu=array(
			//"index"=>"Accueil",
			"kw_administrateur"=>"Administrateurs",
			"users"=>"Users",
			"categorie"=>"Categorie",
			//"question"=>"Question utilisateurs",//question des utilisateurs
			"questiontest"=>"Question Test",
			"questionquiz"=>"Question Quiz",
			//"abonnement"=>"Abonnement",
			//"cagnotte"=>"Cagnotte",
			//"chap"=>"Chap",
			//"chap_score"=>"Chap_score",
			//"conversion"=>"Conversion",
			//"duel"=>"Duel",
			//"duel_jocker"=>"Duel_jocker",
			//"duel_question"=>"Duel_question",
			//"duel_score"=>"Duel_score",
			"defi"=>"Défi quiz",
			"quiz"=>"Quiz joués",
			"entrainement"=>"Tests joués",
			"depot"=>"Depot",
			"retrait"=>"Retrait",
			"souscription"=>"Souscription",
			//"langue"=>"Langue",
			//"pays"=>"Pays",
			);
			public $sousmenu=array(
			"index"=>"",
				"abonnement"=>array("Enregistrer un abonnement"=>array("editer"),
						"Afficher les abonnements"=>array("gerer"),
						),
				"avatar"=>array("Enregistrer un avatar"=>array("editer"),
						"Afficher les avatars"=>array("gerer"),
						),
				"cagnotte"=>array("Enregistrer une cagnotte"=>array("editer"),
						"Afficher les cagnottes"=>array("gerer"),
						),
				"defi"=>array("Enregistrer un défi"=>array("editer"),
						"Afficher les défis"=>array("gerer"),
						),
				"categorie"=>array("Enregistrer une categorie"=>array("editer"),
						"Afficher les categories"=>array("gerer"),
						),
				"chap"=>array("Enregistrer un chap"=>array("editer"),
						"Afficher les chaps"=>array("gerer"),
						),
				"chap_question"=>array("Enregistrer un chap_question"=>array("editer"),
						"Afficher les chap_questions"=>array("gerer"),
						),
				"chap_score"=>array("Enregistrer un chap_score"=>array("editer"),
						"Afficher les chap_scores"=>array("gerer"),
						),
				"conversion"=>array("Enregistrer une conversion"=>array("editer"),
						"Afficher les conversions"=>array("gerer"),
						),
				"depot"=>array("Enregistrer un depot"=>array("editer"),
						"Afficher les depots"=>array("gerer"),
						),
				"devise"=>array("Enregistrer un devise"=>array("editer"),
						"Afficher les devises"=>array("gerer"),
						),
				"duel"=>array("Enregistrer un duel"=>array("editer"),
						"Afficher les duels"=>array("gerer"),
						),
				"duel_jocker"=>array("Enregistrer un duel_jocker"=>array("editer"),
						"Afficher les duel_jockers"=>array("gerer"),
						),
				"duel_question"=>array("Enregistrer un duel_question"=>array("editer"),
						"Afficher les duel_questions"=>array("gerer"),
						),
				"duel_score"=>array("Enregistrer un duel_score"=>array("editer"),
						"Afficher les duel_scores"=>array("gerer"),
						),
				"entrainement"=>array(
						"Afficher les entrainements"=>array("gerer"),
						),
				"quiz"=>array(
						"Afficher les quiz joués"=>array("gerer"),
						),
				"jockerquestion"=>array("Enregistrer un jockerquestion"=>array("editer"),
						"Afficher les jockerquestions"=>array("gerer"),
						),
				"kw_administrateur"=>array("Enregistrer un administrateur"=>array("editer"),
						"Afficher les administrateurs"=>array("gerer"),
						),
				"langue"=>array("Enregistrer un langue"=>array("editer"),
						"Afficher les langues"=>array("gerer"),
						),
				"pays"=>array("Enregistrer un pays"=>array("editer"),
						"Afficher les payss"=>array("gerer"),
						),
				"question"=>array(
						// "Enregistrer une question"=>array("editer"),
						"Afficher les questions"=>array("gerer"),
						),
				"questiontest"=>array(
						"Enregistrer une question"=>array("editer"),
						"Afficher les questions"=>array("gerer"),
						),
				"questionquiz"=>array(
						"Enregistrer une question"=>array("editer"),
						"Afficher les questions"=>array("gerer"),
						),
				"retrait"=>array("Enregistrer un retrait"=>array("editer"),
						"Afficher les retraits"=>array("gerer"),
						),
				"souscription"=>array(
					//"Enregistrer un souscription"=>array("editer"),
						//"Afficher les souscriptions"=>array("gerer"),
						),
				"users"=>array("Enregistrer un users"=>array("editer"),
						"Afficher les userss"=>array("gerer"),
						),);
			//les pages sans label dans le menu
			public $nolabel=array("motdelafondatrice");
			//menu sans sous menu
			// public $nosoumenu=array("contact","motdelafondatrice");
			
			function hasSousmenu($menu){
				
				if(sizeof($this->sousmenu[$menu]) > 1){
					return true;
				}else{
					return false;
				}
			}
			
			function getMenuLabel($menu){
				return $this->menu[$menu];
			}
			
			function insertMenu(){
				foreach($this->menu as $url=>$label){
					if(!in_array($url,$this->nolabel)){
						$active = (getPage()==$url)? ' class="active" ' : null;
						print '<li><a href="'.$url.'.php" '.$active.'>'.$label.'</a></li>';
					}
				}
			}
			
			function insertSousMenu($menu){
				foreach($this->sousmenu[$menu] as $label=>$url){
					print '<li><a href="'.$menu.'.php?page='.$url[0].'">'.$label.'</a></li>';
				}
			}
			
			function getTitle(){
				return null;
			}
		
		}
	?>
		
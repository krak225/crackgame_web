<?php
require_once('../fonctions/fnDB.php');
require_once('../fonctions/fonctions.php');
require_once('../core/Model.php');


define('INTERNET',1);//Valeurs 1: en ligne, 0: hors ligne

define('ROOT',(INTERNET==1)? 'http://cracgame.com/demo/www.vmsoft.com' : 'http://cracgame.com/demo/www.vmsoft.com');

//UNE INSTANCE DU Model Pour l'interaction avec la Base de données
$db = new Model();
$pdo = $db->getPDO();



// $_GET['fn'] = 'loadAllInitialData';
// $_GET['utilisateur_id'] = '1';
// $_GET['data_prescripteur'] = '1';
// $_GET['data_centre_medical'] = '1';
// $_GET['data_date'] = '2017-12-31';
// $_GET['data_heure'] = '10:15';
// $_GET['data_statut'] = 'PROGRAMMEE';
// $_GET['visite_statut'] = 'PROGRAMMEE';

// $fp= fopen('POST.log','a+');
// $content = file_get_contents('php://input');
// fputs($fp,$content);
// fclose($fp);

// $body = $jsonData[0];
// $fp= fopen('body.log','a+');
// fputs($fp,$content);
// fclose($fp);


if(isset($_GET['fn'])){
	
	extract($_POST);
	extract($_GET);
	

	$tab = array();
	
	switch($fn){
		

		default:
		case 'connexionUtilisateur':
		
			$connectedUtilisateur = $db->connexionUtilisateur($utilisateur_login, $utilisateur_password);
			
			$listeUtilisateurs = array();
		
			if(!empty($connectedUtilisateur) ){
				
				foreach($connectedUtilisateur as $user){
					$listeUtilisateurs[] = 
						array('utilisateurId'=>$user->AK_UTILISATEUR_ID,
                        'utilisateurNomPrenoms'=>$user->AK_UTILISATEUR_NOM." ".$user->AK_UTILISATEUR_PRENOMS,
                        'utilisateurLogin'=>$user->AK_UTILISATEUR_LOGIN,
                        'utilisateurPassword'=>"",
                        'utilisateurSecteurId'=>$user->AK_UTILISATEUR_ID,
                        'utilisateurSecteurNom'=>$user->AK_UTILISATEUR_ID
						);
				}

			}else{
				
				$listeUtilisateurs[] = 
                    array('utilisateurId'=>"",
                        'utilisateurNomPrenoms'=>"",
                        'utilisateurLogin'=>"",
                        'utilisateurPassword'=>"",
                        'utilisateurSecteurId'=>"",
                        'utilisateurSecteurNom'=>""
						);
            
				
			}
			
			echo json_encode(array('listeUtilisateurs'=>$listeUtilisateurs));
			
		break;
			
		case 'getVisites':
			
			$visites = $db->getVisites($visite_statut, $utilisateur_id);
			$listeVisites = array();
		
            
			foreach($visites as $visite){
				 	 
				$listeVisites[] = 
                    array('visiteId'=>$visite->AK_VISITE_ID,
                        'visiteLibelle'=>$visite->AK_MEDECIN_NOM. " " .$visite->AK_MEDECIN_PRENOMS,
                        'visiteUtilisateurId'=>$visite->AK_UTILISATEUR_ID,
                        'visiteUtilisateurNomPrenoms'=>$visite->AK_VISITE_ID,
                        'visiteMedecinId'=>$visite->AK_MEDECIN_ID,
                        'visiteMedecinNomPrenoms'=>$visite->AK_MEDECIN_NOM. " " .$visite->AK_MEDECIN_PRENOMS,
                        'visiteCentreMedicalId'=>$visite->AK_CENTRE_MEDICAL_ID,
                        'visiteCentreMedicalNom'=>$visite->AK_CENTRE_MEDICAL_RAISON_SOCIALE,
                        'visiteDate'=>dateFromDB($visite->AK_VISITE_DATE),
                        'visiteHeure'=>str_replace(':',' H ',TimeFromDB($visite->AK_VISITE_HEURE)). ' ('.$visite->AK_VISITE_STATUT.')',
                        'visiteDateExecution'=>$visite->AK_VISITE_DATE_EXECUTION,
                        'visiteStatut'=>$visite->AK_VISITE_STATUT
						);
						
			}
			
			echo json_encode(array('listeVisites'=>$listeVisites));
			
		break;
		
		
		case 'addVisite':
			
		    $data_statut.="E";
			
			// die($data_statut);
			$data_date = dateToDB($data_date);
			
			$db->addVisite($utilisateur_id, $data_prescripteur, $data_centre_medical, $data_date, $data_heure, $data_statut);
			
			$listeVisites = array();
		
			$listeVisites[] = 
                    array('visiteId'=>"",
                        'visiteLibelle'=>"",
                        'visiteUtilisateurId'=>"",
                        'visiteUtilisateurNomPrenoms'=>"",
                        'visiteMedecinId'=>"",
                        'visiteMedecinNomPrenoms'=>"",
                        'visiteCentreMedicalId'=>"",
                        'visiteCentreMedicalNom'=>"",
                        'visiteDate'=>"",
                        'visiteHeure'=>"",
                        'visiteDateExecution'=>"",
                        'visiteStatut'=>""
						);
            
			
			echo json_encode(array('listeVisites'=>$listeVisites));
			
		break;
		
		
		case 'updateVisite':
			
			$db->updateVisite($visite_id, $utilisateur_id);
			
			$listeVisites = array();
		
			$listeVisites[] = 
                    array('visiteId'=>"",
                        'visiteLibelle'=>"",
                        'visiteUtilisateurId'=>"",
                        'visiteUtilisateurNomPrenoms'=>"",
                        'visiteMedecinId'=>"",
                        'visiteMedecinNomPrenoms'=>"",
                        'visiteCentreMedicalId'=>"",
                        'visiteCentreMedicalNom'=>"",
                        'visiteDate'=>"",
                        'visiteHeure'=>"",
                        'visiteDateExecution'=>"",
                        'visiteStatut'=>""
						);
            
			
			echo json_encode(array('listeVisites'=>$listeVisites));
			
		break;
		
		
		case 'saveProduitPresente':
			
			$db->saveProduitPresente($utilisateur_id, $visite_id, $produit_id, $efficacite, $tolerance, $observance, $prix);
			
			$listeVisites = array();
		
			$listeVisites[] = 
                    array('visiteId'=>"",
                        'visiteLibelle'=>"",
                        'visiteUtilisateurId'=>"",
                        'visiteUtilisateurNomPrenoms'=>"",
                        'visiteMedecinId'=>"",
                        'visiteMedecinNomPrenoms'=>"",
                        'visiteCentreMedicalId'=>"",
                        'visiteCentreMedicalNom'=>"",
                        'visiteDate'=>"",
                        'visiteHeure'=>"",
                        'visiteDateExecution'=>"",
                        'visiteStatut'=>""
						);
            
			
			echo json_encode(array('listeVisites'=>$listeVisites));
			
		break;
		
		
		case 'saveCadeau':
			
			$db->saveCadeau($utilisateur_id, $visite_id, $cadeau_libelle, $cadeau_type);
			
			$listeVisites = array();
		
			$listeVisites[] = 
                    array('visiteId'=>"",
                        'visiteLibelle'=>"",
                        'visiteUtilisateurId'=>"",
                        'visiteUtilisateurNomPrenoms'=>"",
                        'visiteMedecinId'=>"",
                        'visiteMedecinNomPrenoms'=>"",
                        'visiteCentreMedicalId'=>"",
                        'visiteCentreMedicalNom'=>"",
                        'visiteDate'=>"",
                        'visiteHeure'=>"",
                        'visiteDateExecution'=>"",
                        'visiteStatut'=>""
						);
            
			
			echo json_encode(array('listeVisites'=>$listeVisites));
			
		break;
		
		
		case 'deleteData':
					
		// $fp= fopen('sql.sql','a+');
		// fputs($fp,$sql);
		// fclose($fp);

			$db->deleteData($sql);
			
			$listeVisites = array();
		
			$listeVisites[] = 
                    array('visiteId'=>"",
                        'visiteLibelle'=>"",
                        'visiteUtilisateurId'=>"",
                        'visiteUtilisateurNomPrenoms'=>"",
                        'visiteMedecinId'=>"",
                        'visiteMedecinNomPrenoms'=>"",
                        'visiteCentreMedicalId'=>"",
                        'visiteCentreMedicalNom'=>"",
                        'visiteDate'=>"",
                        'visiteHeure'=>"",
                        'visiteDateExecution'=>"",
                        'visiteStatut'=>""
						);
            
			
			echo json_encode(array('listeVisites'=>$listeVisites));
			
		break;
		
		
		
		case 'getPrescripteurs':
			
			$prescripteurs = $db->getPrescripteurs();
			$listePrescripteurs = array();
			
			foreach($prescripteurs as $prescripteur){
				 	 
				$listePrescripteurs[] =
                    array('prescripteurId'=>$prescripteur->AK_MEDECIN_ID,
                        'prescripteurNomPrenoms'=>$prescripteur->AK_MEDECIN_NOM. " " .$prescripteur->AK_MEDECIN_PRENOMS,
                        'prescripteurType'=>"MEDECIN",
                        'prescripteurSpecialite'=>$prescripteur->AK_SPECIALITE_LIBELLE,
                        'prescripteurTelephone'=>$prescripteur->AK_MEDECIN_TELEPHONE,
                        'prescripteurEmail'=>$prescripteur->AK_MEDECIN_EMAIL
                        );
						
			}
			
			
			echo json_encode(array('listePrescripteurs'=>$listePrescripteurs));
			
		break;
		
		
		
		case 'getCentresMedicaux':
			
			$centres_medicaux = $db->getCentresMedicaux();
			$listeCentreMedicaux = array();
			
			foreach($centres_medicaux as $centre_medical){
				 	 
				$listeCentreMedicaux[] = 
                    array('centreMedicalId'=>$centre_medical->AK_CENTRE_MEDICAL_ID,
                        'centreMedicalNom'=>$centre_medical->AK_CENTRE_MEDICAL_RAISON_SOCIALE,
                        'centreMedicalLocalisation'=>$centre_medical->AK_CENTRE_MEDICAL_LOCALISATION,
                        'centreMedicalTelephone'=>$centre_medical->AK_CENTRE_MEDICAL_REPRESENTANT_TELEPHONE_MOBILE
                        );
						
			}
			
			echo json_encode(array('listeCentreMedicaux'=>$listeCentreMedicaux));
			
		break;
		
				
		case 'getProduits':
			
			$produits = $db->getProduits();
			$listeProduits = array();
			foreach($produits as $produit){
				 	 
				$listeProduits[] = 
                    array('produitId'=>$produit->AK_PRODUIT_ID,
                        'produitNom'=>$produit->AK_PRODUIT_NOM,
                        );
						
			}
			
			echo json_encode(array('listeProduits'=>$listeProduits));
			
		break;
			
		case 'getProduitsPresentes':
			
			$produits = $db->getProduitsPresentes($visite_id);
			$listeProduitsPresentes = array();
			
			foreach($produits as $produit){
				 	 
				$listeProduitsPresentes[] = 
                    array('visiteId'=>$produit->AK_VISITE_ID,
						'produitId'=>$produit->AK_PRODUIT_ID,
                        'produitNom'=>$produit->AK_PRODUIT_NOM,
                        'Efficacite'=>$produit->AK_PRODUIT_PRESENTE_AVIS_EFFICACITE,
                        'Tolerance'=>$produit->AK_PRODUIT_PRESENTE_AVIS_TOLERANCE,
                        'Observance'=>$produit->AK_PRODUIT_PRESENTE_AVIS_OBSERVANCE,
                        'Prix'=>$produit->AK_PRODUIT_PRESENTE_AVIS_PRIX
                        );
						
			}
			
			echo json_encode(array('listeProduitsPresentes'=>$listeProduitsPresentes));
			
		break;
		
		
		case 'getCadeauxDistribues':
		
			$cadeaux = $db->getCadeauxDistribues($visite_id);
			$listeCadeaux = array();
			
			
			foreach($cadeaux as $cadeau){
				 	 
				$listeCadeaux[] = 
                    array(
						'cadeauId'=>$cadeau->AK_CADEAUDISTRIBUE_ID,
						'visiteId'=>$cadeau->AK_VISITE_ID,
                        'cadeauLibelle'=>$cadeau->AK_CADEAU_LIBELLE,
                        'cadeauType'=>$cadeau->AK_CADEAU_TYPE,
                        );
						
			}
			
			
			echo json_encode(array('listeCadeaux'=>$listeCadeaux));
			

		break;
		
		
		
		case 'loadAllInitialData'://NE MARCHE PAS
		
			/* 
			$visites = $db->getVisites($data_statut, $utilisateur_id);
			$listeVisites = array();
		
			
			foreach($visites as $visite){
					 
				$listeVisites[] = 
					array('visiteId'=>$visite->AK_VISITE_ID,
						'visiteLibelle'=>$visite->AK_MEDECIN_NOM. " " .$visite->AK_MEDECIN_PRENOMS,
						'visiteUtilisateurId'=>$visite->AK_UTILISATEUR_ID,
						'visiteUtilisateurNomPrenoms'=>$visite->AK_VISITE_ID,
						'visiteMedecinId'=>$visite->AK_MEDECIN_ID,
						'visiteMedecinNomPrenoms'=>$visite->AK_MEDECIN_NOM. " " .$visite->AK_MEDECIN_PRENOMS,
						'visiteCentreMedicalId'=>$visite->AK_CENTRE_MEDICAL_ID,
						'visiteCentreMedicalNom'=>$visite->AK_CENTRE_MEDICAL_RAISON_SOCIALE,
						'visiteDate'=>dateFromDB($visite->AK_VISITE_DATE),
						'visiteHeure'=>str_replace(':',' H ',TimeFromDB($visite->AK_VISITE_HEURE)). ' ('.$visite->AK_VISITE_STATUT.')',
						'visiteDateExecution'=>$visite->AK_VISITE_DATE_EXECUTION,
						'visiteStatut'=>$visite->AK_VISITE_STATUT
						);
						
			}
			
			
			//
			$prescripteurs = $db->getPrescripteurs();
			$listePrescripteurs = array();
			
			foreach($prescripteurs as $prescripteur){
				 	 
				$listePrescripteurs[] = 
                    array('prescripteurId'=>$prescripteur->AK_MEDECIN_ID,
                        'prescripteurNomPrenoms'=>$prescripteur->AK_MEDECIN_NOM. " " .$prescripteur->AK_MEDECIN_PRENOMS,
                        'prescripteurType'=>"MEDECIN",
                        'prescripteurSpecialite'=>$prescripteur->AK_SPECIALITE_LIBELLE,
                        'prescripteurTelephone'=>$prescripteur->AK_MEDECIN_TELEPHONE,
                        'prescripteurEmail'=>$prescripteur->AK_MEDECIN_EMAIL
                        );
						
			}
			
			//
			$centres_medicaux = $db->getCentreMedicaux();
			$listeCentreMedicaux = array();
			
			foreach($centres_medicaux as $centre_medical){
				 	 
				$listeCentreMedicaux[] = 
                    array('centreMedicalId'=>$centre_medical->AK_CENTRE_MEDICAL_ID,
                        'centreMedicalNom'=>$centre_medical->AK_CENTRE_MEDICAL_RAISON_SOCIALE,
                        );
						
			}
			
			
			$json_encode = json_encode(array(
			array('listeVisites'=>$listeVisites),
			array('listePrescripteurs'=>$listePrescripteurs),
			array('listeCentreMedicaux'=>$listeCentreMedicaux)));
		
			$json_encode = JsonArray2JsonObject($json_encode);
			
			
			echo $json_encode;
			
			 */
		break;
		
		
		//SYNCHRONISATION
		case 'makeSynchronisation':
			$json = json_decode(file_get_contents('php://input'));
			$listeVisites = $json->listeVisites;
			
			$i = 0;
			foreach($listeVisites as $visite){
				
				// $visite_id			    =	$visite->visiteId;;
				$utilisateur_id     	=	$visite->visiteUtilisateurId;
				$data_prescripteur  	=	$visite->visiteMedecinId;
				$data_centre_medical	=	$visite->visiteCentreMedicalId;
				$data_date				=	$visite->visiteDate;
				$data_heure				=	$visite->visiteHeure;
				$data_statut			=	$visite->visiteStatut.'E';
				
				$lastId = $db->addVisite($utilisateur_id, $data_prescripteur, $data_centre_medical, $data_date, $data_heure, $data_statut);
				
				//Sauvegarger les produits presenté
				
				
			}
			
			$listeVisites = array();
		
			$listeVisites[] = 
                    array('visiteId'=>"",
                        'visiteLibelle'=>"",
                        'visiteUtilisateurId'=>"",
                        'visiteUtilisateurNomPrenoms'=>"",
                        'visiteMedecinId'=>"",
                        'visiteMedecinNomPrenoms'=>"",
                        'visiteCentreMedicalId'=>"",
                        'visiteCentreMedicalNom'=>"",
                        'visiteDate'=>"",
                        'visiteHeure'=>"",
                        'visiteDateExecution'=>"",
                        'visiteStatut'=>""
						);
            
			
			echo json_encode(array('listeVisites'=>$listeVisites));
			
			
		break;
		
		
	}
	
	
}


?>
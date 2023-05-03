<?php

class Model{
	
	
	private $pdo;
	
	public function __construct(){
		$this->pdo = getPDO();
	}
	
	public function getPdo(){
		return $this->pdo;
	}
	
	//CONNEXION utilisateur
	function connexionUtilisateur($utilisateur_login,$utilisateur_password){
		
		$sql = 'SELECT *  FROM utilisateurs
		inner join profil using(AK_PROFIL_UTILISATEUR_ID)
		WHERE AK_UTILISATEUR_LOGIN= ?
		AND  AK_UTILISATEUR_PASSWORD= ?
		AND AK_UTILISATEUR_STATUT= ?';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($utilisateur_login, $utilisateur_password,"VALIDE"));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		foreach($data as $d){
			
			if(file_exists(ROOT."/images/upload-utilisateur/".$d->AK_UTILISATEUR_PHOTO) 
				&& isImage(ROOT."/images/upload-utilisateur/".$d->AK_UTILISATEUR_PHOTO)
				&& !empty($d->AK_UTILISATEUR_PHOTO)
			){
				$d->AK_UTILISATEUR_PHOTO = ROOT."/images/upload-utilisateur/".$d->AK_UTILISATEUR_PHOTO;
			}else{
				$d->AK_UTILISATEUR_PHOTO = ROOT."/images/upload-utilisateur/user.png";
			}
			
		}
		
		return $data;
	
	}
	
	
	//RECCUPERER LES VISITES
	public function getVisites($utilisateur_id, $visite_statut){
		$sql = 'SELECT * FROM visites
		inner join medecins using(AK_MEDECIN_ID)
		inner join hopitals using(AK_CENTRE_MEDICAL_ID)
		WHERE AK_VISITE_STATUT= ? AND AK_UTILISATEUR_ID = ? ';
		
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($utilisateur_id, $visite_statut));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
		
	}
	
	//AJOUTER UNE VISITE
	public function addVisite($utilisateur_id, $data_prescripteur, $data_centre_medical, $data_date, $data_heure, $data_statut){
		
		$sql = 'INSERT INTO `visites` (`AK_VISITE_ID`, `AK_UTILISATEUR_ID`, `AK_MEDECIN_ID`, `AK_CENTRE_MEDICAL_ID`, `AK_VISITE_DATE`, `AK_VISITE_HEURE`, `AK_VISITE_STATUT`, `created_at`, `updated_at`) 
			VALUES (NULL, 
			"'.$utilisateur_id.'",
			"'.$data_prescripteur.'", 
			"'.$data_centre_medical.'",
			"'.$data_date.'",
			"'.$data_heure.'",
			"'.$data_statut.'",
			"'.date('Y-m-d H:i:s').'",
			"'.date('Y-m-d H:i:s').'")';
			
		// $this->pdo->exec($sql);
		
		
		$reponse = $this->insertDb($sql);
		$lastId  = $reponse->lastId;
		
		return $lastId;
		
	}
	
	
	//UPDATE UNE VISITE
	public function updateVisite($visite_id, $utilisateur_id){
		$sql = 'UPDATE `visites`
			SET AK_VISITE_STATUT="EFFECTUEE"
			WHERE AK_VISITE_ID = "'.$visite_id.'" AND AK_UTILISATEUR_ID = "'.$utilisateur_id.'"';
			
		$this->pdo->exec($sql);
		
	}
	
	
	//AJOUTER UN PRODUIT PRESENTE
	public function saveProduitPresente($utilisateur_id, $visite_id, $produit_id, $efficacite, $tolerance, $observance, $prix){
		
		$sql = 'INSERT INTO `produitspresentes` (`AK_PRODUIT_ID`, `AK_VISITE_ID`, `AK_PRODUIT_PRESENTE_AVIS_EFFICACITE`, `AK_PRODUIT_PRESENTE_AVIS_TOLERANCE`, `AK_PRODUIT_PRESENTE_AVIS_OBSERVANCE`, `AK_PRODUIT_PRESENTE_AVIS_PRIX`) 
		VALUES ("'.$produit_id.'", "'.$visite_id.'", "'.$efficacite.'", "'.$tolerance.'", "'.$observance.'", "'.$prix.'")';
			
		$this->insertDb($sql);
		
	}
	
	
	//AJOUTER UN CADEAU
	public function saveCadeau($utilisateur_id, $visite_id, $cadeau_libelle, $cadeau_type){
		
		$sql = 'INSERT INTO `cadeaudistribue` (`AK_VISITE_ID`, `AK_CADEAU_LIBELLE`, `AK_CADEAU_TYPE`) 
		VALUES ("'.$visite_id.'", "'.$cadeau_libelle.'", "'.$cadeau_type.'")';
			
		
		$this->insertDb($sql);
		
	}
	
	
	//AJOUTER UN CADEAU
	public function deleteData($sql){
		
$fp= fopen('sql.sql','a+');
fputs($fp,$sql);
fclose($fp);

		$this->pdo->exec($sql);
			
		
	}
	
	//RECCUPERER LES PRESCRIPTEURS
	public function getPrescripteurs(){
		
		$sql = 'SELECT * FROM medecins
		inner join specialites using(AK_SPECIALITE_ID)';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		
		return $data;
		
	}
	
	//RECCUPERER LES CENTRES MEDICAUX
	public function getCentresMedicaux(){
		$sql = 'SELECT * FROM hopitals ';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
		
	}
	
	//RECCUPERER LES PRODUITS
	public function getProduits(){
		$sql = 'SELECT * FROM produits ';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
		
	}
	
	//RECCUPERER LES PRODUITS PRESENTES LORS D'UNE VISITE
	public function getProduitsPresentes($visite_id){
		$sql = 'SELECT * 
		FROM produitspresentes
		INNER JOIN produits USING(AK_PRODUIT_ID)
		WHERE AK_VISITE_ID="'.$visite_id.'"';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
		
	}
	
	
	//RECCUPERER LES CADEAUX DISTRIBUES LORS D'UNE VISITE
	public function getCadeauxDistribues($visite_id){
		$sql = 'SELECT * 
		FROM cadeaudistribue
		WHERE AK_VISITE_ID="'.$visite_id.'"';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
		
	}
	
	
	//PERMET D'INSERER DES DES DONNEES DANS UNE TABLE
	function insertDb($sql){
		$out = new stdClass();
		$out->statut = 0;
		$out->lastId = null;
		try{
			// $this->pdo->exec($sql);
			if($this->pdo->exec($sql)){
				$lastId = $this->pdo->lastInsertId();
				$out->statut = 1;
				$out->lastId = $lastId;
			}else{
				$error= $this->pdo->errorInfo();//debug($error);
				$out->statut = 0;
				$out->exception = $error[2];
			}
		}catch(Exception $ex){
			$out->statut = 0;
			$out->exception = $ex->getMessage();
			$out->lastId = "undefined";
		}
		// debug($out);

		return $out;
	}
	
	//PERMET DE METTRE A JOUR DES DES DONNEES DANS UNE TABLE
	function updateDB($sql){//debug($sql);
		$out = new stdClass();
		try{
			if($this->pdo->exec($sql)){
				$out->statut = 1;
			}else{
				$error= $this->pdo->errorInfo();//debug($error);
				$out->statut = 0;
				$out->exception = $error[2];
			}
		}catch(Exception $ex){
			$out->statut = 0;
			$out->exception = $ex->getMessage();
		}
		// debug($out);
		return $out;
	}
	
	
	
	function rowCount($sql){
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		return $stm->rowCount();
		
	}
	
	
}

?>
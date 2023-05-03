<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN CHAP</div>
			<div class="blocContent" style="margin-top:5px;padding:0px;">
				<div class="krakModule">

		<div id="article-editer" class="module editeMsg" style="padding:0px;">
		
<?php
//Page générée automatiquement par quickApp V 2.0 :(Copyright: Armand Kouassi, @krak225, krak225@gmail.com, +225 08779408), le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Valider</b> </div>';
		$user_id=1;$chap_participants=null;$chap_vainqueur_id=null;$chap_date_debut=date('Y-m-d H:i:s');$chap_date_creation=date('Y-m-d H:i:s');;
		//debug($_SESSION["adminInfos"]);
		$libelles=array("User","Participants","Vainqueur","Date début","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-chap/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$chap_participants= securisedData($chap_participants);
			$chap_vainqueur_id= securisedData($chap_vainqueur_id);
			$chap_date_debut= securisedData($chap_date_debut);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `chap` (user_id,chap_participants,chap_etape,chap_date_debut,chap_date_creation,chap_statut) 
				VALUES ("'.$user_id.'",0,1,"'.$chap_date_debut.'","'.$chap_date_creation.'","EN COURS")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$chap_participants=null;$chap_vainqueur_id=null;$chap_date_debut=null;$chap_date_creation=null;
				}
				else{
					$info='<div class="echec">Désolé!! enregistrement non effectué .</div>'. mysql_error();
				}		
			}
			else
			{  
				$info='<div class="echec">Attemtion!! erreurs dans le formulaire</div>'; 
			}
		}
	?>

	<div class="info"><?php print $info;?></div>
	<form id="form-chap" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
	<label>Date début</label>
	<input class="champ" type="datetime" name="chap_date_debut" id="chap_date_debut" value="<?php print $chap_date_debut;?>" />
	<span class="erreur"><?php print $x->erreurs['Date début'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

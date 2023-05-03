<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN CHAP</div>
			<div class="blocContent" style="margin-top:5px;padding:0px;">
				<div class="krakModule">

		<div id="article-editer" class="module editeMsg" style="padding:0px;">

<?php
if(isset($_GET["id"]) and is_numeric($_GET["id"])){
	$id=$_GET["id"];
	
	$sql='select * from chap
	where chap_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$user_id=stripcslashes($d->user_id);$chap_participants=stripcslashes($d->chap_participants);$chap_vainqueur_id=stripcslashes($d->chap_vainqueur_id);$chap_date_debut=stripcslashes($d->chap_date_debut);
		
			
		$libelles=array("User","Participants","Vainqueur","Date debut","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-chap/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$chap_participants= securisedData($chap_participants);
			$chap_vainqueur_id= securisedData($chap_vainqueur_id);
			$chap_date_debut= securisedData($chap_date_debut);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `chap` SET user_id = "'.$user_id.'",chap_participants = "'.$chap_participants.'",chap_date_debut = "'.$chap_date_debut.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE chap_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$chap_participants=null;$chap_vainqueur_id=null;$chap_date_debut=null;
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
		<label>User</label>
	<select class="champ" name="user_id" id="user_id">
					<option value=""></option>
					<?php 
					$sql='select * from user';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->user_id==$user_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->user_id.'">'.$d->user_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['User'];?></span><br/>
	<label>Participants</label>
	<input class="champ" type="text" name="chap_participants" id="chap_participants" value="<?php print $chap_participants;?>"/>
	<span class="erreur"><?php print $x->erreurs['Participants'];?></span><br/>
	<label>Vainqueur</label>
	<select class="champ" name="chap_vainqueur_id" id="chap_vainqueur_id">
					<option value=""></option>
					<?php 
					$sql='select * from chap_vainqueur';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->chap_vainqueur_id==$chap_vainqueur_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->chap_vainqueur_id.'">'.$d->chap_vainqueur_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Vainqueur'];?></span><br/>
	<label>Date debut</label>
	<input class="champ" type="text" name="chap_date_debut" id="chap_date_debut" value="<?php print $chap_date_debut;?>"/>
	<span class="erreur"><?php print $x->erreurs['Date debut'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
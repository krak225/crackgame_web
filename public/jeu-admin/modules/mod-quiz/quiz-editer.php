<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN ENTRAINEMENT</div>
			<div class="blocContent" style="margin-top:5px;padding:0px;">
				<div class="krakModule">

		<div id="article-editer" class="module editeMsg" style="padding:0px;">
		<script type="text/javascript">
			<!--
			$("document").ready(function(){
				$(".wysiwyg").wysiwyg();	
				$(".wysiwyg").css({width:"100%"});
				//
			});
			-->
		</script>
		
<?php
//Page générée automatiquement par quickApp V 2.0 :(Copyright: Armand Kouassi, @krak225, krak225@gmail.com, +225 08779408), le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Valider</b> </div>';
		$user_id=null;$categorie_id=null;$entrainement_score=null;$entrainement_compteur_question=null;$entrainement_date=null;
		
		$libelles=array("User","Categorie","Score","Compteur question","Date","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-entrainement/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$categorie_id= securisedData($categorie_id);
			$entrainement_score= securisedData($entrainement_score);
			$entrainement_compteur_question= securisedData($entrainement_compteur_question);
			$entrainement_date= securisedData($entrainement_date);
			
				$x->verifierNombre($user_id,"User",0,100000000000000000000000,1);
				$x->verifierNombre($categorie_id,"Categorie",0,100000000000000000000000,1);
				$x->verifierNombre($entrainement_score,"Score",0,100000000000000000000000,1);
				$x->verifierNombre($entrainement_compteur_question,"Compteur question",0,100000000000000000000000,1);
			
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `entrainement` (user_id,categorie_id,entrainement_score,entrainement_compteur_question,entrainement_date) 
				VALUES ("'.$user_id.'","'.$categorie_id.'","'.$entrainement_score.'","'.$entrainement_compteur_question.'","'.$entrainement_date.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$categorie_id=null;$entrainement_score=null;$entrainement_compteur_question=null;$entrainement_date=null;
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
	<form id="form-entrainement" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>User</label>
	<select class="champ" name="user_id" id="user_id">
					<option value=""></option>
					<?php 
					$sql='select * from user';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->user_id==$user_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->user_id.'">'.$d->user_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['User'];?></span><br/>
	<label>Categorie</label>
	<select class="champ" name="categorie_id" id="categorie_id">
					<option value=""></option>
					<?php 
					$sql='select * from categorie';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->categorie_id==$categorie_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->categorie_id.'">'.$d->categorie_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Categorie'];?></span><br/>
	<label>Score</label>
	<input class="champ" type="text" name="entrainement_score" id="entrainement_score" value="<?php print $entrainement_score;?>"/>
	<span class="erreur"><?php print $x->erreurs['Score'];?></span><br/>
	<label>Compteur question</label>
	<input class="champ" type="text" name="entrainement_compteur_question" id="entrainement_compteur_question" value="<?php print $entrainement_compteur_question;?>"/>
	<span class="erreur"><?php print $x->erreurs['Compteur question'];?></span><br/>
	<label>Date</label>
	<input class="champ" type="text" name="entrainement_date" id="entrainement_date" value="<?php print $entrainement_date;?>"/>
	<span class="erreur"><?php print $x->erreurs['Date'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

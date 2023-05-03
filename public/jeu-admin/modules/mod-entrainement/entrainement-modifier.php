<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN ENTRAINEMENT</div>
			<div class="blocContent" style="margin-top:5px;padding:0px;">
				<div class="krakModule">

		<div id="article-editer" class="module editeMsg" style="padding:0px;">
		<script type="text/javascript">
			<!--
			$("document").ready(function(){
				$(".wysiwyg").wysiwyg();	
				$(".wysiwyg").css({width:"720"});
				//
			});
			-->
		</script>
		
<?php
if(isset($_GET["id"]) and is_numeric($_GET["id"])){
	$id=$_GET["id"];
	
	$sql='select * from entrainement
	where entrainement_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$user_id=stripcslashes($d->user_id);$categorie_id=stripcslashes($d->categorie_id);$entrainement_score=stripcslashes($d->entrainement_score);$entrainement_compteur_question=stripcslashes($d->entrainement_compteur_question);$entrainement_date=stripcslashes($d->entrainement_date);
		
			
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
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `entrainement` SET user_id = "'.$user_id.'",categorie_id = "'.$categorie_id.'",entrainement_score = "'.$entrainement_score.'",entrainement_compteur_question = "'.$entrainement_compteur_question.'",entrainement_date = "'.$entrainement_date.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE entrainement_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
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
	<label>Categorie</label>
	<select class="champ" name="categorie_id" id="categorie_id">
					<option value=""></option>
					<?php 
					$sql='select * from categorie';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->categorie_id==$categorie_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->categorie_id.'">'.$d->categorie_id.'</option>';
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
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN CHAP_QUESTION</div>
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
//Page générée automatiquement par quickApp V 2.0 :(Copyright: Armand Kouassi, @krak225, krak225@gmail.com, +225 08779408), le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Valider</b> </div>';
		$question_id=null;$user_id=null;$repondeur_id=null;$reponse=null;$observation=null;$statut=null;
		
		$libelles=array("Question","User","Repondeur","Reponse","Observation","Statut","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-chap_question/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$question_id= securisedData($question_id);
			$user_id= securisedData($user_id);
			$repondeur_id= securisedData($repondeur_id);
			$reponse= securisedData($reponse);
			$observation= securisedData($observation);
			$statut= securisedData($statut);
			
				$x->verifierNombre($question_id,"Question",0,100000000000000000000000,1);
				$x->verifierNombre($user_id,"User",0,100000000000000000000000,1);
				$x->verifierNombre($repondeur_id,"Repondeur",0,100000000000000000000000,1);
				$x->verifierChaine($reponse,"Reponse",3,1);
		$x->verifierChaine($observation,"Observation",3,1);
		$x->verifierChaine($statut,"Statut",3,1);
	
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `chap_question` (question_id,user_id,repondeur_id,reponse,observation,statut) 
				VALUES ("'.$question_id.'","'.$user_id.'","'.$repondeur_id.'","'.$reponse.'","'.$observation.'","'.$statut.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$question_id=null;$user_id=null;$repondeur_id=null;$reponse=null;$observation=null;$statut=null;
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
	<form id="form-chap_question" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Question</label>
	<select class="champ" name="question_id" id="question_id">
					<option value=""></option>
					<?php 
					$sql='select * from question';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->question_id==$question_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->question_id.'">'.$d->question_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Question'];?></span><br/>
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
	<label>Repondeur</label>
	<select class="champ" name="repondeur_id" id="repondeur_id">
					<option value=""></option>
					<?php 
					$sql='select * from repondeur';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->repondeur_id==$repondeur_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->repondeur_id.'">'.$d->repondeur_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Repondeur'];?></span><br/>
	<label>Reponse</label>
	<input class="champ" type="text" name="reponse" id="reponse" value="<?php print $reponse;?>"/>
	<span class="erreur"><?php print $x->erreurs['Reponse'];?></span><br/>
	<label>Observation</label>
	<input class="champ" type="text" name="observation" id="observation" value="<?php print $observation;?>"/>
	<span class="erreur"><?php print $x->erreurs['Observation'];?></span><br/>
	<label>Statut</label>
	<input class="champ" type="text" name="statut" id="statut" value="<?php print $statut;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

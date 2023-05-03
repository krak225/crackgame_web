<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN CHAP_QUESTION</div>
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
	
	$sql='select * from chap_question
	where chap_question_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$question_id=stripcslashes($d->question_id);$user_id=stripcslashes($d->user_id);$repondeur_id=stripcslashes($d->repondeur_id);$reponse=stripcslashes($d->reponse);$observation=stripcslashes($d->observation);$statut=stripcslashes($d->statut);
		
			
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
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `chap_question` SET question_id = "'.$question_id.'",user_id = "'.$user_id.'",repondeur_id = "'.$repondeur_id.'",reponse = "'.$reponse.'",observation = "'.$observation.'",statut = "'.$statut.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE chap_question_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
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

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->question_id==$question_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->question_id.'">'.$d->question_id.'</option>';
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
	<label>Repondeur</label>
	<select class="champ" name="repondeur_id" id="repondeur_id">
					<option value=""></option>
					<?php 
					$sql='select * from repondeur';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->repondeur_id==$repondeur_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->repondeur_id.'">'.$d->repondeur_id.'</option>';
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
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
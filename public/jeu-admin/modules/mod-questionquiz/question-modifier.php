<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN QUESTION</div>
			<div class="blocContent" style="margin-top:5px;padding:0px;">
				<div class="krakModule">

		<div id="article-editer" class="module editeMsg" style="padding:0px;">
<?php
if(isset($_GET["id"]) and is_numeric($_GET["id"])){
	$id=$_GET["id"];
	
	$sql='select * from question
	where id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$user_id=stripcslashes($d->user_id);$question_fr=stripcslashes($d->question_fr);$question_en=stripcslashes($d->question_en);$proposition_a_fr=stripcslashes($d->proposition_a_fr);$proposition_a_en=stripcslashes($d->proposition_a_en);$proposition_b_fr=stripcslashes($d->proposition_b_fr);$proposition_b_en=stripcslashes($d->proposition_b_en);$proposition_c_fr=stripcslashes($d->proposition_c_fr);$proposition_c_en=stripcslashes($d->proposition_c_en);$reponse=stripcslashes($d->reponse);$categorie_id=stripcslashes($d->categorie_id);$niveau_id=stripcslashes($d->niveau_id);$statut_selection=stripcslashes($d->statut_selection);$statut_selection_chap=stripcslashes($d->statut_selection_chap);$statut=stripcslashes($d->statut);
		
			
		$libelles=array("User","Fr","En","Proposition a fr","Proposition a en","Proposition b fr","Proposition b en","Proposition c fr","Proposition c en","Reponse","Categorie","Niveau","Statut selection","Statut selection chap","Statut","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-question/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$question_fr= securisedData($question_fr);
			$question_en= securisedData($question_en);
			$proposition_a_fr= securisedData($proposition_a_fr);
			$proposition_a_en= securisedData($proposition_a_en);
			$proposition_b_fr= securisedData($proposition_b_fr);
			$proposition_b_en= securisedData($proposition_b_en);
			$proposition_c_fr= securisedData($proposition_c_fr);
			$proposition_c_en= securisedData($proposition_c_en);
			$reponse= securisedData($reponse);
			$categorie_id= securisedData($categorie_id);
			$niveau_id= securisedData($niveau_id);
			$statut_selection= securisedData($statut_selection);
			$statut_selection_chap= securisedData($statut_selection_chap);
			$statut= securisedData($statut);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `question` SET user_id = "'.$user_id.'",question_fr = "'.$question_fr.'",question_en = "'.$question_en.'",proposition_a_fr = "'.$proposition_a_fr.'",proposition_a_en = "'.$proposition_a_en.'",proposition_b_fr = "'.$proposition_b_fr.'",proposition_b_en = "'.$proposition_b_en.'",proposition_c_fr = "'.$proposition_c_fr.'",proposition_c_en = "'.$proposition_c_en.'",reponse = "'.$reponse.'", categorie_id = "'.$categorie_id.'", niveau_id = "'.$niveau_id.'",statut_selection = "'.$statut_selection.'",statut_selection_chap = "'.$statut_selection_chap.'",statut = "'.$statut.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
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
	<form id="form-question" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
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
			print '<option '. $selected. ' value="'.$d->categorie_id.'">'.$d->categorie_libelle.'</option>';
		}
		?>
	</select>
	<span class="erreur"><?php print $x->erreurs['Categorie'];?></span><br/>
	<label>Niveau</label>
	<select class="champ" name="niveau_id" id="niveau_id">
		<option value=""></option>
		<?php 
		$sql='select * from niveau where 1 ';
		//$req=mysql_query($sql);
		//while($d=mysql_fetch_object($req)){
		$stm = $db->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		foreach($data as $d){
			$selected = ($d->niveau_id==$niveau_id)? ' selected ' : null;
			print '<option '.$selected.' value="'.$d->niveau_id.'">'.$d->niveau_libelle.'</option>';
		}
		?>
	</select>
	<span class="erreur"><?php print $x->erreurs['Niveau'];?></span><br/>
	<label>Question en français</label>
	<input class="champ" type="text" name="question_fr" id="question_fr" value="<?php print $question_fr;?>"/>
	<span class="erreur"><?php print $x->erreurs['Fr'];?></span><br/>
	<label>Question en anglais</label>
	<input class="champ" type="text" name="question_en" id="question_en" value="<?php print $question_en;?>"/>
	<span class="erreur"><?php print $x->erreurs['En'];?></span><br/>
	<label>Proposition A en français</label>
	<input class="champ" type="text" name="proposition_a_fr" id="proposition_a_fr" value="<?php print $proposition_a_fr;?>"/>
	<span class="erreur"><?php print $x->erreurs['Proposition a fr'];?></span><br/>
	<label>Proposition A en anglais</label>
	<input class="champ" type="text" name="proposition_a_en" id="proposition_a_en" value="<?php print $proposition_a_en;?>"/>
	<span class="erreur"><?php print $x->erreurs['Proposition a en'];?></span><br/>
	<label>Proposition B en français</label>
	<input class="champ" type="text" name="proposition_b_fr" id="proposition_b_fr" value="<?php print $proposition_b_fr;?>"/>
	<span class="erreur"><?php print $x->erreurs['Proposition b fr'];?></span><br/>
	<label>Proposition B en anglais</label>
	<input class="champ" type="text" name="proposition_b_en" id="proposition_b_en" value="<?php print $proposition_b_en;?>"/>
	<span class="erreur"><?php print $x->erreurs['Proposition b en'];?></span><br/>
	<label>Proposition C en français</label>
	<input class="champ" type="text" name="proposition_c_fr" id="proposition_c_fr" value="<?php print $proposition_c_fr;?>"/>
	<span class="erreur"><?php print $x->erreurs['Proposition c fr'];?></span><br/>
	<label>Proposition C en anglais</label>
	<input class="champ" type="text" name="proposition_c_en" id="proposition_c_en" value="<?php print $proposition_c_en;?>"/>
	<span class="erreur"><?php print $x->erreurs['Proposition c en'];?></span><br/>
	<label>Bonne Réponse</label>
	<select class="champ" name="reponse" id="reponse">
		<option value=""></option>
		<option <?php if($reponse=="A") echo "selected"; ?> value="A">Proposition A</option>
		<option <?php if($reponse=="B") echo "selected"; ?> value="B">Proposition B</option>
		<option <?php if($reponse=="C") echo "selected"; ?> value="C">Proposition C</option>
	</select>
	<span class="erreur"><?php print $x->erreurs['Reponse'];?></span><br/>
	
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
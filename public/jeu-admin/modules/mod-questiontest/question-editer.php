<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UNE QUESTION</div>
			<div class="blocContent" style="margin-top:5px;padding:0px;">
				<div class="krakModule">

		<div id="article-editer" class="module editeMsg" style="padding:0px;">
		
<?php
//Page générée automatiquement par quickApp V 2.0 :(Copyright: Armand Kouassi, @krak225, krak225@gmail.com, +225 08779408), le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Valider</b> </div>';
		$user_id=1;$type_jeu_id=1;$question_fr=null;$question_en=null;$proposition_a_fr=null;$proposition_a_en=null;$proposition_b_fr=null;$proposition_b_en=null;$proposition_c_fr=null;$proposition_c_en=null;$reponse=null;$categorie_id=null;$statut_selection="NOT SELECTED";$statut_selection_chap="NOT SELECTED";$statut="BROUILLON";
		
		$libelles=array("User","Fr","En","Proposition a fr","Proposition a en","Proposition b fr","Proposition b en","Proposition c fr","Proposition c en","Reponse","Categorie","Statut selection","Statut selection chap","Statut","Code de sécurité");
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
			$statut_selection= securisedData($statut_selection);
			$statut_selection_chap= securisedData($statut_selection_chap);
			$statut= securisedData($statut);
			
			$x->verifierNombre($user_id,"User",0,100000000000000000000000,1);
			$x->verifierChaine($question_fr,"Fr",3,1);
			$x->verifierChaine($question_en,"En",3,0);
			$x->verifierChaine($proposition_a_fr,"Proposition a fr",3,1);
			$x->verifierChaine($proposition_a_en,"Proposition a en",3,0);
			$x->verifierChaine($proposition_b_fr,"Proposition b fr",3,1);
			$x->verifierChaine($proposition_b_en,"Proposition b en",3,0);
			$x->verifierChaine($proposition_c_fr,"Proposition c fr",3,1);
			$x->verifierChaine($proposition_c_en,"Proposition c en",3,0);
			$x->verifierChaine($reponse,"Reponse",1,1);
			$x->verifierNombre($categorie_id,"Categorie",0,100000000000000000000000,1);
	
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `question` (type_jeu_id,user_id,question_fr,question_en,proposition_a_fr,proposition_a_en,proposition_b_fr,proposition_b_en,proposition_c_fr,proposition_c_en,reponse,categorie_id,statut_selection,statut_selection_chap,statut) 
				VALUES ("'.$type_jeu_id.'","'.$user_id.'","'.$question_fr.'","'.$question_en.'","'.$proposition_a_fr.'","'.$proposition_a_en.'","'.$proposition_b_fr.'","'.$proposition_b_en.'","'.$proposition_c_fr.'","'.$proposition_c_en.'","'.$reponse.'","'.$categorie_id.'","'.$statut_selection.'","'.$statut_selection_chap.'","'.$statut.'")';

				// die($sql);
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$question_fr=null;$question_en=null;$proposition_a_fr=null;$proposition_a_en=null;$proposition_b_fr=null;$proposition_b_en=null;$proposition_c_fr=null;$proposition_c_en=null;$reponse=null;$categorie_id=null;$statut_selection=null;$statut_selection_chap=null;$statut=null;
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
		$sql='select * from categorie where categorie_id <> 11';
		//$req=mysql_query($sql);
		//while($d=mysql_fetch_object($req)){
		$stm = $db->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		foreach($data as $d){
			$selected = ($d->categorie_id==$categorie_id)? ' selected ' : null;
			print '<option '.$selected.' value="'.$d->categorie_id.'">'.$d->categorie_libelle.'</option>';
		}
		?>
	</select>
	<span class="erreur"><?php print $x->erreurs['Categorie'];?></span><br/>
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
		<option value="A">Proposition A</option>
		<option value="B">Proposition B</option>
		<option value="C">Proposition C</option>
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

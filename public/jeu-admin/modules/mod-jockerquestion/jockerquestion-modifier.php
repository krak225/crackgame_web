<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN JOCKERQUESTION</div>
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
	
	$sql='select * from jockerquestion
	where jockerquestion_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$user_id=stripcslashes($d->user_id);$beneficiaire_user_id=stripcslashes($d->beneficiaire_user_id);$jockerquestion_quantite=stripcslashes($d->jockerquestion_quantite);$jockerquestion_montant=stripcslashes($d->jockerquestion_montant);$jockerquestion_date=stripcslashes($d->jockerquestion_date);
		
			
		$libelles=array("User","Beneficiaire user","Quantite","Montant","Date","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-jockerquestion/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$beneficiaire_user_id= securisedData($beneficiaire_user_id);
			$jockerquestion_quantite= securisedData($jockerquestion_quantite);
			$jockerquestion_montant= securisedData($jockerquestion_montant);
			$jockerquestion_date= securisedData($jockerquestion_date);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `jockerquestion` SET user_id = "'.$user_id.'",beneficiaire_user_id = "'.$beneficiaire_user_id.'",jockerquestion_quantite = "'.$jockerquestion_quantite.'",jockerquestion_montant = "'.$jockerquestion_montant.'",jockerquestion_date = "'.$jockerquestion_date.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE jockerquestion_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$beneficiaire_user_id=null;$jockerquestion_quantite=null;$jockerquestion_montant=null;$jockerquestion_date=null;
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
	<form id="form-jockerquestion" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
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
	<label>Beneficiaire user</label>
	<select class="champ" name="beneficiaire_user_id" id="beneficiaire_user_id">
					<option value=""></option>
					<?php 
					$sql='select * from beneficiaire_user';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->beneficiaire_user_id==$beneficiaire_user_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->beneficiaire_user_id.'">'.$d->beneficiaire_user_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Beneficiaire user'];?></span><br/>
	<label>Quantite</label>
	<input class="champ" type="text" name="jockerquestion_quantite" id="jockerquestion_quantite" value="<?php print $jockerquestion_quantite;?>"/>
	<span class="erreur"><?php print $x->erreurs['Quantite'];?></span><br/>
	<label>Montant</label>
	<input class="champ" type="text" name="jockerquestion_montant" id="jockerquestion_montant" value="<?php print $jockerquestion_montant;?>"/>
	<span class="erreur"><?php print $x->erreurs['Montant'];?></span><br/>
	<label>Date</label>
	<input class="champ" type="text" name="jockerquestion_date" id="jockerquestion_date" value="<?php print $jockerquestion_date;?>"/>
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
<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN SOUSCRIPTION</div>
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
	
	$sql='select * from souscription
	where souscription_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$user_id=stripcslashes($d->user_id);$beneficiaire_user_id=stripcslashes($d->beneficiaire_user_id);$souscription_quantite=stripcslashes($d->souscription_quantite);$souscription_montant=stripcslashes($d->souscription_montant);$souscription_date=stripcslashes($d->souscription_date);
		
			
		$libelles=array("User","Beneficiaire user","Quantite","Montant","Date","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-souscription/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$beneficiaire_user_id= securisedData($beneficiaire_user_id);
			$souscription_quantite= securisedData($souscription_quantite);
			$souscription_montant= securisedData($souscription_montant);
			$souscription_date= securisedData($souscription_date);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `souscription` SET user_id = "'.$user_id.'",beneficiaire_user_id = "'.$beneficiaire_user_id.'",souscription_quantite = "'.$souscription_quantite.'",souscription_montant = "'.$souscription_montant.'",souscription_date = "'.$souscription_date.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE souscription_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$beneficiaire_user_id=null;$souscription_quantite=null;$souscription_montant=null;$souscription_date=null;
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
	<form id="form-souscription" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
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
	<input class="champ" type="text" name="souscription_quantite" id="souscription_quantite" value="<?php print $souscription_quantite;?>"/>
	<span class="erreur"><?php print $x->erreurs['Quantite'];?></span><br/>
	<label>Montant</label>
	<input class="champ" type="text" name="souscription_montant" id="souscription_montant" value="<?php print $souscription_montant;?>"/>
	<span class="erreur"><?php print $x->erreurs['Montant'];?></span><br/>
	<label>Date</label>
	<input class="champ" type="text" name="souscription_date" id="souscription_date" value="<?php print $souscription_date;?>"/>
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
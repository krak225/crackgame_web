<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN RETRAIT</div>
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
	
	$sql='select * from retrait
	where retrait_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$user_id=stripcslashes($d->user_id);$retrait_montant=stripcslashes($d->retrait_montant);$retrait_date_demande=stripcslashes($d->retrait_date_demande);$retrait_date_validation=stripcslashes($d->retrait_date_validation);
		
			
		$libelles=array("User","Montant","Date demande","Date validation","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-retrait/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$retrait_montant= securisedData($retrait_montant);
			$retrait_date_demande= securisedData($retrait_date_demande);
			$retrait_date_validation= securisedData($retrait_date_validation);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `retrait` SET user_id = "'.$user_id.'",retrait_montant = "'.$retrait_montant.'",retrait_date_demande = "'.$retrait_date_demande.'",retrait_date_validation = "'.$retrait_date_validation.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE retrait_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$retrait_montant=null;$retrait_date_demande=null;$retrait_date_validation=null;
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
	<form id="form-retrait" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
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
	<label>Montant</label>
	<input class="champ" type="text" name="retrait_montant" id="retrait_montant" value="<?php print $retrait_montant;?>"/>
	<span class="erreur"><?php print $x->erreurs['Montant'];?></span><br/>
	<label>Date demande</label>
	<input class="champ" type="text" name="retrait_date_demande" id="retrait_date_demande" value="<?php print $retrait_date_demande;?>"/>
	<span class="erreur"><?php print $x->erreurs['Date demande'];?></span><br/>
	<label>Date validation</label>
	<input class="champ" type="text" name="retrait_date_validation" id="retrait_date_validation" value="<?php print $retrait_date_validation;?>"/>
	<span class="erreur"><?php print $x->erreurs['Date validation'];?></span><br/>
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
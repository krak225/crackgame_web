<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN CAGNOTTE</div>
			<div class="blocContent" style="margin-top:5px;padding:0px;">
				<div class="krakModule">

		<div id="article-editer" class="module editeMsg" style="padding:0px;">
<?php
if(isset($_GET["id"]) and is_numeric($_GET["id"])){
	$id=$_GET["id"];
	
	$sql='select * from defi
	where defi_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 20:36:33  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$defi_montant=stripcslashes($d->defi_montant);$defi_date=stripcslashes($d->defi_date);$defi_date_creation=stripcslashes($d->defi_date_creation);
		
			
		$libelles=array("Montant","Date","Date creation","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-defi/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$defi_montant= securisedData($defi_montant);
			$defi_date= securisedData($defi_date);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `defi` SET defi_montant = "'.$defi_montant.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE defi_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$defi_montant=null;$defi_date=null;$defi_date_creation=null;
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
	<form id="form-defi" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
	<fieldset>
		<label>Montant</label>
		<input class="champ" type="text" name="defi_montant" id="defi_montant" value="<?php print $defi_montant;?>"/>
		<span class="erreur"><?php print $x->erreurs['Montant'];?></span><br/>
		<label>Date</label>
		<input class="champ" type="date" name="defi_date" id="defi_date" value="<?php print $defi_date;?>" readonly/>
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
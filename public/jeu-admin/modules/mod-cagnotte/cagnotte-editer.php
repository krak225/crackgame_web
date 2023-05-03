<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN CAGNOTTE</div>
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
//Page générée automatiquement par quickApp V 2.0 :(Copyright: Armand Kouassi, @krak225, krak225@gmail.com, +225 08779408), le 19-05-2019 à 20:36:33  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Valider</b> </div>';
		$cagnotte_montant=null;$cagnotte_date=null;$cagnotte_date_creation=null;
		
		$libelles=array("Montant","Date","Date creation","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-cagnotte/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$cagnotte_montant= securisedData($cagnotte_montant);
			$cagnotte_date= securisedData($cagnotte_date);
			$cagnotte_date_creation= date('Y-m-d H:i:s');
			
			$x->verifierNombre($cagnotte_montant,"Montant",0,100000000000000000000000,1);
			
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `cagnotte` (cagnotte_montant,cagnotte_date,cagnotte_date_creation) 
				VALUES ("'.$cagnotte_montant.'","'.$cagnotte_date.'","'.$cagnotte_date_creation.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$cagnotte_montant=null;$cagnotte_date=null;$cagnotte_date_creation=null;
				}
				else{
					$info='<div class="echec">Désolé!! enregistrement non effectué .</div>';
				}		
			}
			else
			{  
				$info='<div class="echec">Attemtion!! erreurs dans le formulaire</div>'; 
			}
		}
	?>

	<div class="info"><?php print $info;?></div>
	<form id="form-cagnotte" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Montant</label>
	<input class="champ" type="text" name="cagnotte_montant" id="cagnotte_montant" value="<?php print $cagnotte_montant;?>"/>
	<span class="erreur"><?php print $x->erreurs['Montant'];?></span><br/>
	<label>Date</label>
	<input class="champ" type="date" name="cagnotte_date" id="cagnotte_date" value="<?php echo date('Y-m-d');?>" readonly/>
	<span class="erreur"><?php print $x->erreurs['Date'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

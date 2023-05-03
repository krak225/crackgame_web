<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN PAYS</div>
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
//Page générée automatiquement par quickApp V 2.0 :(Copyright: Armand Kouassi, @krak225, krak225@gmail.com, +225 08779408), le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Valider</b> </div>';
		$pays_code=null;$pays_alpha2=null;$pays_alpha3=null;$pays_nom_en=null;$pays_nom_fr=null;
		
		$libelles=array("Code","Alpha2","Alpha3","Nom en","Nom fr","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-pays/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$pays_code= securisedData($pays_code);
			$pays_alpha2= securisedData($pays_alpha2);
			$pays_alpha3= securisedData($pays_alpha3);
			$pays_nom_en= securisedData($pays_nom_en);
			$pays_nom_fr= securisedData($pays_nom_fr);
			
				$x->verifierNombre($pays_code,"Code",0,100000000000000000000000,1);
				$x->verifierChaine($pays_alpha2,"Alpha2",3,1);
		$x->verifierChaine($pays_alpha3,"Alpha3",3,1);
		$x->verifierChaine($pays_nom_en,"Nom en",3,1);
		$x->verifierChaine($pays_nom_fr,"Nom fr",3,1);
	
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `pays` (pays_code,pays_alpha2,pays_alpha3,pays_nom_en,pays_nom_fr) 
				VALUES ("'.$pays_code.'","'.$pays_alpha2.'","'.$pays_alpha3.'","'.$pays_nom_en.'","'.$pays_nom_fr.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$pays_code=null;$pays_alpha2=null;$pays_alpha3=null;$pays_nom_en=null;$pays_nom_fr=null;
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
	<form id="form-pays" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Code</label>
	<input class="champ" type="text" name="pays_code" id="pays_code" value="<?php print $pays_code;?>"/>
	<span class="erreur"><?php print $x->erreurs['Code'];?></span><br/>
	<label>Alpha2</label>
	<input class="champ" type="text" name="pays_alpha2" id="pays_alpha2" value="<?php print $pays_alpha2;?>"/>
	<span class="erreur"><?php print $x->erreurs['Alpha2'];?></span><br/>
	<label>Alpha3</label>
	<input class="champ" type="text" name="pays_alpha3" id="pays_alpha3" value="<?php print $pays_alpha3;?>"/>
	<span class="erreur"><?php print $x->erreurs['Alpha3'];?></span><br/>
	<label>Nom en</label>
	<input class="champ" type="text" name="pays_nom_en" id="pays_nom_en" value="<?php print $pays_nom_en;?>"/>
	<span class="erreur"><?php print $x->erreurs['Nom en'];?></span><br/>
	<label>Nom fr</label>
	<input class="champ" type="text" name="pays_nom_fr" id="pays_nom_fr" value="<?php print $pays_nom_fr;?>"/>
	<span class="erreur"><?php print $x->erreurs['Nom fr'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

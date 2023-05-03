<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN CATEGORIE</div>
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
		$categorie_libelle=null;$categorie_description=null;
		
		$libelles=array("Libelle","Description","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-categorie/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$categorie_libelle= securisedData($categorie_libelle);
			$categorie_description= securisedData($categorie_description);
			
				$x->verifierChaine($categorie_libelle,"Libelle",3,1);
		$x->verifierChaine($categorie_description,"Description",3,1);
	
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `categorie` (categorie_libelle,categorie_description) 
				VALUES ("'.$categorie_libelle.'","'.$categorie_description.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$categorie_libelle=null;$categorie_description=null;
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
	<form id="form-categorie" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Libelle</label>
	<input class="champ" type="text" name="categorie_libelle" id="categorie_libelle" value="<?php print $categorie_libelle;?>"/>
	<span class="erreur"><?php print $x->erreurs['Libelle'];?></span><br/>
	<label>Description</label>
	<input class="champ" type="text" name="categorie_description" id="categorie_description" value="<?php print $categorie_description;?>"/>
	<span class="erreur"><?php print $x->erreurs['Description'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

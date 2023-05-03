<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN CATEGORIE</div>
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
	
	$sql='select * from categorie
	where categorie_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$categorie_libelle=stripcslashes($d->categorie_libelle);$categorie_description=stripcslashes($d->categorie_description);
		
			
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
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `categorie` SET categorie_libelle = "'.$categorie_libelle.'",categorie_description = "'.$categorie_description.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE categorie_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
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
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
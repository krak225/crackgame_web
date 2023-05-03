<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN PAYS</div>
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
	
	$sql='select * from pays
	where pays_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$pays_code=stripcslashes($d->pays_code);$pays_alpha2=stripcslashes($d->pays_alpha2);$pays_alpha3=stripcslashes($d->pays_alpha3);$pays_nom_en=stripcslashes($d->pays_nom_en);$pays_nom_fr=stripcslashes($d->pays_nom_fr);
		
			
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
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `pays` SET pays_code = "'.$pays_code.'",pays_alpha2 = "'.$pays_alpha2.'",pays_alpha3 = "'.$pays_alpha3.'",pays_nom_en = "'.$pays_nom_en.'",pays_nom_fr = "'.$pays_nom_fr.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE pays_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
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
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
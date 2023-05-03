<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN LANGUE</div>
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
	
	$sql='select * from langue
	where langue_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$langue_code=stripcslashes($d->langue_code);$langue_libelle=stripcslashes($d->langue_libelle);$langue_drapeau=stripcslashes($d->langue_drapeau);
		
			
		$libelles=array("Code","Libelle","Drapeau","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-langue/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$langue_code= securisedData($langue_code);
			$langue_libelle= securisedData($langue_libelle);
			$langue_drapeau= securisedData($langue_drapeau);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `langue` SET langue_code = "'.$langue_code.'",langue_libelle = "'.$langue_libelle.'",langue_drapeau = "'.$langue_drapeau.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE langue_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$langue_code=null;$langue_libelle=null;$langue_drapeau=null;
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
	<form id="form-langue" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Code</label>
	<input class="champ" type="text" name="langue_code" id="langue_code" value="<?php print $langue_code;?>"/>
	<span class="erreur"><?php print $x->erreurs['Code'];?></span><br/>
	<label>Libelle</label>
	<input class="champ" type="text" name="langue_libelle" id="langue_libelle" value="<?php print $langue_libelle;?>"/>
	<span class="erreur"><?php print $x->erreurs['Libelle'];?></span><br/>
	<label>Drapeau</label>
	<input class="champ" type="text" name="langue_drapeau" id="langue_drapeau" value="<?php print $langue_drapeau;?>"/>
	<span class="erreur"><?php print $x->erreurs['Drapeau'];?></span><br/>
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
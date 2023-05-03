<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN DEVISE</div>
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
	
	$sql='select * from devise
	where devise_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$devise_code=stripcslashes($d->devise_code);$devise_libelle=stripcslashes($d->devise_libelle);
		
			
		$libelles=array("Code","Libelle","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-devise/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$devise_code= securisedData($devise_code);
			$devise_libelle= securisedData($devise_libelle);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `devise` SET devise_code = "'.$devise_code.'",devise_libelle = "'.$devise_libelle.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE devise_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$devise_code=null;$devise_libelle=null;
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
	<form id="form-devise" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Code</label>
	<input class="champ" type="text" name="devise_code" id="devise_code" value="<?php print $devise_code;?>"/>
	<span class="erreur"><?php print $x->erreurs['Code'];?></span><br/>
	<label>Libelle</label>
	<input class="champ" type="text" name="devise_libelle" id="devise_libelle" value="<?php print $devise_libelle;?>"/>
	<span class="erreur"><?php print $x->erreurs['Libelle'];?></span><br/>
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
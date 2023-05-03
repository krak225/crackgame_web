<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN LANGUE</div>
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
		$langue_code=null;$langue_libelle=null;$langue_drapeau=null;
		
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
			
				$x->verifierChaine($langue_code,"Code",3,1);
		$x->verifierChaine($langue_libelle,"Libelle",3,1);
		$x->verifierChaine($langue_drapeau,"Drapeau",3,1);
	
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `langue` (langue_code,langue_libelle,langue_drapeau) 
				VALUES ("'.$langue_code.'","'.$langue_libelle.'","'.$langue_drapeau.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
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

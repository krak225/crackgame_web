<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN AVATAR</div>
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
		$photo=null;
		
		$libelles=array("Photo","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-avatar/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$photo= securisedData($photo);
			
			$photo=$_FILES["avatar_photo"];
		$x->verifierPieceJointe($photo,"Photo",10000000,1000000,1000000,$extensionsvalides,1);
	
			if($x->ToutEstCorrecte()){  
				$avatar_photo=$x->nomFichier($photo);
				$ext=$x->extensionfichier($photo);
				$avatar_photo= 'avatar_photo_'.time().'_'.mt_rand(1000,1000000000).'.'.$ext;
				$sql='INSERT INTO `avatar` (photo) 
				VALUES ("'.$photo.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//déplacer le fichier
					if(!empty($ext)){
						$x->DeplacerFichier($photo,$avatar_photo,$imageDirectory);

						// creerMiniature($imageDirectory.'/'.$article_image,640,480,array(200,200,200));
						// creerMiniature($imageDirectory.'/'.$article_image,480,200,array(200,200,200));
						// creerMiniature2($imageDirectory.'/'.$article_image,$ext,480,200,array(200,200,200));
					}
					//initialiser les variables
					$photo=null;
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
	<form id="form-avatar" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Photo</label>
	<input class="champ" type="file" name="photo" id="photo" value="<?php print $photo;?>"/>
	<span class="erreur"><?php print $x->erreurs['Photo'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

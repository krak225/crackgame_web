<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN KW_ADMINISTRATEUR</div>
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
		$kw_administrateur_login=null;$kw_administrateur_pass=null;$kw_administrateur_email=null;$kw_administrateur_rang=null;
		
		$libelles=array("Login","Pass","Email","Rang","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-kw_administrateur/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$kw_administrateur_login= securisedData($kw_administrateur_login);
			$kw_administrateur_pass= securisedData($kw_administrateur_pass);
			$kw_administrateur_email= securisedData($kw_administrateur_email);
			$kw_administrateur_rang= securisedData($kw_administrateur_rang);
			
				$x->verifierChaine($kw_administrateur_login,"Login",3,1);
		$x->verifierChaine($kw_administrateur_pass,"Pass",3,1);
		$x->verifierEmail($kw_administrateur_email,"Email",1);
		$x->verifierNombre($kw_administrateur_rang,"Rang",0,100000000000000000000000,1);
			
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `kw_administrateur` (kw_administrateur_login,kw_administrateur_pass,kw_administrateur_email,kw_administrateur_rang) 
				VALUES ("'.$kw_administrateur_login.'","'.$kw_administrateur_pass.'","'.$kw_administrateur_email.'","'.$kw_administrateur_rang.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$kw_administrateur_login=null;$kw_administrateur_pass=null;$kw_administrateur_email=null;$kw_administrateur_rang=null;
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
	<form id="form-kw_administrateur" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Login</label>
	<input class="champ" type="text" name="kw_administrateur_login" id="kw_administrateur_login" value="<?php print $kw_administrateur_login;?>"/>
	<span class="erreur"><?php print $x->erreurs['Login'];?></span><br/>
	<label>Pass</label>
	<input class="champ" type="text" name="kw_administrateur_pass" id="kw_administrateur_pass" value="<?php print $kw_administrateur_pass;?>"/>
	<span class="erreur"><?php print $x->erreurs['Pass'];?></span><br/>
	<label>Email</label>
	<input class="champ" type="text" name="kw_administrateur_email" id="kw_administrateur_email" value="<?php print $kw_administrateur_email;?>"/>
	<span class="erreur"><?php print $x->erreurs['Email'];?></span><br/>
	<label>Rang</label>
	<input class="champ" type="text" name="kw_administrateur_rang" id="kw_administrateur_rang" value="<?php print $kw_administrateur_rang;?>"/>
	<span class="erreur"><?php print $x->erreurs['Rang'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

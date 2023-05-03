<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN KW_ADMINISTRATEUR</div>
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
	
	$sql='select * from kw_administrateur
	where kw_administrateur_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$kw_administrateur_login=stripcslashes($d->kw_administrateur_login);$kw_administrateur_pass=stripcslashes($d->kw_administrateur_pass);$kw_administrateur_email=stripcslashes($d->kw_administrateur_email);$kw_administrateur_rang=stripcslashes($d->kw_administrateur_rang);
		
			
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
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `kw_administrateur` SET kw_administrateur_login = "'.$kw_administrateur_login.'",kw_administrateur_pass = "'.$kw_administrateur_pass.'",kw_administrateur_email = "'.$kw_administrateur_email.'",kw_administrateur_rang = "'.$kw_administrateur_rang.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE kw_administrateur_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
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
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
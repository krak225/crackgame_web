<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN USERS</div>
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
		$profil_id=null;$nom=null;$prenoms=null;$sexe=null;$date_naissance=null;$telephone=null;$adresse_email=null;$pseudo=null;$adresse=null;$code_postal=null;$ville=null;$pays_origine_id=null;$pays_residence_id=null;$photo=null;$lang_code=null;$lang_libelle=null;$devise=null;$total_points=null;$total_points_test=null;$total_points_duel=null;$score_general=null;$souscription=null;$jocker_question=null;$jocker_duel=null;$jocker_jeu=null;$money=null;$email=null;$password=null;$remember_token=null;$parrain=null;$created_at=null;$updated_at=null;$statut=null;$statut_abonnement=null;$statut_abonnement_chap=null;$statut_matrice=null;$statut_connexion=null;$communaute=null;
		
		$libelles=array("Profil","Nom","Prenoms","Sexe","Date naissance","Telephone","Adresse email","Pseudo","Adresse","Code postal","Ville","Pays origine","Pays residence","Photo","Lang code","Lang libelle","Devise","Total points","Total points test","Total points duel","Score general","Souscription","Jocker question","Jocker duel","Jocker jeu","Money","Email","Password","Remember token","Parrain","Created at","Updated at","Statut","Statut abonnement","Statut abonnement chap","Statut matrice","Statut connexion","Communaute","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-users/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$profil_id= securisedData($profil_id);
			$nom= securisedData($nom);
			$prenoms= securisedData($prenoms);
			$sexe= securisedData($sexe);
			$date_naissance= securisedData($date_naissance);
			$telephone= securisedData($telephone);
			$adresse_email= securisedData($adresse_email);
			$pseudo= securisedData($pseudo);
			$adresse= securisedData($adresse);
			$code_postal= securisedData($code_postal);
			$ville= securisedData($ville);
			$pays_origine_id= securisedData($pays_origine_id);
			$pays_residence_id= securisedData($pays_residence_id);
			$photo= securisedData($photo);
			$lang_code= securisedData($lang_code);
			$lang_libelle= securisedData($lang_libelle);
			$devise= securisedData($devise);
			$total_points= securisedData($total_points);
			$total_points_test= securisedData($total_points_test);
			$total_points_duel= securisedData($total_points_duel);
			$score_general= securisedData($score_general);
			$souscription= securisedData($souscription);
			$jocker_question= securisedData($jocker_question);
			$jocker_duel= securisedData($jocker_duel);
			$jocker_jeu= securisedData($jocker_jeu);
			$money= securisedData($money);
			$email= securisedData($email);
			$password= securisedData($password);
			$remember_token= securisedData($remember_token);
			$parrain= securisedData($parrain);
			$created_at= securisedData($created_at);
			$updated_at= securisedData($updated_at);
			$statut= securisedData($statut);
			$statut_abonnement= securisedData($statut_abonnement);
			$statut_abonnement_chap= securisedData($statut_abonnement_chap);
			$statut_matrice= securisedData($statut_matrice);
			$statut_connexion= securisedData($statut_connexion);
			$communaute= securisedData($communaute);
			
			$photo=$_FILES["users_photo"];
		$x->verifierNombre($profil_id,"Profil",0,100000000000000000000000,1);
				$x->verifierChaine($nom,"Nom",3,1);
		$x->verifierChaine($prenoms,"Prenoms",3,1);
		$x->verifierChaine($sexe,"Sexe",3,1);
		$x->verifierChaine($telephone,"Telephone",3,1);
		$x->verifierChaine($adresse_email,"Adresse email",3,1);
		$x->verifierChaine($pseudo,"Pseudo",3,1);
		$x->verifierChaine($adresse,"Adresse",3,1);
		$x->verifierChaine($code_postal,"Code postal",3,1);
		$x->verifierChaine($ville,"Ville",3,1);
		$x->verifierNombre($pays_origine_id,"Pays origine",0,100000000000000000000000,1);
				$x->verifierNombre($pays_residence_id,"Pays residence",0,100000000000000000000000,1);
				$x->verifierPieceJointe($photo,"Photo",10000000,1000000,1000000,$extensionsvalides,1);
		$x->verifierChaine($lang_code,"Lang code",3,1);
		$x->verifierChaine($lang_libelle,"Lang libelle",3,1);
		$x->verifierChaine($devise,"Devise",3,1);
		$x->verifierNombre($total_points,"Total points",0,100000000000000000000000,1);
				$x->verifierNombre($total_points_test,"Total points test",0,100000000000000000000000,1);
				$x->verifierNombre($total_points_duel,"Total points duel",0,100000000000000000000000,1);
				$x->verifierNombre($score_general,"Score general",0,100000000000000000000000,1);
				$x->verifierNombre($souscription,"Souscription",0,100000000000000000000000,1);
				$x->verifierNombre($jocker_question,"Jocker question",0,100000000000000000000000,1);
				$x->verifierNombre($jocker_duel,"Jocker duel",0,100000000000000000000000,1);
				$x->verifierNombre($jocker_jeu,"Jocker jeu",0,100000000000000000000000,1);
				$x->verifierEmail($email,"Email",1);
		$x->verifierChaine($password,"Password",3,1);
		$x->verifierChaine($remember_token,"Remember token",3,1);
		$x->verifierChaine($parrain,"Parrain",3,1);
		$x->verifierChaine($statut,"Statut",3,1);
		$x->verifierChaine($statut_abonnement,"Statut abonnement",3,1);
		$x->verifierChaine($statut_abonnement_chap,"Statut abonnement chap",3,1);
		$x->verifierChaine($statut_matrice,"Statut matrice",3,1);
		$x->verifierChaine($statut_connexion,"Statut connexion",3,1);
		$x->verifierChaine($communaute,"Communaute",3,1);
	
			if($x->ToutEstCorrecte()){  
				$users_photo=$x->nomFichier($photo);
				$ext=$x->extensionfichier($photo);
				$users_photo= 'users_photo_'.time().'_'.mt_rand(1000,1000000000).'.'.$ext;
				$sql='INSERT INTO `users` (profil_id,nom,prenoms,sexe,date_naissance,telephone,adresse_email,pseudo,adresse,code_postal,ville,pays_origine_id,pays_residence_id,photo,lang_code,lang_libelle,devise,total_points,total_points_test,total_points_duel,score_general,souscription,jocker_question,jocker_duel,jocker_jeu,money,email,password,remember_token,parrain,created_at,updated_at,statut,statut_abonnement,statut_abonnement_chap,statut_matrice,statut_connexion,communaute) 
				VALUES ("'.$profil_id.'","'.$nom.'","'.$prenoms.'","'.$sexe.'","'.$date_naissance.'","'.$telephone.'","'.$adresse_email.'","'.$pseudo.'","'.$adresse.'","'.$code_postal.'","'.$ville.'","'.$pays_origine_id.'","'.$pays_residence_id.'","'.$photo.'","'.$lang_code.'","'.$lang_libelle.'","'.$devise.'","'.$total_points.'","'.$total_points_test.'","'.$total_points_duel.'","'.$score_general.'","'.$souscription.'","'.$jocker_question.'","'.$jocker_duel.'","'.$jocker_jeu.'","'.$money.'","'.$email.'","'.$password.'","'.$remember_token.'","'.$parrain.'","'.$created_at.'","'.$updated_at.'","'.$statut.'","'.$statut_abonnement.'","'.$statut_abonnement_chap.'","'.$statut_matrice.'","'.$statut_connexion.'","'.$communaute.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//déplacer le fichier
					if(!empty($ext)){
						$x->DeplacerFichier($photo,$users_photo,$imageDirectory);

						// creerMiniature($imageDirectory.'/'.$article_image,640,480,array(200,200,200));
						// creerMiniature($imageDirectory.'/'.$article_image,480,200,array(200,200,200));
						// creerMiniature2($imageDirectory.'/'.$article_image,$ext,480,200,array(200,200,200));
					}
					//initialiser les variables
					$profil_id=null;$nom=null;$prenoms=null;$sexe=null;$date_naissance=null;$telephone=null;$adresse_email=null;$pseudo=null;$adresse=null;$code_postal=null;$ville=null;$pays_origine_id=null;$pays_residence_id=null;$photo=null;$lang_code=null;$lang_libelle=null;$devise=null;$total_points=null;$total_points_test=null;$total_points_duel=null;$score_general=null;$souscription=null;$jocker_question=null;$jocker_duel=null;$jocker_jeu=null;$money=null;$email=null;$password=null;$remember_token=null;$parrain=null;$created_at=null;$updated_at=null;$statut=null;$statut_abonnement=null;$statut_abonnement_chap=null;$statut_matrice=null;$statut_connexion=null;$communaute=null;
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
	<form id="form-users" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Profil</label>
	<select class="champ" name="profil_id" id="profil_id">
					<option value=""></option>
					<?php 
					$sql='select * from profil';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->profil_id==$profil_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->profil_id.'">'.$d->profil_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Profil'];?></span><br/>
	<label>Nom</label>
	<input class="champ" type="text" name="nom" id="nom" value="<?php print $nom;?>"/>
	<span class="erreur"><?php print $x->erreurs['Nom'];?></span><br/>
	<label>Prenoms</label>
	<input class="champ" type="text" name="prenoms" id="prenoms" value="<?php print $prenoms;?>"/>
	<span class="erreur"><?php print $x->erreurs['Prenoms'];?></span><br/>
	<label>Sexe</label>
	<input class="champ" type="text" name="sexe" id="sexe" value="<?php print $sexe;?>"/>
	<span class="erreur"><?php print $x->erreurs['Sexe'];?></span><br/>
	<label>Date naissance</label>
	<input class="champ" type="text" name="date_naissance" id="date_naissance" value="<?php print $date_naissance;?>"/>
	<span class="erreur"><?php print $x->erreurs['Date naissance'];?></span><br/>
	<label>Telephone</label>
	<input class="champ" type="text" name="telephone" id="telephone" value="<?php print $telephone;?>"/>
	<span class="erreur"><?php print $x->erreurs['Telephone'];?></span><br/>
	<label>Adresse email</label>
	<input class="champ" type="text" name="adresse_email" id="adresse_email" value="<?php print $adresse_email;?>"/>
	<span class="erreur"><?php print $x->erreurs['Adresse email'];?></span><br/>
	<label>Pseudo</label>
	<input class="champ" type="text" name="pseudo" id="pseudo" value="<?php print $pseudo;?>"/>
	<span class="erreur"><?php print $x->erreurs['Pseudo'];?></span><br/>
	<label>Adresse</label>
	<input class="champ" type="text" name="adresse" id="adresse" value="<?php print $adresse;?>"/>
	<span class="erreur"><?php print $x->erreurs['Adresse'];?></span><br/>
	<label>Code postal</label>
	<input class="champ" type="text" name="code_postal" id="code_postal" value="<?php print $code_postal;?>"/>
	<span class="erreur"><?php print $x->erreurs['Code postal'];?></span><br/>
	<label>Ville</label>
	<input class="champ" type="text" name="ville" id="ville" value="<?php print $ville;?>"/>
	<span class="erreur"><?php print $x->erreurs['Ville'];?></span><br/>
	<label>Pays origine</label>
	<select class="champ" name="pays_origine_id" id="pays_origine_id">
					<option value=""></option>
					<?php 
					$sql='select * from pays_origine';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->pays_origine_id==$pays_origine_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->pays_origine_id.'">'.$d->pays_origine_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Pays origine'];?></span><br/>
	<label>Pays residence</label>
	<select class="champ" name="pays_residence_id" id="pays_residence_id">
					<option value=""></option>
					<?php 
					$sql='select * from pays_residence';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->pays_residence_id==$pays_residence_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->pays_residence_id.'">'.$d->pays_residence_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Pays residence'];?></span><br/>
	<label>Photo</label>
	<input class="champ" type="file" name="photo" id="photo" value="<?php print $photo;?>"/>
	<span class="erreur"><?php print $x->erreurs['Photo'];?></span><br/>
	<label>Lang code</label>
	<input class="champ" type="text" name="lang_code" id="lang_code" value="<?php print $lang_code;?>"/>
	<span class="erreur"><?php print $x->erreurs['Lang code'];?></span><br/>
	<label>Lang libelle</label>
	<input class="champ" type="text" name="lang_libelle" id="lang_libelle" value="<?php print $lang_libelle;?>"/>
	<span class="erreur"><?php print $x->erreurs['Lang libelle'];?></span><br/>
	<label>Devise</label>
	<input class="champ" type="text" name="devise" id="devise" value="<?php print $devise;?>"/>
	<span class="erreur"><?php print $x->erreurs['Devise'];?></span><br/>
	<label>Total points</label>
	<input class="champ" type="text" name="total_points" id="total_points" value="<?php print $total_points;?>"/>
	<span class="erreur"><?php print $x->erreurs['Total points'];?></span><br/>
	<label>Total points test</label>
	<input class="champ" type="text" name="total_points_test" id="total_points_test" value="<?php print $total_points_test;?>"/>
	<span class="erreur"><?php print $x->erreurs['Total points test'];?></span><br/>
	<label>Total points duel</label>
	<input class="champ" type="text" name="total_points_duel" id="total_points_duel" value="<?php print $total_points_duel;?>"/>
	<span class="erreur"><?php print $x->erreurs['Total points duel'];?></span><br/>
	<label>Score general</label>
	<input class="champ" type="text" name="score_general" id="score_general" value="<?php print $score_general;?>"/>
	<span class="erreur"><?php print $x->erreurs['Score general'];?></span><br/>
	<label>Souscription</label>
	<input class="champ" type="text" name="souscription" id="souscription" value="<?php print $souscription;?>"/>
	<span class="erreur"><?php print $x->erreurs['Souscription'];?></span><br/>
	<label>Jocker question</label>
	<input class="champ" type="text" name="jocker_question" id="jocker_question" value="<?php print $jocker_question;?>"/>
	<span class="erreur"><?php print $x->erreurs['Jocker question'];?></span><br/>
	<label>Jocker duel</label>
	<input class="champ" type="text" name="jocker_duel" id="jocker_duel" value="<?php print $jocker_duel;?>"/>
	<span class="erreur"><?php print $x->erreurs['Jocker duel'];?></span><br/>
	<label>Jocker jeu</label>
	<input class="champ" type="text" name="jocker_jeu" id="jocker_jeu" value="<?php print $jocker_jeu;?>"/>
	<span class="erreur"><?php print $x->erreurs['Jocker jeu'];?></span><br/>
	<label>Money</label>
	<input class="champ" type="text" name="money" id="money" value="<?php print $money;?>"/>
	<span class="erreur"><?php print $x->erreurs['Money'];?></span><br/>
	<label>Email</label>
	<input class="champ" type="text" name="email" id="email" value="<?php print $email;?>"/>
	<span class="erreur"><?php print $x->erreurs['Email'];?></span><br/>
	<label>Password</label>
	<input class="champ" type="text" name="password" id="password" value="<?php print $password;?>"/>
	<span class="erreur"><?php print $x->erreurs['Password'];?></span><br/>
	<label>Remember token</label>
	<input class="champ" type="text" name="remember_token" id="remember_token" value="<?php print $remember_token;?>"/>
	<span class="erreur"><?php print $x->erreurs['Remember token'];?></span><br/>
	<label>Parrain</label>
	<input class="champ" type="text" name="parrain" id="parrain" value="<?php print $parrain;?>"/>
	<span class="erreur"><?php print $x->erreurs['Parrain'];?></span><br/>
	<label>Created at</label>
	<input class="champ" type="text" name="created_at" id="created_at" value="<?php print $created_at;?>"/>
	<span class="erreur"><?php print $x->erreurs['Created at'];?></span><br/>
	<label>Updated at</label>
	<input class="champ" type="text" name="updated_at" id="updated_at" value="<?php print $updated_at;?>"/>
	<span class="erreur"><?php print $x->erreurs['Updated at'];?></span><br/>
	<label>Statut</label>
	<input class="champ" type="text" name="statut" id="statut" value="<?php print $statut;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut'];?></span><br/>
	<label>Statut abonnement</label>
	<input class="champ" type="text" name="statut_abonnement" id="statut_abonnement" value="<?php print $statut_abonnement;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut abonnement'];?></span><br/>
	<label>Statut abonnement chap</label>
	<input class="champ" type="text" name="statut_abonnement_chap" id="statut_abonnement_chap" value="<?php print $statut_abonnement_chap;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut abonnement chap'];?></span><br/>
	<label>Statut matrice</label>
	<input class="champ" type="text" name="statut_matrice" id="statut_matrice" value="<?php print $statut_matrice;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut matrice'];?></span><br/>
	<label>Statut connexion</label>
	<input class="champ" type="text" name="statut_connexion" id="statut_connexion" value="<?php print $statut_connexion;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut connexion'];?></span><br/>
	<label>Communaute</label>
	<input class="champ" type="text" name="communaute" id="communaute" value="<?php print $communaute;?>"/>
	<span class="erreur"><?php print $x->erreurs['Communaute'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

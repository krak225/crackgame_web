<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">DÉTAILS D'UN USERS</div>
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
	
	$sql='select * from users
	where users_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);

	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	?>
	<label>Profil</label>
	<div>
					<?php 
					$sql='select * from profil where profil_id="'.$d->profil_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->profil_id.'</div>';
					
					?>
</div>
	<label>Nom</label>
	<div><?php print $d->nom;?></div>
	<label>Prenoms</label>
	<div><?php print $d->prenoms;?></div>
	<label>Sexe</label>
	<div><?php print $d->sexe;?></div>
	<label>Date naissance</label>
	<div><?php print $d->date_naissance;?></div>
	<label>Telephone</label>
	<div><?php print $d->telephone;?></div>
	<label>Adresse email</label>
	<div><?php print $d->adresse_email;?></div>
	<label>Pseudo</label>
	<div><?php print $d->pseudo;?></div>
	<label>Adresse</label>
	<div><?php print $d->adresse;?></div>
	<label>Code postal</label>
	<div><?php print $d->code_postal;?></div>
	<label>Ville</label>
	<div><?php print $d->ville;?></div>
	<label>Pays origine</label>
	<div>
					<?php 
					$sql='select * from pays_origine where pays_origine_id="'.$d->pays_origine_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->pays_origine_id.'</div>';
					
					?>
</div>
	<label>Pays residence</label>
	<div>
					<?php 
					$sql='select * from pays_residence where pays_residence_id="'.$d->pays_residence_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->pays_residence_id.'</div>';
					
					?>
</div>
	<label>Photo</label>
	<div><img src="../images/upload-users/<?php print $d->photo;?>" style="width:148px;"/></div>
	<label>Lang code</label>
	<div><?php print $d->lang_code;?></div>
	<label>Lang libelle</label>
	<div><?php print $d->lang_libelle;?></div>
	<label>Devise</label>
	<div><?php print $d->devise;?></div>
	<label>Total points</label>
	<div><?php print $d->total_points;?></div>
	<label>Total points test</label>
	<div><?php print $d->total_points_test;?></div>
	<label>Total points duel</label>
	<div><?php print $d->total_points_duel;?></div>
	<label>Score general</label>
	<div><?php print $d->score_general;?></div>
	<label>Souscription</label>
	<div><?php print $d->souscription;?></div>
	<label>Jocker question</label>
	<div><?php print $d->jocker_question;?></div>
	<label>Jocker duel</label>
	<div><?php print $d->jocker_duel;?></div>
	<label>Jocker jeu</label>
	<div><?php print $d->jocker_jeu;?></div>
	<label>Money</label>
	<div><?php print $d->money;?></div>
	<label>Email</label>
	<div><?php print $d->email;?></div>
	<label>Password</label>
	<div><?php print $d->password;?></div>
	<label>Remember token</label>
	<div><?php print $d->remember_token;?></div>
	<label>Parrain</label>
	<div><?php print $d->parrain;?></div>
	<label>Created at</label>
	<div><?php print $d->created_at;?></div>
	<label>Updated at</label>
	<div><?php print $d->updated_at;?></div>
	<label>Statut</label>
	<div><?php print $d->statut;?></div>
	<label>Statut abonnement</label>
	<div><?php print $d->statut_abonnement;?></div>
	<label>Statut abonnement chap</label>
	<div><?php print $d->statut_abonnement_chap;?></div>
	<label>Statut matrice</label>
	<div><?php print $d->statut_matrice;?></div>
	<label>Statut connexion</label>
	<div><?php print $d->statut_connexion;?></div>
	<label>Communaute</label>
	<div><?php print $d->communaute;?></div>


	</div>
	</div>
	</div>
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
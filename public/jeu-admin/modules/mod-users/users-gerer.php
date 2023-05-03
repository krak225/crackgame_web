<div class="leftbox" id="" style="padding:0px;">
		<div class="blocTitle">LISTE DES USERS
		<a href="printer.php?table=users" target="_blank"><img class="btn_modifier" src="images/ic/b_print.png" style="width:20px;cursor:pointer;position:relative;top:0px;float:right;margin:-5px 25px 5px 0px;color:black;font-weight:normal;" title="Imprimer"/></a>
		| <span id="btn_open_search_box" class="prettyPhoto" style="cursor:pointer;position:relative;top:0px;float:right;margin:-5px 25px 5px 0px;color:black;font-weight:normal;"><img src="images/loupe.png" style="width:15px;" title="Rechercher"/> Rechercher</span></div>
		<div class="blocContent" style="margin-top:5px;padding:0px;">
			<div class="krakModule">
	
<div>
	<link rel="stylesheet" href="inc/listes/css/screen.css" type="text/css" media="screen" title="default" />
	<script type="text/javascript">
	<!--
	//Cette fonction permet de cocher toutes les lignes
	function cocherTout(nbre)
	{
		$("#checkallbox").html('<span onClick="decocherTout(100)"><img src="images/checkbox-checked.png" style="height:30px;"/></span>');	
		$("#checkallbox-h").html('<span onClick="decocherTout(100)"><img src="images/checkbox-checked.png" style="height:30px;"/></span>');	
		for (i=1;i <=nbre;i++)
		{
			document.getElementById("cfgM_"+i).checked=true;
		}
	}
	//Cette fonction permet de décocher tout les messages		
	function decocherTout(nbre)
	{
		$("#checkallbox").html('<span onClick="cocherTout(100)"><img src="images/checkbox-unchecked.png" style="height:30px;"/></span>');
		$("#checkallbox-h").html('<span onClick="cocherTout(100)"><img src="images/checkbox-unchecked.png" style="height:30px;"/></span>');
		for (i=1;i <=nbre;i++)
		{
			document.getElementById("cfgM_"+i).checked=false;
		}			
	}
	-->
	</script>
	<?php
	$info=null;
	if(isset($_POST["execAction"]))
	{
		extract($_POST);
		//$req=mysql_query($_SESSION["SQL"]);//print $_SESSION["SQL"];
		//récupère les id des membres dans un tableau
		$table_id=Array();$x=-1;
		//while($data=mysql_fetch_array($req)){

		$stm = $db->pdo->prepare($_SESSION["SQL"]);
		$stm->execute();
		$datas = $stm->fetchAll(PDO::FETCH_OBJ);
		foreach($datas as $data){
			$x++;$table_id["id$x"]=$data->id;}
		//pour chaque membre
		foreach($table_id as $id)
		{
			//définir la requète en fonction de l'action sélectionnée
			switch($action){
				case "activer":$sql='update users set `users_statut`="ACTIVE" where id="'.$id.'"';break;
				case "desactiver":$sql='update users set `users_statut`="DESACTIVE" where id="'.$id.'"';break;
				case "supprimer":$sql='delete from users where id="'.$id.'"';break;
			}
			//obtenir l'état de la case à cocher (checkbox)
			$checkBoxValue=isset($_POST["cfgM".$id])? 1 : 0;//print $checkBoxValue;
			//si la case est cochée on exécute la requète
			if($checkBoxValue==1){

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);
				if($stm->execute()){
					$info='<div class="succes">Action exécutée</div>'; 
				}
				else{
					$info='<div class="echec">Désolé!! Action exécutée</div>'.mysql_error();
				}
			}
		}
	}

	print $info;
	?>
	
	
	<!-- debut form recherche -->
	<form id="form-search" method="post" data-creator="kw-Builder" style="display:none;">
		<fieldset>
				<select class="champ" name="id" id="id" title="Id">
							<option value="">Id</option>
							<?php 
							$sql='select * from id';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->id_id==$id_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->id_id.'">'.$d51->id_id.'</option>';
							}
							?>
</select>
	<select class="champ" name="profil_id" id="profil_id" title="Profil">
							<option value="">Profil</option>
							<?php 
							$sql='select * from profil';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->profil_id==$profil_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->profil_id.'">'.$d51->profil_id.'</option>';
							}
							?>
</select>
<input style="width:80px;" class="champ" type="text" name="nom" id="nom" placeholder="Nom" title="Nom"/>
<input style="width:80px;" class="champ" type="text" name="prenoms" id="prenoms" placeholder="Prenoms" title="Prenoms"/>
<input style="width:80px;" class="champ" type="text" name="sexe" id="sexe" placeholder="Sexe" title="Sexe"/>
<input style="width:80px;" class="champ" type="text" name="date_naissance" id="date_naissance" placeholder="Date_naissance" title="Date_naissance"/>
<input style="width:80px;" class="champ" type="text" name="telephone" id="telephone" placeholder="Telephone" title="Telephone"/>
<input style="width:80px;" class="champ" type="text" name="adresse_email" id="adresse_email" placeholder="Adresse_email" title="Adresse_email"/>
<input style="width:80px;" class="champ" type="text" name="pseudo" id="pseudo" placeholder="Pseudo" title="Pseudo"/>
<input style="width:80px;" class="champ" type="text" name="adresse" id="adresse" placeholder="Adresse" title="Adresse"/>
<input style="width:80px;" class="champ" type="text" name="code_postal" id="code_postal" placeholder="Code_postal" title="Code_postal"/>
<input style="width:80px;" class="champ" type="text" name="ville" id="ville" placeholder="Ville" title="Ville"/>
	<select class="champ" name="pays_origine_id" id="pays_origine_id" title="Pays_origine">
							<option value="">Pays_origine</option>
							<?php 
							$sql='select * from pays_origine';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->pays_origine_id==$pays_origine_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->pays_origine_id.'">'.$d51->pays_origine_id.'</option>';
							}
							?>
</select>
	<select class="champ" name="pays_residence_id" id="pays_residence_id" title="Pays_residence">
							<option value="">Pays_residence</option>
							<?php 
							$sql='select * from pays_residence';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->pays_residence_id==$pays_residence_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->pays_residence_id.'">'.$d51->pays_residence_id.'</option>';
							}
							?>
</select>
<input style="width:80px;" class="champ" type="text" name="photo" id="photo" placeholder="Photo" title="Photo"/>
<input style="width:80px;" class="champ" type="text" name="lang_code" id="lang_code" placeholder="Lang_code" title="Lang_code"/>
<input style="width:80px;" class="champ" type="text" name="lang_libelle" id="lang_libelle" placeholder="Lang_libelle" title="Lang_libelle"/>
<input style="width:80px;" class="champ" type="text" name="devise" id="devise" placeholder="Devise" title="Devise"/>
<input style="width:80px;" class="champ" type="text" name="total_points" id="total_points" placeholder="Total_points" title="Total_points"/>
<input style="width:80px;" class="champ" type="text" name="total_points_test" id="total_points_test" placeholder="Total_points_test" title="Total_points_test"/>
<input style="width:80px;" class="champ" type="text" name="total_points_duel" id="total_points_duel" placeholder="Total_points_duel" title="Total_points_duel"/>
<input style="width:80px;" class="champ" type="text" name="score_general" id="score_general" placeholder="Score_general" title="Score_general"/>
<input style="width:80px;" class="champ" type="text" name="souscription" id="souscription" placeholder="Souscription" title="Souscription"/>
<input style="width:80px;" class="champ" type="text" name="jocker_question" id="jocker_question" placeholder="Jocker_question" title="Jocker_question"/>
<input style="width:80px;" class="champ" type="text" name="jocker_duel" id="jocker_duel" placeholder="Jocker_duel" title="Jocker_duel"/>
<input style="width:80px;" class="champ" type="text" name="jocker_jeu" id="jocker_jeu" placeholder="Jocker_jeu" title="Jocker_jeu"/>
<input style="width:80px;" class="champ" type="text" name="money" id="money" placeholder="Money" title="Money"/>
<input style="width:80px;" class="champ" type="text" name="email" id="email" placeholder="Email" title="Email"/>
<input style="width:80px;" class="champ" type="text" name="password" id="password" placeholder="Password" title="Password"/>
<input style="width:80px;" class="champ" type="text" name="remember_token" id="remember_token" placeholder="Remember_token" title="Remember_token"/>
<input style="width:80px;" class="champ" type="text" name="parrain" id="parrain" placeholder="Parrain" title="Parrain"/>
<input style="width:80px;" class="champ" type="text" name="created_at" id="created_at" placeholder="Created_at" title="Created_at"/>
<input style="width:80px;" class="champ" type="text" name="updated_at" id="updated_at" placeholder="Updated_at" title="Updated_at"/>
<input style="width:80px;" class="champ" type="text" name="statut" id="statut" placeholder="Statut" title="Statut"/>
<input style="width:80px;" class="champ" type="text" name="statut_abonnement" id="statut_abonnement" placeholder="Statut_abonnement" title="Statut_abonnement"/>
<input style="width:80px;" class="champ" type="text" name="statut_abonnement_chap" id="statut_abonnement_chap" placeholder="Statut_abonnement_chap" title="Statut_abonnement_chap"/>
<input style="width:80px;" class="champ" type="text" name="statut_matrice" id="statut_matrice" placeholder="Statut_matrice" title="Statut_matrice"/>
<input style="width:80px;" class="champ" type="text" name="statut_connexion" id="statut_connexion" placeholder="Statut_connexion" title="Statut_connexion"/>
<input style="width:80px;" class="champ" type="text" name="communaute" id="communaute" placeholder="Communaute" title="Communaute"/>

			<select name="users_statut" class="champ">
				<option value="ACTIVE">ACTIVE</option>
				<option value="DESACTIVE">DESACTIVE</option>
			</select>
			<input type="submit" name="add" class="btn btn_valider" value="Rechercher"/>
		</fieldset>
	</form>

	<!-- fin form recherche-->
	
	<!--  start product-table ..................................................................................... -->
	<form id="mainform" action="" method="post">
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
		<tr>
			<th class="table-header-check cbox" id="checkallbox-h" style="border:1px solid #d2d2d2;">
				<span onClick="cocherTout(100)"><img src="images/checkbox-unchecked.png" style="height:30px;"/></span>
			</th>
			<th class="table-header-options line-left"><a href="">Nom</a></th>
			<th class="table-header-options line-left"><a href="">Prenoms</a></th>
			<th class="table-header-options line-left"><a href="">Sexe</a></th>
			<th class="table-header-options line-left"><a href="">Date naissance</a></th>
			<th class="table-header-options line-left"><a href="">Telephone</a></th>
			<th class="table-header-options line-left"><a href="">Adresse email</a></th>
			<th class="table-header-options line-left"><a href="">Pseudo</a></th>
			<th class="table-header-options line-left"><a href="">Statut</a></th>
			<th class="table-header-options line-left minwidth-4"><a href="">Action</a></th>
		</tr>
		<?php
		$sql='select * from users where 1 ';
		
		$where = null; 
		 if(isset($_POST['id']) and !empty($_POST['id'])){$where.=' and id="'.$_POST['id'].'"';}
			 if(isset($_POST['profil_id']) and !empty($_POST['profil_id'])){$where.=' and profil_id="'.$_POST['profil_id'].'"';}
			 if(isset($_POST['nom']) and !empty($_POST['nom'])){$where.=' and nom="'.$_POST['nom'].'"';}
			 if(isset($_POST['prenoms']) and !empty($_POST['prenoms'])){$where.=' and prenoms="'.$_POST['prenoms'].'"';}
			 if(isset($_POST['sexe']) and !empty($_POST['sexe'])){$where.=' and sexe="'.$_POST['sexe'].'"';}
			 if(isset($_POST['date_naissance']) and !empty($_POST['date_naissance'])){$where.=' and date_naissance="'.$_POST['date_naissance'].'"';}
			 if(isset($_POST['telephone']) and !empty($_POST['telephone'])){$where.=' and telephone="'.$_POST['telephone'].'"';}
			 if(isset($_POST['adresse_email']) and !empty($_POST['adresse_email'])){$where.=' and adresse_email="'.$_POST['adresse_email'].'"';}
			 if(isset($_POST['pseudo']) and !empty($_POST['pseudo'])){$where.=' and pseudo="'.$_POST['pseudo'].'"';}
			 if(isset($_POST['adresse']) and !empty($_POST['adresse'])){$where.=' and adresse="'.$_POST['adresse'].'"';}
			 if(isset($_POST['code_postal']) and !empty($_POST['code_postal'])){$where.=' and code_postal="'.$_POST['code_postal'].'"';}
			 if(isset($_POST['ville']) and !empty($_POST['ville'])){$where.=' and ville="'.$_POST['ville'].'"';}
			 if(isset($_POST['pays_origine_id']) and !empty($_POST['pays_origine_id'])){$where.=' and pays_origine_id="'.$_POST['pays_origine_id'].'"';}
			 if(isset($_POST['pays_residence_id']) and !empty($_POST['pays_residence_id'])){$where.=' and pays_residence_id="'.$_POST['pays_residence_id'].'"';}
			 if(isset($_POST['photo']) and !empty($_POST['photo'])){$where.=' and photo="'.$_POST['photo'].'"';}
			 if(isset($_POST['lang_code']) and !empty($_POST['lang_code'])){$where.=' and lang_code="'.$_POST['lang_code'].'"';}
			 if(isset($_POST['lang_libelle']) and !empty($_POST['lang_libelle'])){$where.=' and lang_libelle="'.$_POST['lang_libelle'].'"';}
			 if(isset($_POST['devise']) and !empty($_POST['devise'])){$where.=' and devise="'.$_POST['devise'].'"';}
			 if(isset($_POST['total_points']) and !empty($_POST['total_points'])){$where.=' and total_points="'.$_POST['total_points'].'"';}
			 if(isset($_POST['total_points_test']) and !empty($_POST['total_points_test'])){$where.=' and total_points_test="'.$_POST['total_points_test'].'"';}
			 if(isset($_POST['total_points_duel']) and !empty($_POST['total_points_duel'])){$where.=' and total_points_duel="'.$_POST['total_points_duel'].'"';}
			 if(isset($_POST['score_general']) and !empty($_POST['score_general'])){$where.=' and score_general="'.$_POST['score_general'].'"';}
			 if(isset($_POST['souscription']) and !empty($_POST['souscription'])){$where.=' and souscription="'.$_POST['souscription'].'"';}
			 if(isset($_POST['jocker_question']) and !empty($_POST['jocker_question'])){$where.=' and jocker_question="'.$_POST['jocker_question'].'"';}
			 if(isset($_POST['jocker_duel']) and !empty($_POST['jocker_duel'])){$where.=' and jocker_duel="'.$_POST['jocker_duel'].'"';}
			 if(isset($_POST['jocker_jeu']) and !empty($_POST['jocker_jeu'])){$where.=' and jocker_jeu="'.$_POST['jocker_jeu'].'"';}
			 if(isset($_POST['money']) and !empty($_POST['money'])){$where.=' and money="'.$_POST['money'].'"';}
			 if(isset($_POST['email']) and !empty($_POST['email'])){$where.=' and email="'.$_POST['email'].'"';}
			 if(isset($_POST['password']) and !empty($_POST['password'])){$where.=' and password="'.$_POST['password'].'"';}
			 if(isset($_POST['remember_token']) and !empty($_POST['remember_token'])){$where.=' and remember_token="'.$_POST['remember_token'].'"';}
			 if(isset($_POST['parrain']) and !empty($_POST['parrain'])){$where.=' and parrain="'.$_POST['parrain'].'"';}
			 if(isset($_POST['created_at']) and !empty($_POST['created_at'])){$where.=' and created_at="'.$_POST['created_at'].'"';}
			 if(isset($_POST['updated_at']) and !empty($_POST['updated_at'])){$where.=' and updated_at="'.$_POST['updated_at'].'"';}
			 if(isset($_POST['statut']) and !empty($_POST['statut'])){$where.=' and statut="'.$_POST['statut'].'"';}
			 if(isset($_POST['statut_abonnement']) and !empty($_POST['statut_abonnement'])){$where.=' and statut_abonnement="'.$_POST['statut_abonnement'].'"';}
			 if(isset($_POST['statut_abonnement_chap']) and !empty($_POST['statut_abonnement_chap'])){$where.=' and statut_abonnement_chap="'.$_POST['statut_abonnement_chap'].'"';}
			 if(isset($_POST['statut_matrice']) and !empty($_POST['statut_matrice'])){$where.=' and statut_matrice="'.$_POST['statut_matrice'].'"';}
			 if(isset($_POST['statut_connexion']) and !empty($_POST['statut_connexion'])){$where.=' and statut_connexion="'.$_POST['statut_connexion'].'"';}
			 if(isset($_POST['communaute']) and !empty($_POST['communaute'])){$where.=' and communaute="'.$_POST['communaute'].'"';}
			
		$sql.=$where;
		
		$sql.=' order by id DESC '; 
		
		
		$nlpp=10;
		$url='users.php?page=gerer';
		$x=new krakNewPaginer();
		$x->GenererSql($sql,$url,$nlpp);
		// $sql=$x->RenvoiSQL();
		$_SESSION["SQL"]=$x->RenvoiSQL();//print $_SESSION["SQL"];
		//$req=mysql_query($_SESSION["SQL"]) or die (mysql_error());$nbreligne=mysql_num_rows($req);
		$i=0;$y=0;			
		
		// $req=mysql_query($sql);$i=0;
		$stm = $db->pdo->prepare($_SESSION["SQL"]);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		foreach($data as $d){
		//while($d=mysql_fetch_object($req)){
		$i++;$trclass=($i%2==0)? null : ' class="alternate-row" ';
		print '<tr id="tr-'.$d->id.'" '.$trclass.'>
			<td><input type="checkbox" class="chk" name="cfgM'.$d->id .'" id="cfgM_'.$i .'"/></td>
			<td><a href="'.getPage().'.php?page=detail&id='.$d->id.'">'.stripslashes($d->nom).'</a></td>
			<td>'.stripslashes($d->prenoms).'</td>
			<td>'.stripslashes($d->sexe).'</td>
			<td>'.stripslashes($d->date_naissance).'</td>
			<td>'.stripslashes($d->telephone).'</td>
			<td>'.stripslashes($d->adresse_email).'</td>
			<td>'.stripslashes($d->pseudo).'</td>
			<td>'.stripslashes($d->statut).'</td>
			<td><a href="'.getPage().'.php?page=modifier&id='.$d->id.'"><img class="btn_modifier" src="images/btn_modifier.png" style="width:30px;" title="Modifier"/></a>
				<span style="cursor:pointer;" class="btn_suppr"><img class="btn_supprimer" id="'.$d->id.'" data-table="users" data-primarykey="id"  data-value="'.$d->id.'" src="images/btn_supprimer.png" style="width:;margin:3px;" title="Supprimer"/></span>	
			</td>
		</tr>';
		}
		?>
		<tr>
			<th id="checkallbox" style="border:1px solid #d2d2d2;width:;">
				<span onClick="cocherTout(100)"><img src="images/checkbox-unchecked.png" style="height:30px;"/></span>
			</th>
			<th class="th" colspan="5" style="border:1px solid #d2d2d2;text-align:center;letter-spacing:5px;">
				ACTION
			</th>
			<th class="th" colspan="4" style="border:1px solid #d2d2d2;padding:0 5px;">
				<select name="action" style="width:100px;">
					<option value="activer">ACTIVER</option>
					<option value="desactiver">DESACTIVER</option>
					<option value="supprimer">SUPPRIMER</option>
				</select>
				
				<input type="submit" class="btn btn_valider" style="margin:2px;" name="execAction" value="Appliquer à la sélection"/>
			
			</th>
		</tr>
	</table>
	</form>
	<!--  end content-table  -->
	
	<!--  start paging..................................................... -->
	<?php $x->afficherNumeros();?>
	<!--  end paging..................................................... -->
</div>
	</div>
	</div>
	</div>

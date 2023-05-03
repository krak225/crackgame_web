<div class="leftbox" id="" style="padding:0px;">
		<div class="blocTitle">LISTE DES DUELS
		<a href="printer.php?table=duel" target="_blank"><img class="btn_modifier" src="images/ic/b_print.png" style="width:20px;cursor:pointer;position:relative;top:0px;float:right;margin:-5px 25px 5px 0px;color:black;font-weight:normal;" title="Imprimer"/></a>
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
			$x++;$table_id["id$x"]=$data->duel_id;}
		//pour chaque membre
		foreach($table_id as $id)
		{
			//définir la requète en fonction de l'action sélectionnée
			switch($action){
				case "activer":$sql='update duel set `duel_statut`="ACTIVE" where duel_id="'.$id.'"';break;
				case "desactiver":$sql='update duel set `duel_statut`="DESACTIVE" where duel_id="'.$id.'"';break;
				case "supprimer":$sql='delete from duel where duel_id="'.$id.'"';break;
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
				<select class="champ" name="user_id" id="user_id" title="User">
							<option value="">User</option>
							<?php 
							$sql='select * from user';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->user_id==$user_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->user_id.'">'.$d51->user_id.'</option>';
							}
							?>
</select>
	<select class="champ" name="adversaire_id" id="adversaire_id" title="Adversaire">
							<option value="">Adversaire</option>
							<?php 
							$sql='select * from adversaire';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->adversaire_id==$adversaire_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->adversaire_id.'">'.$d51->adversaire_id.'</option>';
							}
							?>
</select>
<input style="width:80px;" class="champ" type="text" name="duel_date_creation" id="duel_date_creation" placeholder="Date_creation" title="Date_creation"/>
<input style="width:80px;" class="champ" type="text" name="duel_date_validation" id="duel_date_validation" placeholder="Date_validation" title="Date_validation"/>
<input style="width:80px;" class="champ" type="text" name="duel_date_debut" id="duel_date_debut" placeholder="Date_debut" title="Date_debut"/>
<input style="width:80px;" class="champ" type="text" name="duel_date_fin" id="duel_date_fin" placeholder="Date_fin" title="Date_fin"/>
	<select class="champ" name="duel_vainqueur_id" id="duel_vainqueur_id" title="Duel_vainqueur">
							<option value="">Duel_vainqueur</option>
							<?php 
							$sql='select * from duel_vainqueur';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->duel_vainqueur_id==$duel_vainqueur_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->duel_vainqueur_id.'">'.$d51->duel_vainqueur_id.'</option>';
							}
							?>
</select>
	<select class="champ" name="duel_abandonneur_id" id="duel_abandonneur_id" title="Duel_abandonneur">
							<option value="">Duel_abandonneur</option>
							<?php 
							$sql='select * from duel_abandonneur';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->duel_abandonneur_id==$duel_abandonneur_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->duel_abandonneur_id.'">'.$d51->duel_abandonneur_id.'</option>';
							}
							?>
</select>
	<select class="champ" name="current_player_id" id="current_player_id" title="Current_player">
							<option value="">Current_player</option>
							<?php 
							$sql='select * from current_player';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->current_player_id==$current_player_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->current_player_id.'">'.$d51->current_player_id.'</option>';
							}
							?>
</select>
<input style="width:80px;" class="champ" type="text" name="compteur_question" id="compteur_question" placeholder="Compteur_question" title="Compteur_question"/>
<input style="width:80px;" class="champ" type="text" name="readystate" id="readystate" placeholder="Readystate" title="Readystate"/>
<input style="width:80px;" class="champ" type="text" name="connected_users" id="connected_users" placeholder="Connected_users" title="Connected_users"/>

			<select name="duel_statut" class="champ">
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
			<th class="table-header-options line-left"><a href="">ID</a></th>
			<th class="table-header-options line-left"><a href="">User</a></th>
<th class="table-header-options line-left"><a href="">Adversaire</a></th>
<th class="table-header-options line-left"><a href="">Date_creation</a></th>
<th class="table-header-options line-left"><a href="">Date_validation</a></th>
<th class="table-header-options line-left"><a href="">Date_debut</a></th>
<th class="table-header-options line-left"><a href="">Date_fin</a></th>
<th class="table-header-options line-left"><a href="">Vainqueur</a></th>
<th class="table-header-options line-left"><a href="">Abandonneur</a></th>
<th class="table-header-options line-left"><a href="">Current_player</a></th>
<th class="table-header-options line-left"><a href="">Compteur_question</a></th>
<th class="table-header-options line-left"><a href="">Readystate</a></th>
<th class="table-header-options line-left"><a href="">Connected_users</a></th>
<th class="table-header-options line-left"><a href="">Statut</a></th>
<th class="table-header-options line-left minwidth-4"><a href="">Action</a></th>
		</tr>
		<?php
		$sql='select * from duel where 1 ';
		
		$where = null; 
		 if(isset($_POST['duel_id']) and !empty($_POST['duel_id'])){$where.=' and duel_id="'.$_POST['duel_id'].'"';}
			 if(isset($_POST['user_id']) and !empty($_POST['user_id'])){$where.=' and user_id="'.$_POST['user_id'].'"';}
			 if(isset($_POST['adversaire_id']) and !empty($_POST['adversaire_id'])){$where.=' and adversaire_id="'.$_POST['adversaire_id'].'"';}
			 if(isset($_POST['duel_date_creation']) and !empty($_POST['duel_date_creation'])){$where.=' and duel_date_creation="'.$_POST['duel_date_creation'].'"';}
			 if(isset($_POST['duel_date_validation']) and !empty($_POST['duel_date_validation'])){$where.=' and duel_date_validation="'.$_POST['duel_date_validation'].'"';}
			 if(isset($_POST['duel_date_debut']) and !empty($_POST['duel_date_debut'])){$where.=' and duel_date_debut="'.$_POST['duel_date_debut'].'"';}
			 if(isset($_POST['duel_date_fin']) and !empty($_POST['duel_date_fin'])){$where.=' and duel_date_fin="'.$_POST['duel_date_fin'].'"';}
			 if(isset($_POST['duel_vainqueur_id']) and !empty($_POST['duel_vainqueur_id'])){$where.=' and duel_vainqueur_id="'.$_POST['duel_vainqueur_id'].'"';}
			 if(isset($_POST['duel_abandonneur_id']) and !empty($_POST['duel_abandonneur_id'])){$where.=' and duel_abandonneur_id="'.$_POST['duel_abandonneur_id'].'"';}
			 if(isset($_POST['current_player_id']) and !empty($_POST['current_player_id'])){$where.=' and current_player_id="'.$_POST['current_player_id'].'"';}
			 if(isset($_POST['compteur_question']) and !empty($_POST['compteur_question'])){$where.=' and compteur_question="'.$_POST['compteur_question'].'"';}
			 if(isset($_POST['readystate']) and !empty($_POST['readystate'])){$where.=' and readystate="'.$_POST['readystate'].'"';}
			 if(isset($_POST['connected_users']) and !empty($_POST['connected_users'])){$where.=' and connected_users="'.$_POST['connected_users'].'"';}
			 if(isset($_POST['duel_statut']) and !empty($_POST['duel_statut'])){$where.=' and duel_statut="'.$_POST['duel_statut'].'"';}
			
		$sql.=$where;
		
		$sql.=' order by duel_id DESC '; 
		
		
		$nlpp=10;
		$url='duel.php?page=gerer';
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
		print '<tr id="tr-'.$d->duel_id.'" '.$trclass.'>
			<td><input type="checkbox" class="chk" name="cfgM'.$d->duel_id .'" id="cfgM_'.$i .'"/></td>
			<td><a href="'.getPage().'.php?page=detail&id='.$d->duel_id.'">'.$d->duel_id .'</a></td>
			
			<td>'.stripslashes($d->user_id).'</td>
			<td>'.stripslashes($d->adversaire_id).'</td>
			<td>'.stripslashes($d->duel_date_creation).'</td>
			<td>'.stripslashes($d->duel_date_validation).'</td>
			<td>'.stripslashes($d->duel_date_debut).'</td>
			<td>'.stripslashes($d->duel_date_fin).'</td>
			<td>'.stripslashes($d->duel_vainqueur_id).'</td>
			<td>'.stripslashes($d->duel_abandonneur_id).'</td>
			<td>'.stripslashes($d->current_player_id).'</td>
			<td>'.stripslashes($d->compteur_question).'</td>
			<td>'.stripslashes($d->readystate).'</td>
			<td>'.stripslashes($d->connected_users).'</td>
			<td>'.stripslashes($d->duel_statut).'</td>
			<td><a href="'.getPage().'.php?page=modifier&id='.$d->duel_id.'"><img class="btn_modifier" src="images/btn_modifier.png" style="width:30px;" title="Modifier"/></a>
				<span style="cursor:pointer;" class="btn_suppr"><img class="btn_supprimer" id="'.$d->duel_id.'" data-table="duel" data-primarykey="duel_id"  data-value="'.$d->duel_id.'" src="images/btn_supprimer.png" style="width:;margin:3px;" title="Supprimer"/></span>	
			</td>
		</tr>';
		}
		?>
		<tr>
			<th id="checkallbox" style="border:1px solid #d2d2d2;width:;">
				<span onClick="cocherTout(100)"><img src="images/checkbox-unchecked.png" style="height:30px;"/></span>
			</th>
			<th class="th" colspan="13" style="border:1px solid #d2d2d2;text-align:center;letter-spacing:5px;">
				ACTION
			</th>
			<th class="th" colspan="2" style="border:1px solid #d2d2d2;padding:0 5px;">
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

<div class="leftbox" id="" style="padding:0px;">
		<div class="blocTitle">LISTE DES CHAPS
		<a href="printer.php?table=chap" target="_blank"><img class="btn_modifier" src="images/ic/b_print.png" style="width:20px;cursor:pointer;position:relative;top:0px;float:right;margin:-5px 25px 5px 0px;color:black;font-weight:normal;" title="Imprimer"/></a>
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
			$x++;$table_id["id$x"]=$data->chap_id;}
		//pour chaque membre
		foreach($table_id as $id)
		{
			//définir la requète en fonction de l'action sélectionnée
			switch($action){
				case "encours":$sql='update chap set `chap_statut`="EN COURS" where chap_id="'.$id.'"';break;
				case "termine":$sql='update chap set `chap_statut`="TERMINE" where chap_id="'.$id.'"';break;
				case "supprimer":$sql='delete from chap where chap_id="'.$id.'"';break;
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
<input style="width:80px;" class="champ" type="text" name="chap_participants" id="chap_participants" placeholder="Participants" title="Participants"/>
	<select class="champ" name="chap_vainqueur_id" id="chap_vainqueur_id" title="Chap_vainqueur">
							<option value="">Chap_vainqueur</option>
							<?php 
							$sql='select * from chap_vainqueur';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->chap_vainqueur_id==$chap_vainqueur_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->chap_vainqueur_id.'">'.$d51->chap_vainqueur_id.'</option>';
							}
							?>
</select>
<input style="width:80px;" class="champ" type="text" name="chap_date_debut" id="chap_date_debut" placeholder="Date_creation" title="Date_creation"/>

			<select name="chap_statut" class="champ">
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
			<th class="table-header-options line-left"><a href="">N°</a></th>
			<th class="table-header-options line-left"><a href="">Crée par</a></th>
			<th class="table-header-options line-left"><a href="">Participants</a></th>
			<th class="table-header-options line-left"><a href="">Date début</a></th>
			<th class="table-header-options line-left"><a href="">Date création</a></th>
			<th class="table-header-options line-left"><a href="">Statut</a></th>
			<th class="table-header-options line-left minwidth-4"><a href="">Action</a></th>
		</tr>
		<?php
		$sql='select * from chap inner join kw_administrateur on user_id = kw_administrateur_id where 1 ';
		
		$where = null; 
		 if(isset($_POST['chap_id']) and !empty($_POST['chap_id'])){$where.=' and chap_id="'.$_POST['chap_id'].'"';}
			 if(isset($_POST['user_id']) and !empty($_POST['user_id'])){$where.=' and user_id="'.$_POST['user_id'].'"';}
			 if(isset($_POST['chap_participants']) and !empty($_POST['chap_participants'])){$where.=' and chap_participants="'.$_POST['chap_participants'].'"';}
			 if(isset($_POST['chap_vainqueur_id']) and !empty($_POST['chap_vainqueur_id'])){$where.=' and chap_vainqueur_id="'.$_POST['chap_vainqueur_id'].'"';}
			 if(isset($_POST['chap_date_debut']) and !empty($_POST['chap_date_debut'])){$where.=' and chap_date_debut="'.$_POST['chap_date_debut'].'"';}
			 if(isset($_POST['chap_statut']) and !empty($_POST['chap_statut'])){$where.=' and chap_statut="'.$_POST['chap_statut'].'"';}
			
		$sql.=$where;
		
		$sql.=' order by chap_id DESC '; 
		
		
		$nlpp=10;
		$url='chap.php?page=gerer';
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
		print '<tr id="tr-'.$d->chap_id.'" '.$trclass.'>
			<td><input type="checkbox" class="chk" name="cfgM'.$d->chap_id .'" id="cfgM_'.$i .'"/></td>
			<td><a href="'.getPage().'.php?page=detail&id='.$d->chap_id.'">'.$d->chap_id .'</a></td>
			
			<td>'.stripslashes($d->kw_administrateur_login).'</td>
			<td>'.stripslashes($d->chap_participants).'</td>
			<td>'.stripslashes($d->chap_date_debut).'</td>
			<td>'.stripslashes($d->chap_date_creation).'</td>
			<td>'.stripslashes($d->chap_statut).'</td>
			<td><a href="'.getPage().'.php?page=modifier&id='.$d->chap_id.'"><img class="btn_modifier" src="images/btn_modifier.png" style="width:30px;" title="Modifier"/></a>
				<span style="cursor:pointer;" class="btn_suppr"><img class="btn_supprimer" id="'.$d->chap_id.'" data-table="chap" data-primarykey="chap_id"  data-value="'.$d->chap_id.'" src="images/btn_supprimer.png" style="width:;margin:3px;" title="Supprimer"/></span>	
			</td>
		</tr>';
		}
		?>
		<tr>
			<th id="checkallbox" style="border:1px solid #d2d2d2;width:;">
				<span onClick="cocherTout(100)"><img src="images/checkbox-unchecked.png" style="height:30px;"/></span>
			</th>
			<th class="th" colspan="4" style="border:1px solid #d2d2d2;text-align:center;letter-spacing:5px;">
				ACTION
			</th>
			<th class="th" colspan="3" style="border:1px solid #d2d2d2;padding:0 5px;">
				<select name="action" style="width:100px;">
					<option value="encours">EN COURS</option>
					<option value="termine">TERMINE</option>
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

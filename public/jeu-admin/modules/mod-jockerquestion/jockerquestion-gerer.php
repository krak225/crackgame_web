<div class="leftbox" id="" style="padding:0px;">
		<div class="blocTitle">LISTE DES JOCKERQUESTIONS
		<a href="printer.php?table=jockerquestion" target="_blank"><img class="btn_modifier" src="images/ic/b_print.png" style="width:20px;cursor:pointer;position:relative;top:0px;float:right;margin:-5px 25px 5px 0px;color:black;font-weight:normal;" title="Imprimer"/></a>
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
			$x++;$table_id["id$x"]=$data->jockerquestion_id;}
		//pour chaque membre
		foreach($table_id as $id)
		{
			//définir la requète en fonction de l'action sélectionnée
			switch($action){
				case "activer":$sql='update jockerquestion set `jockerquestion_statut`="ACTIVE" where jockerquestion_id="'.$id.'"';break;
				case "desactiver":$sql='update jockerquestion set `jockerquestion_statut`="DESACTIVE" where jockerquestion_id="'.$id.'"';break;
				case "supprimer":$sql='delete from jockerquestion where jockerquestion_id="'.$id.'"';break;
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
	<select class="champ" name="beneficiaire_user_id" id="beneficiaire_user_id" title="Beneficiaire_user">
							<option value="">Beneficiaire_user</option>
							<?php 
							$sql='select * from beneficiaire_user';
							//$req=mysql_query($sql);
							//while($d51=mysql_fetch_object($req)){
							$stm = $db->pdo->prepare($sql);
							$stm->execute();
							$data = $stm->fetchAll(PDO::FETCH_OBJ);
							foreach($data as $d51){
								$selected = ($d51->beneficiaire_user_id==$beneficiaire_user_id)? ' selected ' : null;
								print '<option '.$selected.' value="'.$d51->beneficiaire_user_id.'">'.$d51->beneficiaire_user_id.'</option>';
							}
							?>
</select>
<input style="width:80px;" class="champ" type="text" name="jockerquestion_quantite" id="jockerquestion_quantite" placeholder="Quantite" title="Quantite"/>
<input style="width:80px;" class="champ" type="text" name="jockerquestion_montant" id="jockerquestion_montant" placeholder="Montant" title="Montant"/>
<input style="width:80px;" class="champ" type="text" name="jockerquestion_date" id="jockerquestion_date" placeholder="Date" title="Date"/>

			<select name="jockerquestion_statut" class="champ">
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
<th class="table-header-options line-left"><a href="">Beneficiaire_user</a></th>
<th class="table-header-options line-left"><a href="">Quantite</a></th>
<th class="table-header-options line-left"><a href="">Montant</a></th>
<th class="table-header-options line-left"><a href="">Date</a></th>
<th class="table-header-options line-left minwidth-4"><a href="">Action</a></th>
		</tr>
		<?php
		$sql='select * from jockerquestion where 1 ';
		
		$where = null; 
		 if(isset($_POST['jockerquestion_id']) and !empty($_POST['jockerquestion_id'])){$where.=' and jockerquestion_id="'.$_POST['jockerquestion_id'].'"';}
			 if(isset($_POST['user_id']) and !empty($_POST['user_id'])){$where.=' and user_id="'.$_POST['user_id'].'"';}
			 if(isset($_POST['beneficiaire_user_id']) and !empty($_POST['beneficiaire_user_id'])){$where.=' and beneficiaire_user_id="'.$_POST['beneficiaire_user_id'].'"';}
			 if(isset($_POST['jockerquestion_quantite']) and !empty($_POST['jockerquestion_quantite'])){$where.=' and jockerquestion_quantite="'.$_POST['jockerquestion_quantite'].'"';}
			 if(isset($_POST['jockerquestion_montant']) and !empty($_POST['jockerquestion_montant'])){$where.=' and jockerquestion_montant="'.$_POST['jockerquestion_montant'].'"';}
			 if(isset($_POST['jockerquestion_date']) and !empty($_POST['jockerquestion_date'])){$where.=' and jockerquestion_date="'.$_POST['jockerquestion_date'].'"';}
			
		$sql.=$where;
		
		$sql.=' order by jockerquestion_id DESC '; 
		
		
		$nlpp=10;
		$url='jockerquestion.php?page=gerer';
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
		print '<tr id="tr-'.$d->jockerquestion_id.'" '.$trclass.'>
			<td><input type="checkbox" class="chk" name="cfgM'.$d->jockerquestion_id .'" id="cfgM_'.$i .'"/></td>
			<td><a href="'.getPage().'.php?page=detail&id='.$d->jockerquestion_id.'">'.$d->jockerquestion_id .'</a></td>
			
			<td>'.stripslashes($d->user_id).'</td>
			<td>'.stripslashes($d->beneficiaire_user_id).'</td>
			<td>'.stripslashes($d->jockerquestion_quantite).'</td>
			<td>'.stripslashes($d->jockerquestion_montant).'</td>
			<td>'.stripslashes($d->jockerquestion_date).'</td>
			<td><a href="'.getPage().'.php?page=modifier&id='.$d->jockerquestion_id.'"><img class="btn_modifier" src="images/btn_modifier.png" style="width:30px;" title="Modifier"/></a>
				<span style="cursor:pointer;" class="btn_suppr"><img class="btn_supprimer" id="'.$d->jockerquestion_id.'" data-table="jockerquestion" data-primarykey="jockerquestion_id"  data-value="'.$d->jockerquestion_id.'" src="images/btn_supprimer.png" style="width:;margin:3px;" title="Supprimer"/></span>	
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

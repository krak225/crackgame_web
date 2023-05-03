<div class="leftbox" id="" style="padding:0px;">
		<div class="blocTitle">LISTE DES LANGUES
		<a href="printer.php?table=langue" target="_blank"><img class="btn_modifier" src="images/ic/b_print.png" style="width:20px;cursor:pointer;position:relative;top:0px;float:right;margin:-5px 25px 5px 0px;color:black;font-weight:normal;" title="Imprimer"/></a>
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
			$x++;$table_id["id$x"]=$data->langue_id;}
		//pour chaque membre
		foreach($table_id as $id)
		{
			//définir la requète en fonction de l'action sélectionnée
			switch($action){
				case "activer":$sql='update langue set `langue_statut`="ACTIVE" where langue_id="'.$id.'"';break;
				case "desactiver":$sql='update langue set `langue_statut`="DESACTIVE" where langue_id="'.$id.'"';break;
				case "supprimer":$sql='delete from langue where langue_id="'.$id.'"';break;
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
			<input style="width:80px;" class="champ" type="text" name="langue_code" id="langue_code" placeholder="Code" title="Code"/>
<input style="width:80px;" class="champ" type="text" name="langue_libelle" id="langue_libelle" placeholder="Libelle" title="Libelle"/>
<input style="width:80px;" class="champ" type="text" name="langue_drapeau" id="langue_drapeau" placeholder="Drapeau" title="Drapeau"/>

			<select name="langue_statut" class="champ">
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
			<th class="table-header-options line-left"><a href="">Code</a></th>
<th class="table-header-options line-left"><a href="">Libelle</a></th>
<th class="table-header-options line-left"><a href="">Drapeau</a></th>
<th class="table-header-options line-left minwidth-4"><a href="">Action</a></th>
		</tr>
		<?php
		$sql='select * from langue where 1 ';
		
		$where = null; 
		 if(isset($_POST['langue_id']) and !empty($_POST['langue_id'])){$where.=' and langue_id="'.$_POST['langue_id'].'"';}
			 if(isset($_POST['langue_code']) and !empty($_POST['langue_code'])){$where.=' and langue_code="'.$_POST['langue_code'].'"';}
			 if(isset($_POST['langue_libelle']) and !empty($_POST['langue_libelle'])){$where.=' and langue_libelle="'.$_POST['langue_libelle'].'"';}
			 if(isset($_POST['langue_drapeau']) and !empty($_POST['langue_drapeau'])){$where.=' and langue_drapeau="'.$_POST['langue_drapeau'].'"';}
			
		$sql.=$where;
		
		$sql.=' order by langue_id DESC '; 
		
		
		$nlpp=10;
		$url='langue.php?page=gerer';
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
		print '<tr id="tr-'.$d->langue_id.'" '.$trclass.'>
			<td><input type="checkbox" class="chk" name="cfgM'.$d->langue_id .'" id="cfgM_'.$i .'"/></td>
			<td><a href="'.getPage().'.php?page=detail&id='.$d->langue_id.'">'.$d->langue_id .'</a></td>
			
			<td>'.stripslashes($d->langue_code).'</td>
			<td>'.stripslashes($d->langue_libelle).'</td>
			<td>'.stripslashes($d->langue_drapeau).'</td>
			<td><a href="'.getPage().'.php?page=modifier&id='.$d->langue_id.'"><img class="btn_modifier" src="images/btn_modifier.png" style="width:30px;" title="Modifier"/></a>
				<span style="cursor:pointer;" class="btn_suppr"><img class="btn_supprimer" id="'.$d->langue_id.'" data-table="langue" data-primarykey="langue_id"  data-value="'.$d->langue_id.'" src="images/btn_supprimer.png" style="width:;margin:3px;" title="Supprimer"/></span>	
			</td>
		</tr>';
		}
		?>
		<tr>
			<th id="checkallbox" style="border:1px solid #d2d2d2;width:;">
				<span onClick="cocherTout(100)"><img src="images/checkbox-unchecked.png" style="height:30px;"/></span>
			</th>
			<th class="th" colspan="3" style="border:1px solid #d2d2d2;text-align:center;letter-spacing:5px;">
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

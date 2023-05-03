<div class="leftbox" id="" style="padding:0px;">
	<div class="blocTitle">DÉTAILS D'UN QUESTION</div>
	<div class="blocContent" style="margin-top:5px;padding:0px;">
	<div class="krakModule">
	<style type="text/css">
	<!--
	label{padding:10px 0px;font-weight:bold;margin-top:10px;}
	-->
	</style>

	<div id="article-editer" class="module editeMsg" style="padding:0px;">
	<?php
	if(isset($_GET["id"]) and is_numeric($_GET["id"])){
		$id=$_GET["id"];
		
		$sql='select * from question
		inner join users on question.user_id = users.id
		inner join categorie using(categorie_id)
		where question.id="'.$id.'"
		';
		//$req=mysql_query($sql);
		//$d=mysql_fetch_object($req);

		$stm = $db->pdo->prepare($sql);
		$stm->execute();
		$d = $stm->fetch(PDO::FETCH_OBJ);
		?>
		<label>Utilisateur</label>
		<div><?php print $d->pseudo; ?></div>
		<label>Fr</label>
		<div><?php print $d->question_fr;?></div>
		<label>En</label>
		<div><?php print $d->question_en;?></div>
		<label>Proposition A fr</label>
		<div><?php print $d->proposition_a_fr;?></div>
		<label>Proposition A en</label>
		<div><?php print $d->proposition_a_en;?></div>
		<label>Proposition B fr</label>
		<div><?php print $d->proposition_b_fr;?></div>
		<label>Proposition B en</label>
		<div><?php print $d->proposition_b_en;?></div>
		<label>Proposition C fr</label>
		<div><?php print $d->proposition_c_fr;?></div>
		<label>Proposition C en</label>
		<div><?php print $d->proposition_c_en;?></div>
		<label>Reponse</label>
		<div><?php print $d->reponse;?></div>
		<label>Catégorie</label>
		<div><?php print $d->categorie_libelle; ?></div>
		<label>Statut selection</label>
		<div><?php print $d->statut_selection;?></div>
		<label>Statut selection chap</label>
		<div><?php print $d->statut_selection_chap;?></div>
		<label>Statut</label>
		<div><?php print $d->statut;?></div>


		</div>
	</div>
	</div>
	<?php
	}else{
		print "Données non trouvées";
	} 
	?>
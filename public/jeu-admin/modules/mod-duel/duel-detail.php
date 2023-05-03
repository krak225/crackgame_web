<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">DÉTAILS D'UN DUEL</div>
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
	
	$sql='select * from duel
	where duel_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);

	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	?>
	<label>User</label>
	<div>
					<?php 
					$sql='select * from user where user_id="'.$d->user_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->user_id.'</div>';
					
					?>
</div>
	<label>Adversaire</label>
	<div>
					<?php 
					$sql='select * from adversaire where adversaire_id="'.$d->adversaire_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->adversaire_id.'</div>';
					
					?>
</div>
	<label>Date creation</label>
	<div><?php print $d->duel_date_creation;?></div>
	<label>Date validation</label>
	<div><?php print $d->duel_date_validation;?></div>
	<label>Date debut</label>
	<div><?php print $d->duel_date_debut;?></div>
	<label>Date fin</label>
	<div><?php print $d->duel_date_fin;?></div>
	<label>Vainqueur</label>
	<div>
					<?php 
					$sql='select * from duel_vainqueur where duel_vainqueur_id="'.$d->duel_vainqueur_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->duel_vainqueur_id.'</div>';
					
					?>
</div>
	<label>Abandonneur</label>
	<div>
					<?php 
					$sql='select * from duel_abandonneur where duel_abandonneur_id="'.$d->duel_abandonneur_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->duel_abandonneur_id.'</div>';
					
					?>
</div>
	<label>Current player</label>
	<div>
					<?php 
					$sql='select * from current_player where current_player_id="'.$d->current_player_id.'"';
					//$req=mysql_query($sql);
					//$d1=mysql_fetch_object($req);

					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$d1 = $stm->fetchAll(PDO::FETCH_OBJ);

						print '<div>'.$d1->current_player_id.'</div>';
					
					?>
</div>
	<label>Compteur question</label>
	<div><?php print $d->compteur_question;?></div>
	<label>Readystate</label>
	<div><?php print $d->readystate;?></div>
	<label>Connected users</label>
	<div><?php print $d->connected_users;?></div>


	</div>
	</div>
	</div>
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
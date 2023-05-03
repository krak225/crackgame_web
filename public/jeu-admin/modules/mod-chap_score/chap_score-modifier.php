<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN CHAP_SCORE</div>
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
	
	$sql='select * from chap_score
	where chap_score_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$user_id=stripcslashes($d->user_id);$score=stripcslashes($d->score);$statut=stripcslashes($d->statut);
		
			
		$libelles=array("User","Score","Statut","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-chap_score/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$score= securisedData($score);
			$statut= securisedData($statut);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `chap_score` SET user_id = "'.$user_id.'",score = "'.$score.'",statut = "'.$statut.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE chap_score_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$score=null;$statut=null;
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
	<form id="form-chap_score" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>User</label>
	<select class="champ" name="user_id" id="user_id">
					<option value=""></option>
					<?php 
					$sql='select * from user';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->user_id==$user_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->user_id.'">'.$d->user_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['User'];?></span><br/>
	<label>Score</label>
	<input class="champ" type="text" name="score" id="score" value="<?php print $score;?>"/>
	<span class="erreur"><?php print $x->erreurs['Score'];?></span><br/>
	<label>Statut</label>
	<input class="champ" type="text" name="statut" id="statut" value="<?php print $statut;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut'];?></span><br/>
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
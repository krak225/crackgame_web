<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN DUEL_SCORE</div>
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
		$user_id=null;$score=null;$connected=null;
		
		$libelles=array("User","Score","Connected","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-duel_score/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$score= securisedData($score);
			$connected= securisedData($connected);
			
				$x->verifierNombre($user_id,"User",0,100000000000000000000000,1);
				$x->verifierNombre($score,"Score",0,100000000000000000000000,1);
				$x->verifierChaine($connected,"Connected",3,1);
	
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `duel_score` (user_id,score,connected) 
				VALUES ("'.$user_id.'","'.$score.'","'.$connected.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$score=null;$connected=null;
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
	<form id="form-duel_score" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>User</label>
	<select class="champ" name="user_id" id="user_id">
					<option value=""></option>
					<?php 
					$sql='select * from user';
					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){
					$stm = $db->pdo->prepare($sql);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){
						$selected = ($d->user_id==$user_id)? ' selected ' : null;
						print '<option '.$selected.' value="'.$d->user_id.'">'.$d->user_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['User'];?></span><br/>
	<label>Score</label>
	<input class="champ" type="text" name="score" id="score" value="<?php print $score;?>"/>
	<span class="erreur"><?php print $x->erreurs['Score'];?></span><br/>
	<label>Connected</label>
	<input class="champ" type="text" name="connected" id="connected" value="<?php print $connected;?>"/>
	<span class="erreur"><?php print $x->erreurs['Connected'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

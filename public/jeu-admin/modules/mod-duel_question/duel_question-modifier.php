<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">MODIFIER UN DUEL_QUESTION</div>
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
	
	$sql='select * from duel_question
	where duel_question_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);
	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	
	//Page générée automatiquement par krak Web Page Generator 1.0 le 19-05-2019 à 16:22:01  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Modifier</b> </div>';
		$duel_question_id=stripcslashes($d->duel_question_id);$question_id=stripcslashes($d->question_id);$from_user_id=stripcslashes($d->from_user_id);$to_user_id=stripcslashes($d->to_user_id);$statut=stripcslashes($d->statut);$date=stripcslashes($d->date);$time_actuel=stripcslashes($d->time_actuel);
		
			
		$libelles=array("Id","Question","From user","To user","Statut","Date","Time actuel","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-duel_question/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 	
			
			extract($_POST);
			
			$duel_question_id= securisedData($duel_question_id);
			$question_id= securisedData($question_id);
			$from_user_id= securisedData($from_user_id);
			$to_user_id= securisedData($to_user_id);
			$statut= securisedData($statut);
			$date= securisedData($date);
			$time_actuel= securisedData($time_actuel);
			
			
			if($x->ToutEstCorrecte()){  
				$sql='UPDATE `duel_question` SET duel_question_id = "'.$duel_question_id.'",question_id = "'.$question_id.'",from_user_id = "'.$from_user_id.'",to_user_id = "'.$to_user_id.'",statut = "'.$statut.'",date = "'.$date.'",time_actuel = "'.$time_actuel.'"'; 
				 
				if(!empty($ext)){
					$sql.=',  ';
				}
				$sql.=' WHERE duel_question_id="'.$_GET["id"].'"';
				
				
				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Modification effectué avec succès</div>'; 
					
					//initialiser les variables
					$duel_question_id=null;$question_id=null;$from_user_id=null;$to_user_id=null;$statut=null;$date=null;$time_actuel=null;
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
	<form id="form-duel_question" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
<fieldset>
		<label>Id</label>
	<select class="champ" name="duel_question_id" id="duel_question_id">
					<option value=""></option>
					<?php 
					$sql='select * from duel_question';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->duel_question_id==$duel_question_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->duel_question_id.'">'.$d->duel_question_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Id'];?></span><br/>
	<label>Question</label>
	<select class="champ" name="question_id" id="question_id">
					<option value=""></option>
					<?php 
					$sql='select * from question';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->question_id==$question_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->question_id.'">'.$d->question_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['Question'];?></span><br/>
	<label>From user</label>
	<select class="champ" name="from_user_id" id="from_user_id">
					<option value=""></option>
					<?php 
					$sql='select * from from_user';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->from_user_id==$from_user_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->from_user_id.'">'.$d->from_user_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['From user'];?></span><br/>
	<label>To user</label>
	<select class="champ" name="to_user_id" id="to_user_id">
					<option value=""></option>
					<?php 
					$sql='select * from to_user';

					//$req=mysql_query($sql);
					//while($d=mysql_fetch_object($req)){

					$stm = $db->pdo->prepare($_SESSION["SQL"]);
					$stm->execute();
					$data = $stm->fetchAll(PDO::FETCH_OBJ);
					foreach($data as $d){	
						$selected = ($d->to_user_id==$to_user_id)? ' selected ' : null;
						print '<option '. $selected. ' value="'.$d->to_user_id.'">'.$d->to_user_id.'</option>';
					}
					?>
</select>
	<span class="erreur"><?php print $x->erreurs['To user'];?></span><br/>
	<label>Statut</label>
	<input class="champ" type="text" name="statut" id="statut" value="<?php print $statut;?>"/>
	<span class="erreur"><?php print $x->erreurs['Statut'];?></span><br/>
	<label>Date</label>
	<input class="champ" type="text" name="date" id="date" value="<?php print $date;?>"/>
	<span class="erreur"><?php print $x->erreurs['Date'];?></span><br/>
	<label>Time actuel</label>
	<input class="champ" type="text" name="time_actuel" id="time_actuel" value="<?php print $time_actuel;?>"/>
	<span class="erreur"><?php print $x->erreurs['Time actuel'];?></span><br/>
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
<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">ENREGISTRER UN CONVERSION</div>
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
//Page générée automatiquement par quickApp V 2.0 :(Copyright: Armand Kouassi, @krak225, krak225@gmail.com, +225 08779408), le 19-05-2019 à 16:22:00  
	$info='<div class="default-info">Renseignez tous les champs puis cliquez sur <b>Valider</b> </div>';
		$user_id=null;$conversion_point=null;$conversion_taux=null;$total_points_duel=null;$conversion_date=null;
		
		$libelles=array("User","Point","Taux","Total points duel","Date","Code de sécurité");
		$extensionsvalides=array("jpg","gif","png","bmp");
		$imageDirectory="../images/upload-conversion/";
		$x=new krakVerification();
		$x->_initialiser();
		$x->InitLibelles($libelles);
		
		if(isset($_POST["add"])){ 
			extract($_POST);
			
			$user_id= securisedData($user_id);
			$conversion_point= securisedData($conversion_point);
			$conversion_taux= securisedData($conversion_taux);
			$total_points_duel= securisedData($total_points_duel);
			$conversion_date= securisedData($conversion_date);
			
				$x->verifierNombre($user_id,"User",0,100000000000000000000000,1);
				$x->verifierNombre($conversion_point,"Point",0,100000000000000000000000,1);
				$x->verifierNombre($total_points_duel,"Total points duel",0,100000000000000000000000,1);
			
			if($x->ToutEstCorrecte()){  
				$sql='INSERT INTO `conversion` (user_id,conversion_point,conversion_taux,total_points_duel,conversion_date) 
				VALUES ("'.$user_id.'","'.$conversion_point.'","'.$conversion_taux.'","'.$total_points_duel.'","'.$conversion_date.'")';

				//if(mysql_query($sql)){

				$stm = $db->pdo->prepare($sql);

				if($stm->execute()){

					$info='<div class="succes">Enregistrement effectué avec succès</div>'; 
					
					//initialiser les variables
					$user_id=null;$conversion_point=null;$conversion_taux=null;$total_points_duel=null;$conversion_date=null;
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
	<form id="form-conversion" enctype="multipart/form-data" method="post" data-creator="kw-Builder">
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
	<label>Point</label>
	<input class="champ" type="text" name="conversion_point" id="conversion_point" value="<?php print $conversion_point;?>"/>
	<span class="erreur"><?php print $x->erreurs['Point'];?></span><br/>
	<label>Taux</label>
	<input class="champ" type="text" name="conversion_taux" id="conversion_taux" value="<?php print $conversion_taux;?>"/>
	<span class="erreur"><?php print $x->erreurs['Taux'];?></span><br/>
	<label>Total points duel</label>
	<input class="champ" type="text" name="total_points_duel" id="total_points_duel" value="<?php print $total_points_duel;?>"/>
	<span class="erreur"><?php print $x->erreurs['Total points duel'];?></span><br/>
	<label>Date</label>
	<input class="champ" type="text" name="conversion_date" id="conversion_date" value="<?php print $conversion_date;?>"/>
	<span class="erreur"><?php print $x->erreurs['Date'];?></span><br/>
</fieldset>
	<fieldset>
		<input type="submit" name="add" class="btn btn_valider" value="Valider"/>
	</fieldset>
	</form>

	</div>
	</div>
	</div>

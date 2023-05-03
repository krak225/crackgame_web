<div class="leftbox" id="" style="padding:0px;">
			<div class="blocTitle">DÉTAILS D'UN LANGUE</div>
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
	
	$sql='select * from langue
	where langue_id="'.$id.'"';
	//$req=mysql_query($sql);
	//$d=mysql_fetch_object($req);

	$stm = $db->pdo->prepare($sql);
	$stm->execute();
	$d = $stm->fetch(PDO::FETCH_OBJ);
	?>
	<label>Code</label>
	<div><?php print $d->langue_code;?></div>
	<label>Libelle</label>
	<div><?php print $d->langue_libelle;?></div>
	<label>Drapeau</label>
	<div><?php print $d->langue_drapeau;?></div>


	</div>
	</div>
	</div>
<?php
	}else{
		print "Données non trouvées";
	} 
	?>
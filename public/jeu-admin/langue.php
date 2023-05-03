
<?php require_once("inc/head_std.php");?>

<!-- debut du contenu de la page -->
	<div id="pageContent">
	
		<!-- debut de la partie modifiable -->
		<div class="r-box" id="r-box-3">
			<!--<div class="box-title"><div class="vert"><?php //print "le titre de la page";?></div></div>-->
			<div class="box-content">
				<?php
					$sm=array("editer","modifier","gerer","detail","corbeille");
					$html=(isset($_GET["page"]) and in_array($_GET["page"],$sm)) ?  $_GET["page"] : "gerer";
					
					require_once("modules/mod-langue/langue-".$html.".php");
					
				?>
			</div>
		</div>
		<!-- fin de la partie modifiable -->
		
	</div>
	
	<!-- fin du contenu de la page -->
<?php require_once("inc/foot_std.php"); ?>
		
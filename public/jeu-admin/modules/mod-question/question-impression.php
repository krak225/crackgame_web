
<?php
include("modules/printer/fpdf17/fpdf.php");
require_once("fonctions/fonctions.php");
connexionDB();

class PDF extends FPDF
{
	// En-tête
	function Header()
	{
		// Logo
		$this->Image("images/logo_footer.png",10,6,15);
		// Police Arial gras 15
		$this->SetFont("Arial","B",15);
		// Décalage à droite
		$this->Cell(80);
		// Titre
		$this->Cell(30,10,"LISTE DES QUESTIONS",2,0,"C");
		// Saut de ligne
		$this->Ln(20);
	}

	// Pied de page
	function Footer()
	{
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont("Arial","I",8);
		// Numéro de page
		$this->Cell(0,10,"Page ".$this->PageNo()."/{nb}",0,0,"R");
	}
}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","B",12);

//LA REQUETE
$sql="select * from question";
$req = mysql_query($sql) or die(mysql_error());$n = mysql_num_rows($req);

//l'entete
$pdf->Cell(0,8,"",0,1);
$pdf->Cell(13.571428571429,8 ,"Id", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"User", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Fr", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"En", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Proposition_a_fr", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Proposition_a_en", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Proposition_b_fr", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Proposition_b_en", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Proposition_c_fr", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Proposition_c_en", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Reponse", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Categorie", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Statut_selection", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Statut_selection_chap", 1, 0, "C",0, "");
$pdf->Cell(13.571428571429,8 ,"Statut", 1, 0, "C",0, "");

//le contenu
$pdf->SetFont("Arial","",12);
while($d=mysql_fetch_object($req)){
	// debug($d);
	$pdf->Cell(0,8,"",0,1);
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->id), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->user_id), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->question_fr), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->question_en), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->proposition_a_fr), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->proposition_a_en), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->proposition_b_fr), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->proposition_b_en), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->proposition_c_fr), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->proposition_c_en), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->reponse), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->categorie_id), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->statut_selection), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->statut_selection_chap), 1, 0, "C",0, "");
	$pdf->Cell(13.571428571429,8 ,utf8_decode($d->statut), 1, 0, "C",0, "");
	
}

//
$pdf->Output();

?>
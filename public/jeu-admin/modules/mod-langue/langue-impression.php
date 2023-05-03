
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
		$this->Cell(30,10,"LISTE DES LANGUES",2,0,"C");
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
$sql="select * from langue";
$req = mysql_query($sql) or die(mysql_error());$n = mysql_num_rows($req);

//l'entete
$pdf->Cell(0,8,"",0,1);
$pdf->Cell(63.333333333333,8 ,"Code", 1, 0, "C",0, "");
$pdf->Cell(63.333333333333,8 ,"Libelle", 1, 0, "C",0, "");
$pdf->Cell(63.333333333333,8 ,"Drapeau", 1, 0, "C",0, "");

//le contenu
$pdf->SetFont("Arial","",12);
while($d=mysql_fetch_object($req)){
	// debug($d);
	$pdf->Cell(0,8,"",0,1);
	$pdf->Cell(63.333333333333,8 ,utf8_decode($d->langue_code), 1, 0, "C",0, "");
	$pdf->Cell(63.333333333333,8 ,utf8_decode($d->langue_libelle), 1, 0, "C",0, "");
	$pdf->Cell(63.333333333333,8 ,utf8_decode($d->langue_drapeau), 1, 0, "C",0, "");
	
}

//
$pdf->Output();

?>
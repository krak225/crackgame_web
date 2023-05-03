
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
		$this->Cell(30,10,"LISTE DES USERSS",2,0,"C");
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
$sql="select * from users";
$req = mysql_query($sql) or die(mysql_error());$n = mysql_num_rows($req);

//l'entete
$pdf->Cell(0,8,"",0,1);
$pdf->Cell(5,8 ,"Id", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Profil", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Nom", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Prenoms", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Sexe", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Date_naissance", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Telephone", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Adresse_email", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Pseudo", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Adresse", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Code_postal", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Ville", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Pays_origine", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Pays_residence", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Photo", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Lang_code", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Lang_libelle", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Devise", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Total_points", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Total_points_test", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Total_points_duel", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Score_general", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Souscription", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Jocker_question", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Jocker_duel", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Jocker_jeu", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Money", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Email", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Password", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Remember_token", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Parrain", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Created_at", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Updated_at", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Statut", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Statut_abonnement", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Statut_abonnement_chap", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Statut_matrice", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Statut_connexion", 1, 0, "C",0, "");
$pdf->Cell(5,8 ,"Communaute", 1, 0, "C",0, "");

//le contenu
$pdf->SetFont("Arial","",12);
while($d=mysql_fetch_object($req)){
	// debug($d);
	$pdf->Cell(0,8,"",0,1);
	$pdf->Cell(5,8 ,utf8_decode($d->id), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->profil_id), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->nom), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->prenoms), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->sexe), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->date_naissance), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->telephone), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->adresse_email), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->pseudo), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->adresse), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->code_postal), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->ville), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->pays_origine_id), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->pays_residence_id), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->photo), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->lang_code), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->lang_libelle), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->devise), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->total_points), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->total_points_test), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->total_points_duel), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->score_general), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->souscription), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->jocker_question), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->jocker_duel), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->jocker_jeu), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->money), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->email), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->password), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->remember_token), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->parrain), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->created_at), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->updated_at), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->statut), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->statut_abonnement), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->statut_abonnement_chap), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->statut_matrice), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->statut_connexion), 1, 0, "C",0, "");
	$pdf->Cell(5,8 ,utf8_decode($d->communaute), 1, 0, "C",0, "");
	
}

//
$pdf->Output();

?>
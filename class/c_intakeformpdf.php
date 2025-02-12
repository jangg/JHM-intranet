<?php
require_once '../tcpdf/tcpdf.php';
class IntakeformPDF extends TCPDF
{
	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'LogoJobHulpMaatjeZoetermeer.jpg';
		$this->Image($image_file, 23, 20, 35, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'b', 20);
		// Title
		$this->Cell(0, 15, 'JHMZ intakeformulier', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}
?>

<?php

namespace App\Http\Pdf;

use App\Modules\fpdf\FPDF;
use Illuminate\Support\Facades\Storage;

class FactureProforma extends FPDF
		{
		  function __construct($orientation, $units, $size){
		    parent::__construct($orientation, $units, $size);

		    $this->table_head = array('OBJET', 'VALIDITE', 'PRIX (FCFA)');
		    $this->column_widths = array(100, 39, 50);
		    $this->page_title = 'FACTURE PROFORMA';
		  }

		  function Header()
		  {
		      // Logo
		      $this->Image(public_path('/assets/images/logo.png'),10,6,32);
		      // Police Arial gras 15
		      $this->SetFont('Arial','B',15);
		      // Décalage à droite
		      $this->Cell(50);
		      // Titre
		      $this->Cell(100,10,$this->page_title,1,0,'C');
		      // Saut de ligne
		      $this->Ln(30);
		      $this->SetFont('Arial', '', 12);
		  }

		  function Table($data)
		  {
		      // Header
		      for($i=0;$i<count($this->table_head);$i++)
		          $this->Cell($this->column_widths[$i],7,$this->table_head[$i],1,0,'C');
		      $this->Ln();
		      // Data
		      foreach($data as $row)
		      {
		          $this->Cell($this->column_widths[0],8,$row[0],'LR');
		          $this->Cell($this->column_widths[1],8,$row[1],'LR');
		          $this->Cell($this->column_widths[2],8,number_format($row[2]),'LR',0,'R');
		          $this->Ln();
		      }
		      // Closing line
		      $this->Cell(array_sum($this->column_widths),0,'','T');
		  }

		  function InfoClient($client) {
		  	$this->writeLine('Nom: ' . $client->username);
		  	$this->writeLine('Entreprise: ' . $client->raison_sociale);
		  	$this->writeLine('Email: ' . $client->email);
		  	$this->writeLine('Numero de telephone: ' . $client->contact);
		  }

		  function writeLine(string $text) {
		    return $this->Cell(0, 7, $text, 0, 2);
		  }

		  function save() {
		  	$filename = "facture" . round(time()* rand(1,1000)) . '.pdf';
		  	$filepath = storage_path("app/public") . "/" . $filename;
		  	$file = $this->Output('F', $filepath);

		  	return $filepath;
		  }

		  function Signature() {
		  	$this->Image(public_path('/assets/images/tampon.jpg'),12,132,32);
		  }

		}
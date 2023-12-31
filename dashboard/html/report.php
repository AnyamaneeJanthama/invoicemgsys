<?php

use Mpdf\Tag\Tr;

include("connect.php");
require('../fpdf/fpdf.php');

class PDF extends FPDF

{
    function Header()
    {

        $this->AddFont('angsa', '', 'angsa.php');
        $this->SetFont('angsa', '', 20);
        $this->Cell(12);

        $this->Cell(100, 10, 'Products', 0, 1);

        //dummy cell to give line spacing
        //$this->Cell(0,5,'',0,1);
        //is equivalent to:
        $this->Ln(5);

        // $this->SetFont('Arial', 'B', 11);
        $this->AddFont('angsa', '', 'angsa.php');
        $this->SetFont('angsa', '', 18);

        $this->SetFillColor(150, 182, 197);
        $this->SetDrawColor(0, 0, 0);
        $this->Cell(20, 5, 'NO', 1, 0, 'C', true);
        $this->Cell(40, 5, 'Name', 1, 0, 'C', true);
        $this->Cell(85, 5, 'Desc', 1, 0, 'C', true);
        $this->Cell(25, 5, 'price', 1, 1, 'C', true);
    }
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P', 'mm', 'A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();

// $pdf->SetFont('Arial', '', 9);
$pdf->AddFont('angsa', '', '../fpdf/font/angsa.php');
$pdf->SetFont('angsa', '', 16);
$pdf->SetDrawColor(0, 0, 0);

$query = mysqli_query($conn, "select * from products");
while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(20, 5, $data['product_id'], 1, 0, 'C');
    $pdf->Cell(40, 5, $data['product_name'], 1, 0);
    $pdf->Cell(85, 5, $data['product_desc'], 1, 0);
    $pdf->Cell(25, 5, $data['product_price'], 1, 1, 'C');
}
$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', $data));
$pdf->Output('Myreport.pdf', 'F');

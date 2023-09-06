<?php
include 'connect.php';

require('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->AddFont('AngsanaNew', '', 'angsa.php');
$pdf->SetFont('AngsanaNew', '', 16);
$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', 'ข้อความ'));
$pdf->Output();

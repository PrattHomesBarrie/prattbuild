<?php
 require('includes/pdfClass/fpdf.php');
 
$pdf=new FPDF();
 $pdf->AddPage();
 $pdf->SetFont('Arial','B',16);
 $pdf->Cell(40,10,'Hello World!');
 $pdf->Output('test.pdf');
 header('Location: '.'test2.doc');
 exit;
 ?>
<?php
require_once './db_config.php';
require './fpdf/fpdf_download_catalogue.php';

$db = new DbConnection;

$category_name = $db->fetchCategoryDetails($_GET['category']);

$columnNames = json_decode($db->fetchTableColumnNames("product"));

$result = json_decode($db->fetchProductsForDownload($_GET['category']));

$pdf = new FPDF('P','mm','A4',$category_name['name']);
$pdf->AliasNbPages();
$pdf->AddPage();

// Set Header Of Page
	$pdf->SetTitle($category_name['name']);
// End Header of Page

// Any editing in this should also be copied in Cell() method for column headers on each page
	$pdf->SetFont('Arial', 'B', 10);

	$pdf->Cell(30,12,"Code Number",1,0,'C');
	$pdf->Cell(50,12,"Name",1,0,'C');
	//$pdf->Cell(50,12,"Image",1,0,'C');
	$pdf->Cell(40,12,"Vehicle",1,0,'C');
	$pdf->Cell(20,12,"Rate",1,0,'C');
	$pdf->Cell(20,12,"Per",1,0,'C');
	$pdf->Cell(30,12,"Min. Quantity",1,0,'C');
// Ends Any editing in this should also be copied in Cell() method for column headers on each page

$i=0;
foreach($result as $values){
	$i++;
	$j=0;

	$pdf->SetFont('Arial','',10);
	$pdf->Ln();
	if($i <= sizeof($result))
		foreach ($values as $key => $product_vals) {
			if($j == 0){
				$pdf->Cell(30,12,$product_vals,1,0,'C');
			}
			else if($j == 1){
				$pdf->MultiCell(50,12,$product_vals,1, 'L', false);

				$pdf->SetXY($pdf->GetX() + 50, $pdf->GetY() - 12);
			}
			else if($j == 2){
				//$pdf->Cell(50, 12, '', 1);
//				$pdf->Cell(50,12,$pdf->Image('C:\\xampp\\htdocs\\rr_sales_master\\master_2\\'.$product_vals, $pdf->GetX(), $pdf->GetY(), 33.78, 12, 'JPEG'), 1);
				
			}//file:///C://xampp/htdocs/rr_sales_master/master_2/
			if( $j == 3 ){
				$pdf->Cell(40,12,$product_vals,1,0,'C');
			}
			else if($j == 4 || $j == 5 ){
				$pdf->Cell(20,12,$product_vals,1,0,'C');
			}
			else if($j == 6){
				$pdf->Cell(30,12,$product_vals,1,0,'C');
			}
		
			$j++;
			//$pdf->Cell(90,12,$column_heading,1);
		};
}

$pdf->Output('I',$category_name['name'].".pdf");

?>
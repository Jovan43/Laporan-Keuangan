<?php
setlocale(LC_ALL, 'id_ID');
$data_month = $_GET['data_month'];
$data_income = $_GET['data_income'];
$data_outcome = $_GET['data_outcome'];
$data_profit = $_GET['data_profit'];
$month_name = date_format(date_create($_GET['data_month']), "F Y");

require('../assets/library/fpdf/fpdf.php');
include '../config/connect.php';

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 15);
$pdf->Cell(0, 10, 'LAPORAN KEUANGAN ' . strtoupper($month_name), 0, 0, 'C');
$pdf->Cell(10, 15, '', 0, 1);

$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(35, 7, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(35, 7, 'JENIS', 1, 0, 'C');
$pdf->Cell(40, 7, 'NAMA ITEM', 1, 0, 'C');
$pdf->Cell(35, 7, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(40, 7, 'TOTAL HARGA', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$data = mysqli_query($conn, "SELECT income_date AS 'date', 'Pemasukan' AS 'type', item_name, total_price, description FROM income WHERE DATE_FORMAT(income_date, '%Y-%m') = '$data_month' UNION ALL SELECT outcome_date, 'Pengeluaran', item_name, total_price, description FROM outcome WHERE DATE_FORMAT(outcome_date, '%Y-%m') = '$data_month' ORDER BY date DESC");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(35, 6, $d['date'], 1, 0);
    $pdf->Cell(35, 6, $d['type'], 1, 0);
    $pdf->Cell(40, 6, $d['item_name'], 1, 0);
    $pdf->Cell(35, 6, $d['description'], 1, 0);
    $pdf->Cell(40, 6, 'Rp' . number_format($d['total_price']), 1, 1, 'R');
}

$pdf->Cell(155, 6, 'Total Pemasukan bulan ' . $month_name, 1, 0, 'L');
$pdf->Cell(40, 6, 'Rp' . number_format($data_income), 1, 1, 'R');
$pdf->Cell(155, 6, 'Total Pengeluaran bulan ' . $month_name, 1, 0, 'L');
$pdf->Cell(40, 6, 'Rp' . number_format($data_outcome), 1, 1, 'R');
$pdf->Cell(155, 6, 'Total Keuntungan bulan ' . $month_name, 1, 0, 'L');
$pdf->Cell(40, 6,  $data_profit, 1, 1, 'R');

$pdf->Output('I', 'LAPORAN KEUANGAN ' . $month_name . '.pdf');

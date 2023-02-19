<?php

require('../assets/library/fpdf/fpdf.php');
include '../config/connect.php';

$res = $conn->query("SELECT (SELECT SUM(total_price) FROM outcome) AS total");
$data = $res->fetch_assoc();
if ($data['total'] == null) {
    $data_outcome = 'Rp0';
} else {
    $data_outcome = 'Rp' . number_format($data['total']);
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 15);
$pdf->Cell(0, 10, 'LAPORAN PENGELUARAN', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(35, 7, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(40, 7, 'NAMA ITEM', 1, 0, 'C');
$pdf->Cell(30, 7, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(45, 7, 'OPERATOR', 1, 0, 'C');
$pdf->Cell(35, 7, 'TOTAL HARGA', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$data = mysqli_query($conn, "SELECT outcome_id, outcome_date, item_name, total_price, description, user.name FROM outcome INNER JOIN user ON user.id = outcome.input_by");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(35, 6, $d['outcome_date'], 1, 0);
    $pdf->Cell(40, 6, $d['item_name'], 1, 0);
    $pdf->Cell(30, 6, $d['description'], 1, 0);
    $pdf->Cell(45, 6, $d['name'], 1, 0);
    $pdf->Cell(35, 6, 'Rp' . number_format($d['total_price']), 1, 1, 'R');
}

$pdf->Cell(160, 6, 'Total Pengeluaran', 1, 0, 'L');
$pdf->Cell(35, 6, $data_outcome, 1, 1, 'R');

$pdf->Output('I', 'LAPORAN PENGELUARAN.pdf');

<?php

require('../assets/library/fpdf/fpdf.php');
include '../config/connect.php';

$res = $conn->query("SELECT (SELECT SUM(total_price) FROM income) AS total");
$data = $res->fetch_assoc();
if ($data['total'] == null) {
    $data_income = 'Rp0';
} else {
    $data_income = 'Rp' . number_format($data['total']);
}

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 15);
$pdf->Cell(0, 10, 'LAPORAN PEMASUKAN', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(35, 7, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(40, 7, 'NAMA ITEM', 1, 0, 'C');
$pdf->Cell(25, 7, 'KUANTITAS', 1, 0, 'C');
$pdf->Cell(35, 7, 'HARGA ITEM', 1, 0, 'C');
$pdf->Cell(50, 7, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(45, 7, 'OPERATOR', 1, 0, 'C');
$pdf->Cell(35, 7, 'TOTAL HARGA', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$data = mysqli_query($conn, "SELECT income_id, income_date, item_name, quantity, item_price, total_price, description, user.name FROM income INNER JOIN user ON user.id = income.input_by");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(35, 6, $d['income_date'], 1, 0);
    $pdf->Cell(40, 6, $d['item_name'], 1, 0);
    $pdf->Cell(25, 6, $d['quantity'], 1, 0, 'C');
    $pdf->Cell(35, 6, 'Rp' . number_format($d['item_price']), 1, 0, 'R');
    $pdf->Cell(50, 6, $d['description'], 1, 0);
    $pdf->Cell(45, 6, $d['name'], 1, 0);
    $pdf->Cell(35, 6, 'Rp' . number_format($d['total_price']), 1, 1, 'R');
}

$pdf->Cell(240, 6, 'Total Pemasukan', 1, 0, 'L');
$pdf->Cell(35, 6, $data_income, 1, 1, 'R');


$pdf->Output('I', 'LAPORAN PEMASUKAN.pdf');

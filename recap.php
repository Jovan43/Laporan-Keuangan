<?php
include("layouts/header.php");
if (!isset($_GET['data_month'])) {
    $data_month = date('Y-m');
} else {
    $data_month = $_GET['data_month'];
}

$res = $conn->query("SELECT SUM(total_price) AS total_income FROM income WHERE DATE_FORMAT(income_date, '%Y-%m') = '$data_month'");
$data = $res->fetch_assoc();
if ($data['total_income'] == null) {
    $data_income = 0;
} else {
    $data_income = $data['total_income'];
}

$res = $conn->query("SELECT SUM(total_price) AS total_outcome FROM outcome WHERE DATE_FORMAT(outcome_date, '%Y-%m') = '$data_month'");
$data = $res->fetch_assoc();
if ($data['total_outcome'] == null) {
    $data_outcome = 0;
} else {
    $data_outcome = $data['total_outcome'];
}

$data_profit = $data_income - $data_outcome;
if ($data_profit < 0) {
    $data_profit = number_format($data_profit);
} else {
    $data_profit = "Rp" . number_format($data_profit);
}
?>

<div class="container-fluid">
    <h3 class="text-dark mb-4">Rekap Data</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="row float-end">
                <div class="col">
                    <input type="month" class="form-control" onchange="showRecap()" name="data_month" value="<?= $data_month ?>">
                </div>
                <div class="col">
                    <a href="function/recap_pdf.php?data_month=<?= $data_month ?>&data_profit=<?= $data_profit ?>&data_income=<?= $data_income ?>&data_outcome=<?= $data_outcome ?>" class="btn btn-danger"><i class="fa-solid fa-file-pdf me-2"></i>Export PDF</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Nama Item</th>
                            <th>Harga Item</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 1;
                        $sql = "SELECT income_date AS 'date', 'Pemasukan' AS 'type', item_name, total_price, description FROM income WHERE DATE_FORMAT(income_date, '%Y-%m') = '$data_month' UNION ALL SELECT outcome_date, 'Pengeluaran', item_name, total_price, description FROM outcome WHERE DATE_FORMAT(outcome_date, '%Y-%m') = '$data_month' ORDER BY date DESC";
                        $res = mysqli_query($conn, $sql) or exit("Error query: <b>" . $sql . "</b>.");
                        while ($data = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td><?= $num ?></td>
                                <td><?= date('d M Y H:i:s', strtotime($data['date'])); ?></td>
                                <td><?= $data['type'] ?></td>
                                <td><?= $data['item_name']; ?></td>
                                <td>Rp<?= number_format($data['total_price']); ?></td>
                                <td><?= $data['description']; ?></td>
                            </tr>
                        <?php
                            $num++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row text-center text-md-start">
                <div class="col-md-4 mb-2">
                    <p class="text-muted m-0">Total Pemasukan<br><b>Rp<?= number_format($data_income) ?></b></p>
                </div>
                <div class="col-md-4 mb-2">
                    <p class="text-muted m-0">Total Pengeluaran<br><b>Rp<?= number_format($data_outcome) ?></b></p>
                </div>
                <div class="col-md-4 mb-2">
                    <p class="text-muted m-0">Total Keuntungan<br><b><?= $data_profit ?></b></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function showRecap() {
        var data_month = document.getElementsByName('data_month')[0].value;
        window.location.href = "recap.php?data_month=" + data_month;
    }
</script>
<?php include("layouts/footer.php"); ?>
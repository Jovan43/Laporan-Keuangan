<?php include("layouts/header.php");

$res = $conn->query("SELECT SUM(total_price) AS total FROM income");
$data = $res->fetch_assoc();
if ($data['total'] == null) {
    $data_income = 'Rp0';
} else {
    $data_income = 'Rp' . number_format($data['total']);
}
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Daftar Pemasukan</h3>
    <?php
    if (isset($_SESSION['prod_message'])) {
        echo $_SESSION['prod_message'];
        unset($_SESSION['prod_message']);
    }
    ?>
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="float-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIncome">
                    Tambahkan Pemasukan
                </button>
                <a href="function/income_pdf.php" class="btn btn-danger"><i class="fa-solid fa-file-pdf me-2"></i>Export PDF</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Item</th>
                            <th>Kuantitas</th>
                            <th>Harga Item</th>
                            <th>Total Harga</th>
                            <th>Keterangan</th>
                            <th>Operator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 1;
                        $sql = "SELECT income_id, income_date, item_name, quantity, item_price, total_price, description, user.name FROM income INNER JOIN user ON user.id = income.input_by ORDER BY income_date DESC";
                        $res = mysqli_query($conn, $sql) or exit("Error query: <b>" . $sql . "</b>.");
                        while ($data = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td><?= $num ?></td>
                                <td><?= date('d M Y H:i:s', strtotime($data['income_date'])); ?></td>
                                <td><?= $data['item_name']; ?></td>
                                <td><?= $data['quantity']; ?></td>
                                <td>Rp<?= number_format($data['item_price']); ?></td>
                                <td>Rp<?= number_format($data['total_price']); ?></td>
                                <td><?= $data['description'] ?></td>
                                <td><?= $data['name']; ?></td>
                                <td><button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="edit_income.php?id=<?= $data['income_id']; ?>" class="dropdown-item">Memperbarui</a>
                                        <a href="function/delete_income.php?id=<?= $data['income_id']; ?>" class="dropdown-item">Hapus</a>
                                    </div>
                                </td>
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
            <div class="row">
                <div class="col">
                    <p class="text-muted m-0">Total Pemasukan adalah <b><?= $data_income ?></b></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="addIncome" tabindex="-1" aria-labelledby="addIncomeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addIncomeLabel">Menambahkan Pemasukan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="function/add_income.php" method="POST">
                    <div class="mb-3"><input type="text" class="form-control" placeholder="Nama Item" name="item_name" required></div>
                    <div class="mb-3"><input type="number" class="form-control" placeholder="Kuantitas Item" name="quantity" required></div>
                    <div class="mb-3 input-group"><span class="input-group-text">Rp</span><input type="number" class="form-control" placeholder="Harga Item" name="item_price" required></div>
                    <div class="mb-3 input-group"><span class="input-group-text">Rp</span><input type="number" class="form-control" placeholder="Total Harga" name="total_price" required></div>
                    <div class="mb-3"><textarea class="form-control" placeholder="Keterangan" name="description"></textarea></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" name="submit" type="submit">Tambahkan Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("layouts/footer.php"); ?>
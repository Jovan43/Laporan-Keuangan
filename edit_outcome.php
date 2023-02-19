<?php
include("layouts/header.php");
?>
<div class="container-fluid">
  <h3 class="text-dark mb-4">Memperbarui Item Pengeluaran</h3>
  <div class="row justify-content-center">
    <div class="col-xl-4">
      <div class="card shadow mb-5">
        <div class="card-header py-3">
          <p class="text-primary m-0 fw-bold">Informasi Item</p>
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <?php
            $sql = "SELECT * FROM outcome WHERE outcome_id =" . $_GET['id'] . ";";
            $hasil = mysqli_query($conn, $sql) or exit("Error query: <b>" . $sql . "</b>.");
            while ($data = mysqli_fetch_assoc($hasil)) {
            ?>
              <div class="mb-3">
                <label class="form-label">Nama Item</label>
                <input type="text" class="form-control" name="item_name" value="<?= $data['item_name'] ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" class="form-control" name="total_price" value="<?= $data['total_price'] ?>" required>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" name="description" required><?= $data['description'] ?></textarea>
              </div>
              <button class="btn btn-primary w-100" name="submit" type="submit">Perbarui Item</button>
            <?php
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
include("layouts/footer.php");

if (isset($_POST['submit'])) {
  $outcome_id = $_GET['id'];
  $item_name = addslashes($_POST['item_name']);
  $total_price = $_POST['total_price'];
  $description = $_POST['description'];
  $user_id = $_SESSION['user']['id'];

  $sql = "UPDATE outcome SET item_name='$item_name', total_price=$total_price, description='$description', input_by=$user_id WHERE outcome_id=$outcome_id";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['prod_message'] = "<div class='alert alert-success alert-dismissible fade show justify-content-center' role='alert'>Berhasil memperbarui item<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    echo "<script>location='outcome.php';</script>";
  } else {
    $_SESSION['prod_message'] = "<div class='alert alert-danger alert-dismissible fade show justify-content-center' role='alert'>Gagal memperbarui item<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    echo "<script>location='outcome.php';</script>";
  }
}
?>
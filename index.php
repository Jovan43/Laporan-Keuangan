<?php include("layouts/header.php"); ?>
<div class="container-fluid">
  <div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Dashboard</h3>
  </div>
  <div class="row">
    <div class="col-md-6 col-xl-4 mb-4">
      <div class="card shadow border-start-warning py-2">
        <a href="income.php" class="card-body text-decoration-none">
          <div class="row align-items-center no-gutters">
            <div class="col me-2">
              <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Pemasukan (Hari)</span></div>
              <div class="text-dark fw-bold h5 mb-0"><span>
                  <?php
                  $res = $conn->query("SELECT SUM(total_price) as total FROM income WHERE DATE(income_date)=CURDATE()");
                  $data = $res->fetch_assoc();
                  if ($data['total'] == null) {
                    echo 'Rp0';
                  } else {
                    echo 'Rp' . number_format($data['total']);
                  }
                  ?>
                </span></div>
            </div>
            <div class="col-auto"><i class="fa-solid fa-file-circle-plus fa-2x text-gray-300"></i> </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-4">
      <div class="card shadow border-start-success py-2">
        <a href="/income.php" class="card-body text-decoration-none">
          <div class="row align-items-center no-gutters">
            <div class="col me-2">
              <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Pemasukan (Bulan)</span></div>
              <div class="text-dark fw-bold h5 mb-0"><span>
                  <?php
                  $res = $conn->query("SELECT SUM(total_price) as total FROM income WHERE MONTH(income_date)=MONTH(CURDATE())");
                  $data = $res->fetch_assoc();
                  if ($data['total'] == null) {
                    echo 'Rp0';
                  } else {
                    echo 'Rp' . number_format($data['total']);
                  }
                  ?>
                </span></div>
            </div>
            <div class="col-auto"><i class="fa-solid fa-calendar-plus fa-2x text-gray-300"></i></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-4">
      <div class="card shadow border-start-warning py-2">
        <a href="/income.php" class="card-body text-decoration-none">
          <div class="row align-items-center no-gutters">
            <div class="col me-2">
              <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Pemasukan</span></div>
              <div class="text-dark fw-bold h5 mb-0"><span>
                  <?php
                  $res = $conn->query("SELECT SUM(total_price) as total FROM income");
                  $data = $res->fetch_assoc();
                  if ($data['total'] == null) {
                    echo 'Rp0';
                  } else {
                    echo 'Rp' . number_format($data['total']);
                  }
                  ?>
                </span></div>
            </div>
            <div class="col-auto"><i class="fa-solid fa-file-import fa-2x text-gray-300"></i></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-4">
      <div class="card shadow border-start-primary py-2">
        <a href="/outcome.php" class="card-body text-decoration-none">
          <div class="row align-items-center no-gutters">
            <div class="col me-2">
              <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pengeluaran (Hari)</span></div>
              <div class="text-dark fw-bold h5 mb-0"><span>
                  <?php
                  $res = $conn->query("SELECT SUM(total_price) as total FROM outcome WHERE DATE(outcome_date)=CURDATE()");
                  $data = $res->fetch_assoc();
                  if ($data['total'] == null) {
                    echo 'Rp0';
                  } else {
                    echo 'Rp' . number_format($data['total']);
                  }
                  ?>
                </span></div>
            </div>
            <div class="col-auto"><i class="fa-solid fa-file-circle-minus fa-2x text-gray-300"></i></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-4">
      <div class="card shadow border-start-warning py-2">
        <a href="/outcome.php" class="card-body text-decoration-none">
          <div class="row align-items-center no-gutters">
            <div class="col me-2">
              <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pengeluaran (Bulan)</span></div>
              <div class="text-dark fw-bold h5 mb-0"><span>
                  <?php
                  $res = $conn->query("SELECT SUM(total_price) as total FROM outcome WHERE MONTH(outcome_date)=MONTH(CURDATE())");
                  $data = $res->fetch_assoc();
                  if ($data['total'] == null) {
                    echo 'Rp0';
                  } else {
                    echo 'Rp' . number_format($data['total']);
                  }
                  ?>
                </span></div>
            </div>
            <div class="col-auto"><i class="fa-solid fa-calendar-minus fa-2x text-gray-300"></i></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-4">
      <div class="card shadow border-start-warning py-2">
        <a href="outcome.php" class="card-body text-decoration-none">
          <div class="row align-items-center no-gutters">
            <div class="col me-2">
              <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Total Pengeluaran</span></div>
              <div class="text-dark fw-bold h5 mb-0"><span>
                  <?php
                  $res = $conn->query("SELECT SUM(total_price) as total FROM outcome");
                  $data = $res->fetch_assoc();
                  if ($data['total'] == null) {
                    echo 'Rp0';
                  } else {
                    echo 'Rp' . number_format($data['total']);
                  }
                  ?>
                </span></div>
            </div>
            <div class="col-auto"><i class="fa-solid fa-file-export fa-2x text-gray-300"></i></div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<?php include("layouts/footer.php"); ?>
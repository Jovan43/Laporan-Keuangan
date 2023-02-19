<?php
include("config/connect.php");
session_start();

if (!isset($_SESSION['user'])) {
  echo "<script>location='main.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Laporan Keuangan</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.css" />
</head>

<body id="page-top">
  <div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
      <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="/">
          <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-mug-hot"></i></div>
          <div class="sidebar-brand-text text-wrap mx-3"><span>KONTEKSTUAL KOPI</span></div>
        </a>
        <hr class="sidebar-divider my-0" />
        <ul class="navbar-nav text-light" id="accordionSidebar">
          <li class="nav-item">
            <a class="nav-link" href="/"><i class="fa-solid fa-gauge"></i></i><span>Halaman</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="income.php"><i class="fa-solid fa-file-circle-plus"></i><span>Pemasukan</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="outcome.php"><i class="fa-solid fa-file-circle-minus"></i><span>Pengeluaran</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="recap.php"><i class="fa-solid fa-file-circle-check"></i><span>Rekap Data</span></a>
          </li>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
      </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
          <div class="container-fluid">
            <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav flex-nowrap ms-auto">
              <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                  <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="me-2 text-gray-600 small"><?= $_SESSION['user']['name'] ?></span><i class="fas fa-user-circle fa-2x"></i></a>
                  <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                    <a class="dropdown-item" href="function/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
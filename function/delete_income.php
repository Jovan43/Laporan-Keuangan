<?php
include("../config/connect.php");
$sql = "DELETE FROM income WHERE income_id =" . $_GET['id'] . ";";
$query = mysqli_query($conn, $sql) or exit("Error query : <b>" . $sql . "</b>.");

if ($query->connect_errno) {
  echo "Koneksi database gagal: " . $query->connect_error;
  exit();
} else {
  session_start();
  $_SESSION['prod_message'] = "<div class='alert alert-danger alert-dismissible fade show justify-content-center' role='alert'>Berhasil menghapus item<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
  header("Location: ../income.php");
  die();
}

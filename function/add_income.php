<?php
include("../config/connect.php");
session_start();

if (!isset($_SESSION['user'])) {
  echo "<script>location='login.php';</script>";
}

if (isset($_POST['submit'])) {
  $income_date = date('Y-m-d H:i:s');
  $item_name = addslashes($_POST['item_name']);
  $quantity = $_POST['quantity'];
  $item_price = $_POST['item_price'];
  $total_price = $_POST['total_price'];
  $description = $_POST['description'];
  $user_id = $_SESSION['user']['id'];

  $sql = "INSERT INTO income (income_date, item_name, quantity, item_price, total_price, description, input_by) VALUES ('$income_date', '$item_name', $quantity, $item_price, $total_price, '$description', '$user_id')";
  $res = mysqli_query($conn, $sql) or exit("Error query : <b>" . $sql . "</b>.");

  if ($res == true) {
    $_SESSION['prod_message'] = "<div class='alert alert-success alert-dismissible fade show justify-content-center' role='alert'>Item berhasil ditambahkan<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    echo "<script>location='../income.php';</script>";
  } else {
    $_SESSION['prod_message'] = "<div class='alert alert-danger alert-dismissible fade show justify-content-center' role='alert'>Gagal menambahkan item<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    echo "<script>location='../income.php';</script>";
  }
}

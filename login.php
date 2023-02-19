<?php
include("config/connect.php");
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-lg o-hidden border-0 my-5 ">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-4">Sign In</h4>
                  </div>
                  <form class="user" action="" method="POST">
                    <?php
                    if (isset($_SESSION['login'])) {
                      echo $_SESSION['login'];
                      unset($_SESSION['login']);
                    }
                    ?>
                    <div class="mb-3"><input class="form-control form-control-user" type="text" placeholder="Username" name="user" autofocus /></div>
                    <div class="mb-3"><input class="form-control form-control-user" type="password" placeholder="Password" name="password" /></div>
                    <button class="btn btn-primary d-block btn-user w-100" name="submit" type="submit">Login</button>
                    <hr />
                  </form>
                  <p class="text-center">Copyright © Kontekstual Kopi <?= date('Y') ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
  $user = $_POST['user'];
  $pass = $_POST['password'];

  $sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
  $res = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($res);
  $data = mysqli_fetch_assoc($res);

  if ($count == 1) {
    $_SESSION['user'] = $data;
    header('location:../index.php');
  } else {
    $_SESSION['login'] = "<div class='alert alert-danger mb-3' role='alert'>Email or Password did not match.</div>";
    header('location:../login.php');
  }
}

?>
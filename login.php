<?php
session_start();
require "functions.php";
  //cek cookie
  if (isset($_COOKIE["key"]) && isset($_COOKIE["id"])) {
    $key = $_COOKIE["key"];
    $id = $_COOKIE["id"];

    //ambil data didatabase
    $result = mysqli_query($conn, "SELECT email FROM users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    //cek cookie
    if ($key === (hash('sha256', $row['$email']))) {
      $_SESSION['login'] = true;
    }
  }

  if (isset($_SESSION['login'])) {
    header("Location : index.php");
    exit;
  }

  if (isset($_POST["masuk"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    //cek email jika ada ambil data
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      //cek password
      if (password_verify($password, $row["password"])){
        //set session
        $_SESSION["login"] = true;

        //cek remember me
        if (isset($_POST["remember"])) {
          //generate cookie ambil dari database
          setcookie('key', (hash('sha256', $row['email'], time() + 3600)));
          setcookie('id', $row['id'], time() + 3600);
        }
        //redirect
        echo "<script>
            alert('berhasil masuk');
            document.location.href='index.php';
        </script>";
        exit;
      } 
    }
    $error = true;
  }
?>
<html>
<head>
<title>login</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"><style>
    div.table{
        width : 20%;
        margin : auto;
    }
</style>
</head>
<body>
<br><br>
<h2 align="center">Login</h2><br><br>
<div class="table">
<form action="" method="POST">
  <?php if (isset($error)) : ?>
    <p style="color: red; font-style: italic;"> email atau password yang dimasukkan salah</p>
  <?php  endif; ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="form-group">
    <input type="checkbox" name="remember"> <label>Remember me</label>
  </div>
  <div>
    <button type="submit" name="masuk" class="btn btn-primary">Masuk</button>
    Belum punya akun? Silahkan <a href="register.php">Daftar</a>
  </div>
</form>
</div>
</body>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
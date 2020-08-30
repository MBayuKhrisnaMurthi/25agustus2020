<?php
require "functions.php";

if (isset($_POST["daftar"])) {
    if (daftar($_POST) > 0) {
        echo "<script>
                alert('akun berhasil ditambahkan');
                document.location.href='login.php';
        </script>";
    } else {
        echo "<script>
                alert('akun gagal ditambahkan');
        </script>";
    }
}
?>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"><style>
    div.table{
        width : 20%;
        margin : auto;
    }
</style>
</head>
<body>
<br><br>
<h2 align="center">Register</h2><br><br>
<div class="table">
    <form action="" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="input" class="form-control">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input name="password" type="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Retype Password</label>
        <input name="password2" type="password" class="form-control">
    </div>
    <div>
        <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
        Sudah punya akun? Silahkan <a href="login.php">Masuk</a>
    </div>
    </form>
</div>
</body>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
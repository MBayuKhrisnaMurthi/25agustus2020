<?php
session_start();
require "../functions.php";
//cek session
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}

    if (isset($_POST["tambah"])) {

        // var_dump($_FILES);
        // die;

        if (tambahkategori($_POST) > 0) {
            echo "<script>
                alert('data sudah berhasil ditambah');
                document.location.href='kategori.php';
            </script>";
        } else {
            echo "<script>
                alert('data gagal ditambah');
            </script>";
        }
    }
?>
<html>
<head>
    <title>Tambah</title>
    <style>
    div.table{
        width : 60%;
        margin : 20px;
    }
    </style>
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css"></head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="table">
    
    <h2>Tambah Kategori</h2><br>
    <a href="kategori.php">Kembali</a><br><br>
        <div>
            <label>Nama Kategori</label>
            <input name="kategori" type="text" class="form-control" autocomplete="off" required>
        </div><br>
        <button type="submit" name="tambah" class="btn btn-primary">Submit</button>
    </div>
</form>
</body>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</html>
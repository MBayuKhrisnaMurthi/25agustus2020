<?php
session_start();
//cek session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require "functions.php";

    if (isset($_POST["tambah"])) {

        // var_dump($_FILES);
        // die;

        if (tambah($_POST) > 0) {
            echo "<script>
                alert('data sudah berhasil ditambah');
                document.location.href='index.php';
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
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"></head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="table">
    
    <h2>Tambah Barang</h2><br>
    <a href="index.php">Kembali</a><br><br>
        <div>
            <label>Gambar</label>
            <input name="gambar" type="file" class="form-control" required>
        </div>
        <div>
            <label>Nama</label>
            <input name="nama" type="text" class="form-control" required>
        </div><div>
            <label>Kategori</label>
            <input name="kategori" type="text" class="form-control" required>
        </div><div>
            <label>Harga</label>
            <input name="harga" type="text" class="form-control" required>
        </div><div>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="4" cols="162" required></textarea>
        </div><br>
        <button type="submit" name="tambah" class="btn btn-primary">Submit</button>
    </div>
</form>
</body>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
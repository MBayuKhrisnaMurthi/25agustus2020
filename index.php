<?php
session_start();
require "functions.php";

//cek session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
    //ketika klik kata pencarian
    if (isset($_POST["cari"])) {
        $barang = cari($_POST["katacari"]);
    } else {
        $barang = query("SELECT barang.id, barang.nama, barang.harga, kategori.kategori FROM barang
                        LEFT JOIN kategori ON kategori.kategoriid=barang.kategoriid");
    }
?>
<html>
<head>
<title>Index</title>
<style>
    div.table{
        width : 70%;
        margin : auto;
    }

    @media print{
        .logout, .tambah, .form-cari, .aksi {
            display: none;
        }
    }
</style>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>
<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Toko Buku</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="kategori/kategori.php">Data Kategori</a>
        </li>
        </ul>
        <span class="navbar-text">
            <a href="logout.php" class="logout" align="right">Keluar</a>
        </span>
    </div>
    </nav>
    <!-- end header -->
    <div class="table">
    <br>
    <h2 align="center">Data Barang</h2>

    <div style="text-align: right">
        
    </div>

    <div class="tambah">
        <a href="tambah.php" class="btn btn-primary" class="tambah">Tambah</a><br><br>
    </div>
<!-- fungsi cari -->
<form action="" method="POST" class="form-cari">
    <input type="text" name="katacari" size= "30" autocomplete="off" autofocus placeholder="Masukkan kata pencarian..">
    <button type="submit" name="cari">Cari</button>
</form>
    <table class="table" border="1">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="width:50px">No</th>
                <th scope="col" style="width:25%">Nama</th>
                <th scope="col" style="width:30%">Kategori</th>
                <th scope="col" style="width:25%">Harga</th>
                <th class="aksi" scope="col" style="width:70px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($barang as $brg) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $brg["nama"]; ?></td>
                <td><?= $brg["kategori"]; ?></td>
                <td><?= $brg["harga"]; ?></td>
                <td class="aksi">
                    <a href="ubah.php?id=<?= $brg["id"]; ?>" class="btn btn-warning">Ubah</a> | 
                    <a href="hapus.php?id=<?= $brg["id"]; ?>" class="btn btn-danger" onclick="return confirm('apakah ingin menghapusnya?')">Hapus</a></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
    </table>
</div>
</body>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
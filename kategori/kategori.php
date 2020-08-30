<?php
session_start();
require "../functions.php";

//cek session
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
    $kategori = query("SELECT * FROM kategori");
?>
<html>
<head>
<title>Index</title>
<style>
    div.table{
        width : 50%;
        margin : auto;
    }

    @media print{
        .logout, .tambah, .form-cari, .aksi {
            display: none;
        }
    }
</style>
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
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
            <a class="nav-link" href="../index.php">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="kategori.php">Data Kategori</a>
        </li>
        </ul>
        <span class="navbar-text">
            <a href="../logout.php" class="logout" align="right">Keluar</a>
        </span>
    </div>
    </nav>
    <!-- end header -->
    <div class="table">
    <br>
    <h2 align="center">Data Kategori</h2>
    <div class="tambah">
        <a href="tambah.php" class="btn btn-primary" class="tambah">Tambah</a><br><br>
    </div>

    <table class="table" border="1">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="width:10%">No</th>
                <th scope="col" style="width:70%">Nama</th>
                <th class="aksi" scope="col" style="width:70px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($kategori as $ktg) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $ktg["kategori"]; ?></td>
                <td class="aksi">
                    <a href="ubah.php?kategoriid=<?= $ktg["kategoriid"]; ?>" class="btn btn-warning">Ubah</a> | 
                    <a href="hapus.php?kategoriid=<?= $ktg["kategoriid"]; ?>" class="btn btn-danger" onclick="return confirm('apakah ingin menghapusnya?')">Hapus</a></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
    </table>
</div>
</body>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</html>
<?php
session_start();
//cek session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require "functions.php";

//ambil data sesuai id
$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
//disimpen di 1 row assoc
$row = mysqli_fetch_assoc($result);

    if (isset($_POST["ubah"])) {
        if (ubah($_POST) > 0) {
            echo "<script>
                alert('data sudah berhasil diubah');
                document.location.href='index.php';
            </script>";
        } else {
            echo "<script>
                alert('data gagal diubah');
            </script>";
        }
    }
?>
<html>
<head>
    <title>ubah</title>
    <style>
    div.table{
        width : 60%;
        margin : 20px;
    }
    </style>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="table">
    
    <h2>ubah Barang</h2><br>
    <a href="index.php">Kembali</a><br><br>
    <!--data id dan gambar lama -->
    <input type="hidden" name="id" value="<?= $row["id"]; ?>">
    <input type="hidden" name="gambarlama" value="<?=$row["gambar"] ?>">
        <div>
            <label>Gambar</label>
            <img src="img/<?= $row["gambar"]; ?>" alt="" width="200"><br><br>
            <label>Ubah Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <div>
            <label>Nama</label>
            <input name="nama" type="text" class="form-control" value="<?= $row["nama"] ?>" required>
        </div><div>
            <label>Kategori</label>
            <input name="kategori" type="text" class="form-control" value="<?= $row["kategori"] ?>" required>
        </div><div>
            <label>Harga</label>
            <input name="harga" type="text" class="form-control" value="<?= $row["harga"] ?>" required>
        </div><div>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" cols="162" rows="4" required><?= $row["deskripsi"] ?></textarea>
        </div><br>
        <button type="submit" name="ubah" class="btn btn-primary">Submit</button>
    </div>
</form>
</body>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
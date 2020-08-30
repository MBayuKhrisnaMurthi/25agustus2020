<?php
session_start();
//cek session
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}
require "../functions.php";

//ambil data sesuai id disimpan didalam row assoc
$id = $_GET["kategoriid"];
$result = mysqli_query($conn, "SELECT * FROM kategori WHERE kategoriid = $id");
$row = mysqli_fetch_assoc($result);

//ambil kategori
$kategori = query("SELECT * FROM kategori");

    if (isset($_POST["ubahkategori"])) {
        if (ubahkategori($_POST) > 0) {
            echo "<script>
                alert('data sudah berhasil diubah');
                document.location.href='kategori.php';
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
    <title>ubah kategori</title>
    <style>
    div.table{
        width : 60%;
        margin : 20px;
    }
    </style>
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
</head>
<body>
<form action="" method="POST">
    <div class="table">
    
    <h2>Ubah Kategori</h2><br>
    <a href="kategori.php">Kembali</a><br><br>
    <!--data id dan gambar lama -->
    <input type="hidden" name="kategoriid" value="<?= $row["kategoriid"]; ?>">
        <div>
            <label>Nama</label>
            <input name="kategori" type="text" class="form-control" value="<?= $row["kategori"] ?>" required>
        </div><br>
        <button type="submit" name="ubahkategori" class="btn btn-primary">Submit</button>
    </div>
</form>
</body>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</html>
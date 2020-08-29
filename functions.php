<?php
$conn = mysqli_connect("localhost", "root", "", "25ags");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    $kategori = htmlspecialchars($data["kategoriid"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO barang VALUES
    ('','$kategori','$nama','$harga','$deskripsi','$gambar')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload(){
    global $conn;
    $name = $_FILES["gambar"]["name"];
    $tmp_name = $_FILES["gambar"]["tmp_name"];
    $size = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    
    //cek sudah upload gambar atau belum
    if ($error === 4) {
        echo"<script>
            alert('silahkan pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    //cek yang dipuload gambar atau tidak
    $ekstensidisetujui = ["jpg", "jpeg", "png"];
    $ekstensi = explode('.', $name);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensidisetujui)) {
        echo"<script>
            alert('yg boleh diupload hanya gambar');
        </script>";
        return false;
    }

    //cek ukuran gambar
    if ($size > 2000000) {
        echo"<script>
            alert('ukuran maksimum foto 2mb');
        </script>";
        return false;
    }

    //pindahkan foto dan beri uniqid
    $name = uniqid();
    $name .= '.';
    $name .= $ekstensi;

    move_uploaded_file($tmp_name, 'img/'. $name);
    return $name;
}

function hapus($id){
    global $conn;
    $query = "DELETE FROM barang WHERE id = $id";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;
    $id = $data["id"];
    $kategori = htmlspecialchars($data["kategoriid"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    
    //jika ubah gambar
    if ($_FILES["gambar"]["error"] === 0) {
        $gambar = upload();
    }else{
        $gambar = $data["gambarlama"];
    }

    $query = "UPDATE barang SET 
                                kategoriid = '$kategori',
                                nama = '$nama',
                                harga = '$harga',
                                deskripsi = '$deskripsi',
                                gambar = '$gambar'
                                WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

}

function cari($katacari){
    $query = "SELECT * FROM barang WHERE
                nama LIKE '%$katacari%' OR
                kategori LIKE '%$katacari%'";
    return query($query);
}

function daftar($data){
    global $conn;
    $email = $data["email"];
    $password = $data["password"];
    $password2 = $data["password2"];
    $query = "SELECT email FROM users WHERE email='$email'";

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, $query);
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('email yang dimasukkan sudah ada');
        </script>";
        return false;
    }
    
    //cek password dan retype password sama
    if ($password !== $password2) {
        echo "<script>
            alert('password tidak sesuai');
        </script>";
        return false;
    }

    //enskrip password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //masukkan kedalam database
    $queryinput = "INSERT INTO users VALUES('', '$email', '$password')";
    mysqli_query($conn, $queryinput);
    return mysqli_affected_rows($conn);
}
?>
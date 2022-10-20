<?php

session_start(); 

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php'; 

//ambil data dari URL
$id =  $_GET["id"]; 


// query data siswa berdasarkan id
$swa = query("SELECT * FROM data_siswa WHERE id = $id")[0];



// cek apakah tombol submit  sudah ditekan atau belum
if (isset($_POST["submit"])) {
        
    //cek apakah data berhasil diubah atau gagal
    if ( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil diubah !');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'index.php';
        </script>
    ";
    }
 

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Siswa</title>
</head>
<body>
    <h1>Ubah Data Siswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $swa["id"]; ?>" >
        <input type="hidden" name="gambarLama" value="<?= $swa["Gambar"]; ?>" >
        <ul>
            <li>
                <label for="NIS">NIS : </label>
                <input type="text" name="NIS" id="NIS" required value="<?= $swa["NIS"]; ?>">
            </li>
            <br>
            <li>
            <label for="Nama">Nama : </label>
            <input type="text" name="Nama" id="Nama" required value="<?= $swa["Nama"]; ?>">
            </li>
            <br>
            <li>
            <label for="Email">Email : </label>
                <input type="text" name="Email" id="Email" required value="<?= $swa["Email"]; ?>">
            </li>
            <br>
            <li>
            <label for="Jurusan">Jurusan : </label>
                <input type="text" name="Jurusan" id="Jurusan" required value="<?= $swa["Jurusan"]; ?>">
            </li>
            <br>
            <li>
            <label for="Gambar">Gambar : </label> <br>
            <img src="img/<?= $swa['Gambar']; ?>" width="65"> <br>
                <input type="file" name="Gambar" id="Gambar">
                </li>
                <br>
                <li>
                    <button type="submit" name="submit">Ubah Data</button>
                </li>
        </xul>

    </form>
</body>
</html>
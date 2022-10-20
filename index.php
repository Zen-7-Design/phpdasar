<?php
 session_start(); 

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
$siswa = query("SELECT * FROM data_siswa");

// tombol ditekan
if ( isset($_POST["cari"]) ) {
    $siswa = cari($_POST["keyword"]); 
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
   
   <!-- Link to Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Link To CSS -->
    <link rel="stylesheet" href="global.css">

</head>

<body>
<div class="container">
    <h1 class="text-center mt-4">Daftar Siswa</h1>
    <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
    <a class="btn btn-success" href="tambah.php" role="button">Tambah Data Siswa</a>
    <a class="btn btn-warning" href="registrasi.php" role="button">Tambahkan User</a>
    <br><br>

    <form action="" method="post" >

    <!-- <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword atau nama..." autocomplete="off">
    <button type="submit" name="cari">Cari</button> -->

    <div class="input-group">
  <input type="search" class="form-control rounded" placeholder="Search" name="keyword" autofocus aria-label="Search" aria-describedby="search-addon" />
  <button type="submit" name="cari" class="btn btn-outline-primary">Cari</button>
</div>
    </form>
    <br>

    <table class="table table-striped"> 
        
        <tr>
            <th>No.</th>
            <th>Action</th>
            <th>Gambar</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

            <?php $i = 1; ?>
            <?php foreach( $siswa as $row )  : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
          
                <a class="btn btn-dark" href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
                <!-- <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah antum yakin?');">hapus</a> -->
                <a class="btn btn-danger" href="href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah antum yakin?');"" role="button">Hapus</a>
            </td>
            <td><img src="img/<?= $row["Gambar"]; ?>" alt="" width="75px"></td>
            <td><?= $row["NIS"]; ?></td>
            <td><?= $row["Nama"]; ?></td>
            <td><?= $row["Email"]; ?></td>
            <td><?= $row["Jurusan"]; ?></td>
        </tr>
        <?php $i++;  ?>
        <?php endforeach  ?>
    </table>


    <!-- Link JS To Bootsrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Link JS to boostrap icon -->
    </div>
</body>
</html>

 <!-- <tr>
            <td>1</td>
            <td>
                <a href="">Ubah</a> | 
                <a href="">Hapus</a>
            </td>
            <td><img src="img/index1.jpg" width="75px" height="75px" alt=""></td>
            <td>Thomas Shelby</td>
            <td>19-09-1988</td>
            <td>shelby@email.com</td>
        </tr>

        <tr>
            <td>2</td>
            <td>
                <a href="">Ubah</a> | 
                <a href="">Hapus</a>
            </td>
            <td><img src="img/index.jpg" width="75px" height="75px" alt=""></td>
            <td>Squidward</td>
            <td>08-02-1999</td>
            <td>Squidward@email.com</td>
        </tr>

        <tr>
            <td>3</td>
            <td>
                <a href="">Ubah</a> | 
                <a href="">Hapus</a>
            </td>
            <td><img src="img/index3.jpg" width="75px" height="75px" alt=""></td>
            <td>Mike Shrek</td>
            <td>05-12-2001</td>
            <td>shrek@email.com</td>
        </tr>

        <tr>
            <td>4</td>
            <td>
                <a href="">Ubah</a> | 
                <a href="">Hapus</a>
            </td>
            <td><img src="img/index4.jpg" width="75px" height="75px" alt=""></td>
            <td>Shrek Wazowski</td>
            <td>09-11-2011</td>
            <td>shrek@email.com</td>
        </tr>

        <tr>
            <td>5</td>
            <td>
                <a href="">Ubah</a> | 
                <a href="">Hapus</a>
            </td>
            <td><img src="img/index5.jpg" width="75px" height="75px" alt=""></td>
            <td>Amongus</td>
            <td>14-09-2001</td>
            <td>amongus@email.com</td>
        </tr>
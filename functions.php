<?php 
//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
//ambil data tiap elemen dari form
global $conn;
$NIS = htmlspecialchars($data["NIS"]);
$Nama = htmlspecialchars($data["Nama"]);
$Email = htmlspecialchars($data["Email"]);
$Jurusan = htmlspecialchars($data["Jurusan"]);

// upload gambar
$Gambar = upload();
if ( !$Gambar ) {
    return false;
}





//query insert data  
$query = "INSERT INTO data_siswa
VALUES
('', '$NIS', '$Nama', '$Email', '$Jurusan', '$Gambar') 
";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}


function upload() {
    
$namaFile = $_FILES['Gambar']['name'];
$ukuranFile = $_FILES['Gambar']['size'];
$error = $_FILES['Gambar']['error'];
$tmpName = $_FILES ['Gambar']['tmp_name'];


// cek apakah tidak ada gambar yang di upload
if ( $error === 4 ) {
echo "<script>
    alert('Pilih gambar terlebih dahulu');
</script>";

}


//cek apakah yang di upload adalah gambar
$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
$ekstensiGambar = explode('.', $namaFile);
$ekstensiGambar = strtolower(end($ekstensiGambar));
if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
    echo "<script>
    alert('Yang antum upload bukanlah gambar');
</script>";
return false;
}
// cek jika ukuran nya terlalu besar
if ( $ukuranFile > 1000000 ) {
    echo "<script>
    alert('Ukuran gambar antum terlalu besar');
</script>";
return false;
}


// lolos pengecekan, gambar siap diupload
// generate nama gambar baru

$namaFileBaru = uniqid();
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiGambar;


move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

return $namaFileBaru;

}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM data_siswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {

    $id = $data["id"];
    global $conn;
    $NIS = htmlspecialchars($data["NIS"]);
    $Nama = htmlspecialchars($data["Nama"]);
    $Email = htmlspecialchars($data["Email"]);
    $Jurusan = htmlspecialchars($data["Jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);


    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['Gambar']['error'] === 4 ) {
        $Gambar = $gambarLama;
    } else {
        $Gambar = upload();
    }

    
    //query insert data  
    $query = "UPDATE data_siswa SET
                NIS = '$NIS',
                Nama = '$Nama',
                Email = '$Email',
                Jurusan = '$Jurusan',
                Gambar = '$Gambar'
                    WHERE id = $id
                ";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);

}


function cari($keyword) {
    $query = "SELECT * FROM data_siswa
                WHERE 
                Nama LIKE '%$keyword%' OR
                NIS LIKE '%$keyword%' OR
                Email LIKE '%$keyword%' OR
                Jurusan LIKE '%$keyword%'

    ";

    return query($query);
}


function registrasi($data) {

    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if ( mysqli_fetch_assoc(($result)) ) {
        echo "<script>
    alert('Username yang dipilih sudah ada');
            </script>";
            return false;
    }


    //cek konfirmasi pasword 
    if ($password !== $password2) {
        echo "<script>
    alert('Konfirmasi password tidak sesuai');
    </script>";
return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);



}




?>
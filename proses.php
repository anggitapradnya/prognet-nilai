<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "penilaian_mahasiswa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$hasil = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];

    if ($nilai >= 80 && $nilai <= 100) {
        $kategori_nilai = "A";
    } elseif ($nilai >= 71 && $nilai < 80) {
        $kategori_nilai = "B+";
    } elseif ($nilai >= 65 && $nilai < 71) {
        $kategori_nilai = "B";
    } elseif ($nilai >= 60 && $nilai < 65) {
        $kategori_nilai = "C+";
    } elseif ($nilai >= 55 && $nilai < 60) {
        $kategori_nilai = "C";
    } elseif ($nilai >= 50 && $nilai < 55) {
        $kategori_nilai = "D+";
    } elseif ($nilai >= 40 && $nilai < 50) {
        $kategori_nilai = "D";
    } else {
        $kategori_nilai = "E";
    }

    $sql = "INSERT INTO mahasiswa (nama, nim, nilai_angka, kategori_nilai)
            VALUES ('$name', '$nim', '$nilai', '$kategori_nilai')";

    if ($conn->query($sql) === TRUE) {
        $hasil = "
        <div class='result'>
            <p>Nama: $name</p>
            <p>NIM: $nim</p>
            <p>Nilai Angka: $nilai</p>
            <p>Kategori Nilai: $kategori_nilai</p>
        </div>";
    } else {
        $hasil = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Hasil Penilaian Mahasiswa</h2>
    
    <?php 
    // Menampilkan hasil dari PHP
    if (isset($hasil)) {
        echo $hasil;
    }
    ?>

    <a href="index.html" class="back-button">Kembali</a>
</div>

</body>
</html>

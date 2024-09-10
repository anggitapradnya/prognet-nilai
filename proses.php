<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "penilaian_mahasiswa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];

    if ($nilai >= 85 && $nilai <= 100) {
        $kategori_nilai = "A";
    } elseif ($nilai >= 80 && $nilai < 85) {
        $kategori_nilai = "B+";
    } elseif ($nilai >= 70 && $nilai < 80) {
        $kategori_nilai = "B";
    } elseif ($nilai >= 65 && $nilai < 70) {
        $kategori_nilai = "C+";
    } elseif ($nilai >= 55 && $nilai < 65) {
        $kategori_nilai = "C";
    } elseif ($nilai >= 40 && $nilai < 55) {
        $kategori_nilai = "D";
    } else {
        $kategori_nilai = "E";
    }

    $sql = "INSERT INTO mahasiswa (nama, nim, nilai_angka, kategori_nilai)
            VALUES ('$name', '$nim', '$nilai', '$kategori_nilai')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='result'>";
        echo "<p>Nama: $name</p>";
        echo "<p>NIM: $nim</p>";
        echo "<p>Nilai Angka: $nilai</p>";
        echo "<p>Kategori Nilai: $kategori_nilai</p>";
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

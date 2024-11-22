<?php
// Class 
class Absensi {
    private $dataAbsensi = [];

    
    public function tambahAbsensi($nama, $nim, $jurusan, $mata_kuliah, $dosen, $kehadiran, $jam_belajar) {
        $this->dataAbsensi[] = [
            "nama" => $nama,
            "nim" => $nim,
            "jurusan" => $jurusan,
            "mata_kuliah" => $mata_kuliah,
            "dosen" => $dosen,
            "kehadiran" => $kehadiran,
            "jam_belajar" => $jam_belajar
        ];
    }

    // Fungsi 
    public function getDataAbsensi() {
        return $this->dataAbsensi;
    }
}


function validasiInput($nama, $nim, $jurusan, $mata_kuliah, $dosen) {
    if (preg_match('/\d/', $nama)) {
        return "Nama tidak boleh mengandung angka.";
    }
    if (!preg_match('/^\d+$/', $nim)) {
        return "NIM harus berupa angka.";
    }
    if (preg_match('/\d/', $jurusan)) {
        return "Jurusan tidak boleh mengandung angka.";
    }
    if (preg_match('/\d/', $mata_kuliah)) {
        return "Mata kuliah tidak boleh mengandung angka.";
    }
    if (preg_match('/\d/', $dosen)) {
        return "Dosen tidak boleh mengandung angka.";
    }
    return true;
}


$absensiObj = new Absensi();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $mata_kuliah = $_POST['mata_kuliah'];
    $dosen = $_POST['dosen'];
    $kehadiran = $_POST['kehadiran'];
    $jam_belajar = $_POST['jam_belajar'];

    
    $validasi = validasiInput($nama, $nim, $jurusan, $mata_kuliah, $dosen);
    if ($validasi === true) {
        
        $absensiObj->tambahAbsensi($nama, $nim, $jurusan, $mata_kuliah, $dosen, $kehadiran, $jam_belajar);
    } else {
        
        $error = $validasi;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: silver;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
        }

        form {
            background-color: #f4f4f4;
            padding: 35px;
            border-radius: 8px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: purple;
            color: rgb(250, 249, 249);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f8f8f8;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistem Absensi Mahasiswa</h2>

    <!-- Error Jika Ada -->
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    
    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>

        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" required>

        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" required>

        <label for="mata_kuliah">Mata Kuliah:</label>
        <input type="text" name="mata_kuliah" id="mata_kuliah" required>

        <label for="dosen">Dosen:</label>
        <input type="text" name="dosen" id="dosen" required>

        
        <label for="jam_belajar">Jam Belajar:</label>
        <select name="jam_belajar" id="jam_belajar" required>
            <option value="07:00-09:30">07:00-09:30</option>
            <option value="09:40-12:00">09:40-12:00</option>
            <option value="16:40-18:30">16:40-18:30</option>
        </select>

        <label for="kehadiran">Kehadiran:</label>
        <select name="kehadiran" id="kehadiran" required>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
        </select>

        <input type="submit" value="Submit Absensi">
    </form>

    
    <?php if (!empty($absensiObj->getDataAbsensi())): ?>
        <h3>Daftar Absensi</h3>
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Jam Belajar</th>
                <th>Kehadiran</th>
            </tr>
            <?php
            
            $dataAbsensi = $absensiObj->getDataAbsensi();
            
            //  for loop 
            for ($i = 0; $i < count($dataAbsensi); $i++) {
                echo "<tr>
                    <td>{$dataAbsensi[$i]['nama']}</td>
                    <td>{$dataAbsensi[$i]['nim']}</td>
                    <td>{$dataAbsensi[$i]['jurusan']}</td>
                    <td>{$dataAbsensi[$i]['mata_kuliah']}</td>
                    <td>{$dataAbsensi[$i]['dosen']}</td>
                    <td>{$dataAbsensi[$i]['jam_belajar']}</td>
                    <td>{$dataAbsensi[$i]['kehadiran']}</td>
                </tr>";
            }
            ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>

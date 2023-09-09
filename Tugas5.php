<!DOCTYPE html>
<html>
<head>
    <title>CRUD Sederhana</title>
    <style>

h1{
    text-align: center;
 }

 form{
       text-align: center;
    
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        background-color: #fff;
        
 }
 table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
 table, th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    // Koneksi ke database
    $koneksi = mysqli_connect("localhost", "root", "", "nama_database");

    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Tambah data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST["nama"];
        $jurusan = $_POST["jurusan"];
        $universitas = $_POST["universitas"];
        $sql = "INSERT INTO data_diri (nama, jurusan, universitas) VALUES ('$nama', '$jurusan', '$universitas')";
        $koneksi->query($sql);
    }

    // Hapus data
    if (isset($_GET["hapus"])) {
        $id = $_GET["hapus"];
        $sql = "DELETE FROM data_diri WHERE id = $id";
        $koneksi->query($sql);
    }

    // Tampilkan data
    $sql = "SELECT * FROM data_diri";
    $result = $koneksi->query($sql);
    ?>

    <h1>CRUD Sederhana</h1>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" required>
        <label for="universitas">universitas:</label>
        <input type="text" name="universitas" required>

        <button type="submit">Tambah</button>
        
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>universitas</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["jurusan"] . "</td>";
                echo "<td>" . $row["universitas"] . "</td>";
                echo "<td><a href='?hapus=" . $row["id"] . "'>Hapus</a></td>";
                echo "<td><a href='edit.php?id=" . $row ["id"] ."'>edit</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data.</td></tr>";
        }
        ?>
    </table>

    <?php
    // Tutup koneksi
    $koneksi->close();
    ?>
</body>
</html>
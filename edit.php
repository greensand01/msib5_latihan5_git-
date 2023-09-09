<?php

   // Membuat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "nama_database");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

    // Update
    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $universitas = $_POST['universitas'];

        // query untuk update data
        $query = mysqli_query($koneksi,
        "UPDATE data_diri SET nama='$nama', universitas='$universitas', jurusan='$jurusan' WHERE id='$id' ");

        header('Location: tugas5.php');
    }

    // Ambil data user
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM data_diri WHERE id='$id'");

    while($user_data = mysqli_fetch_array($query)) {
        $nama = $user_data['nama'];
        $jurusan = $user_data['jurusan'];
        $universitas = $user_data['universitas'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
}

.container {
  max-width: 800px;
  margin: 50px auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form input,{
  display: block;
  margin-bottom: 10px;
}

button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 15px;
  cursor: pointer;
  border-radius: 5px;
}

button:hover {
  background-color: #0056b3;
}


input[type="text"] {
    width: 300px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:hover {
    border-color: #333;
}

input[type="text"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
</style>
</head>
<body>
<a href="Tugas5.php">Kembali</a>
<div class="container">
    <form action="edit.php" method="POST" name="editUser">
        <table border="0">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?= $nama ?>"></td>
            </tr>
            <td>Jurusan</td>
                <td><input type="text" name="jurusan" value="<?= $jurusan ?>"></td>
            </tr>
            <tr>
                <td>universitas</td>
                <td><input type="text" name="universitas" value="<?= $universitas ?>"></td>
            </tr>
            <tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
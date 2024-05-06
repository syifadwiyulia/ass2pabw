<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang Ditemukan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Lokasi Penemuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Koneksi ke database
        $koneksi = mysqli_connect("localhost", "root", "", "datafound");

        // Periksa koneksi
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal: " . mysqli_connect_error();
            exit();
        }

        // Query untuk mengambil data dari tabel
        $query = "SELECT * FROM found_items";
        $result = mysqli_query($koneksi, $query);

        // Memasukkan data dari tabel ke dalam array
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['namabrg'] . "</td>";
            echo "<td>" . $row['deskripsi'] . "</td>";
            echo "<td>" . $row['lokasi_penemuan'] . "</td>";
            echo "<td><button onclick=\"hapusData(" . $row['id'] . ")\">Hapus</button></td>";
            echo "</tr>";
        }

        // Menutup koneksi
        mysqli_close($koneksi);
        ?>
    </tbody>
</table>

<script>
    function hapusData(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // Kirim permintaan AJAX untuk menghapus data
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Muat ulang halaman setelah menghapus data
                    location.reload();
                }
            };
            xhr.open("GET", "hapus_data.php?id=" + id, true);
            xhr.send();
        }
    }
</script>

</body>
</html>

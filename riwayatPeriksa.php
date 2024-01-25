<?php
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Periksa</title>
    <!-- Tambahkan Bootstrap CSS jika belum ada -->
    <!-- <link rel="stylesheet" href="path/to/bootstrap.css"> -->
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Riwayat Periksa</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>Obat</th>
                    <th>Tanggal Periksa</th>
                    <th>Biaya Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $riwayats = mysqli_query($mysqli ,"SELECT * FROM `periksa` INNER JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id_poli INNER JOIN obat ON periksa.obat = obat.id INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id;");
                    while ($riwayat = mysqli_fetch_array($riwayats)){
                        $total = $riwayat['harga'] + $riwayat['biaya'];
                ?>
                <tr>
                    <th scope="row"> <?php echo $no++ ?> </th>
                    <td> <?php echo $riwayat['nama'] ?> </td>
                    <td> <?php echo $riwayat['alamat'] ?> </td>
                    <td> <?php echo $riwayat['nama_obat'] ?> </td>
                    <td> <?php echo $riwayat['tgl_periksa'] ?> </td>
                    <td> <?php echo $total ?> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Tambahkan Bootstrap JS jika diperlukan -->
    <!-- <script src="path/to/bootstrap.bundle.min.js"></script> -->
</body>
</html>

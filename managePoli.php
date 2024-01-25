<?php
    include "koneksi.php";

    if (!isset($_SESSION['username'])) {
        // Jika pengguna sudah login, tampilkan tombol "Logout"
        header("Location: index.php?page=loginUser");
        exit;
    }

    if(isset($_POST['simpan'])){
        $tambah= mysqli_query($mysqli, "INSERT INTO poli(nama_poli, keterangan)
            VALUES(
                '". $_POST['nama_poli'] ."',
                '". $_POST['keterangan'] ."'
            )
        ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Poli</title>
</head>
<body>
    <h2 class="mt-3">Manage Poli</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="" class="form-label">Nama Poli</label>
            <input type="text" class="form-control" name="nama_poli" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="" rows="3"></textarea>
        </div>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
    </form>
    <hr>
    <h2 class="mb-4 mt-4">Daftar Semua Poli</h2>
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Poli</th>
            <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
                $polis= mysqli_query($mysqli, "SELECT * FROM poli");

                while($poli= mysqli_fetch_array($polis)){
            ?>
            <tr>
                <th scope="row"> <?php echo $no++ ?> </th>
                <td> <?php echo $poli['nama_poli'] ?> </td>
                <td> <?php echo $poli['keterangan'] ?> </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
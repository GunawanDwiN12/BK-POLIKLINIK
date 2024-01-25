<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    // Jika pengguna sudah login, tampilkan tombol "Logout"
    header("Location: index.php?page=loginUser");
    exit;
}

if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE obat SET 
                                            nama_obat = '" . $_POST['nama_obat'] . "',
                                            kemasan = '" . $_POST['kemasan'] . "',
                                            harga = '" . $_POST['harga'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO obat (nama_obat, kemasan, harga) 
                                            VALUES (
                                                '" . $_POST['nama_obat'] . "',
                                                '" . $_POST['kemasan'] . "',
                                                '" . $_POST['harga'] . "'
                                            )");
    }
    echo "<script> 
                document.location='index.php?page=obat';
                </script>";
}
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
                document.location='index.php?page=obat';
                </script>";
}
?>
<div class="container">
    <!-- Form Input Data -->
    <h2 class="mt-5 mb-4 text-center">Daftar Obat</h2>
    <hr>

    <form class="row mx-auto" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        $nama_obat = '';
        $kemasan = '';
        $harga = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM obat 
                    WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama_obat = $row['nama_obat'];
                $kemasan = $row['kemasan'];
                $harga = $row['harga'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php
        }
        ?>

        <div class="mb-3 row">
            <label for="inputNama" class="col-sm-2 col-form-label fw-bold">Nama</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nama_obat" id="inputNama" placeholder="Nama" value="<?php echo $nama_obat ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputKemasan" class="col-sm-2 col-form-label fw-bold">Kemasan</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="kemasan" id="inputKemasan" placeholder="Kemasan" value="<?php echo $kemasan ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputHarga" class="col-sm-2 col-form-label fw-bold">Harga</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="harga" id="inputHarga" placeholder="Harga" value="<?php echo $harga ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-center">
                <button type="submit" class="btn btn-success rounded-pill px-5 mt-auto" name="simpan">Simpan</button>
            </div>
        </div>
    </form>

    <br>
    <br>

    <!-- Table -->
    <table class="table table-hover">
        <!-- Thead atau baris judul -->
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Kemasan</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <!-- Tbody berisi isi tabel sesuai dengan judul atau head -->
        <tbody>
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut -->
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM obat");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $data['nama_obat'] ?></td>
                    <td><?php echo $data['kemasan'] ?></td>
                    <td><?php echo $data['harga'] ?></td>
                    <td>
                        <a class="btn btn-warning rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>


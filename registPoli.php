<?php
    include "koneksi.php";

    if (!isset($_SESSION['no_rm'])) {
        // Jika pengguna sudah login, tampilkan tombol "Logout"
        header("Location: index.php?page=loginPasien");
        exit;
    }

    $auto= mysqli_query($mysqli ,"SELECT RIGHT (no_antrian, 1) as max_code FROM daftar_poli");
        $data= mysqli_fetch_array($auto);
        $code= $data['max_code'];
        $sequence= (int)substr($code,1);
        $sequence++;
        $initCode= "";
        $seqCode= $initCode . sprintf($sequence);

    if(isset($_POST['simpan'])){
        $tambah= mysqli_query($mysqli, "INSERT INTO daftar_poli(id_pasien, id_jadwal, keluhan, no_antrian)
        VALUES (
            '". $_POST['id_pasien'] ."',
            '". $_POST['id_jadwal'] ."',
            '". $_POST['keluhan'] ."',
            '". $_POST['no_antrian'] ."'
        )
        ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Periksa</title>
</head>
<body>
    <h2 class="mt-4 mb-4">Booking Periksa</h2>
    <hr>
    <form action="" method="POST" onsubmit="return(validate());">
            <div class="d-flex flex-column">
                <label class="ms-3 mt-1 me-2" for="id_pasien"><b>Pasien</b></label>
                <input class="form-control" type="text" name="id_pasien" readonly value="<?php echo $_SESSION['no_rm'] ?>">
                </select>

                <label class="ms-3 mt-1 me-2" for="id_jadwal"><b>Pilih Jadwal</b></label>
                <select class="form-select" name="id_jadwal">
                    <?php
                        $selectedJadwal= '';
                        $jadwals= mysqli_query($mysqli, "SELECT * FROM `jadwal_periksa` inner join dokter on jadwal_periksa.id_dokter = dokter.id;");

                        while($jadwal= mysqli_fetch_array($jadwals)){
                            $selectedJadwal= 'selected="selected"';
                    ?>
                        <option value="<?php echo $jadwal['id'] ?>" <?php echo $selectedJadwal ?>> <?php echo $jadwal['nama'] ?> - <?php echo $jadwal['hari'] ?>, <?php echo $jadwal['jam_mulai'] ?> - <?php echo $jadwal['jam_selesai'] ?> </option>
                    <?php } ?>
                </select>

                <label class="ms-3 mt-1 me-2" " for="keluhan"><b>Keluhan</b></label>
                <textarea class="form-control" name="keluhan" type="text" placeholder="Tulis Keluhan anda"></textarea>

                <label class="ms-3 mt-1 me-2"  for="no_antrian"><b>No. Antrian</b></label>
                <input class="form-control" name="no_antrian" value="<?php echo $seqCode?>" type="text" readonly>
            </div>
            <input type="submit" value="Simpan" name="simpan" class="btn btn-primary mt-2">
    </form>
    <hr>
    <h2 class="mt-4 mb-4">Daftar Pasien Lama</h2>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pasien</th>
      <th scope="col">Jadwal</th>
      <th scope="col">Keluhan</th>
      <th scope="col">No Antrian</th>
    </tr>
  </thead>
  <tbody>
        <?php
            $daftarPolis= mysqli_query($mysqli, "SELECT * FROM daftar_poli inner join pasien on daftar_poli.id_pasien = pasien.id inner join jadwal_periksa on daftar_poli.id_jadwal = jadwal_periksa.id;");
            $no= 1;
            while($daftarPoli= mysqli_fetch_array($daftarPolis)){
        ?>
            <tr>
            <th scope="row"><?php echo $no++ ?></th>
            <td> <?php echo $daftarPoli['nama'] ?> </td>
            <td> <?php echo $daftarPoli['hari'] ?>, <?php echo $daftarPoli['jam_mulai'] ?> - <?php echo $daftarPoli['jam_selesai'] ?> </td>
            <td> <?php echo $daftarPoli['keluhan'] ?> </td>
            <td> <?php echo $daftarPoli['no_antrian'] ?> </td>
            </tr>
        <?php } ?>
  </tbody>
</table>
</body>
</html>
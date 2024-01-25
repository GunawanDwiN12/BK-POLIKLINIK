<?php
    include "koneksi.php";

    if(isset($_POST['simpan'])){
        if(isset($_POST['id'])){
            $ubah= mysqli_query($mysqli, "UPDATE jadwal_periksa SET
                id_dokter= '". $_POST['id_dokter'] . "', 
                hari= '". $_POST['hari'] . "',
                jam_mulai= '". $_POST['jam_mulai'] . "',
                jam_selesai=  '". $_POST['jam_selesai'] . "',
                id= '". $_POST['id'] ."'

            ");
        } else {
            $tambah= mysqli_query($mysqli, "INSERT INTO jadwal_periksa(id_dokter, hari, jam_mulai, jam_selesai)
                VALUES(
                    '". $_POST['id_dokter'] ."',
                    '". $_POST['hari'] ."',
                    '". $_POST['jam_mulai'] ."',
                    '". $_POST['jam_selesai'] ."'
                )
            ");

        }
    }
    if(isset($_GET['aksi'])){
        if($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM jadwal_periksa WHERE id= '". $_GET['id'] ."'");
        }
        echo "<script> 
                document.location='index.php?page=manageJadwal';
                </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Praktik</title>
</head>
<body>
    <h2 class="mt-3">Jadwal Praktik</h2>
    <form method="post" >
        <div class="mb-3">
            <label for="" class="form-label">Nama Dokter</label>
            <select class="form-select" name="id_dokter">
                <?php
                    $selectedDokter= '';
                    $dokters= mysqli_query($mysqli, "SELECT * FROM dokter");

                    while($dokter= mysqli_fetch_array($dokters)){
                        $selectedDokter= 'selected="selected"';
                ?>
                <option value="<?php echo $dokter['id'] ?>"> <?php echo $dokter['nama'] ?> </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select class="form-select" name="hari" id="">
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <select class="form-select" name="jam_mulai" id="">
                <option value="08:00:00">08:00:00</option>
                <option value="09:00:00">09:00:00</option>
                <option value="10:00:00">10:00:00</option>
                <option value="11:00:00">11:00:00</option>
                <option value="12:00:00">12:00:00</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <select class="form-select" name="jam_selesai" id="">
                <option value="13:00:00">13:00:00</option>
                <option value="14:00:00">14:00:00</option>
                <option value="15:00:00">15:00:00</option>
                <option value="16:00:00">16:00:00</option>
                <option value="17:00:00">17:00:00</option>
                <option value="18:00:00">18:00:00</option>
                <option value="19:00:00">19:00:00</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
    </form>
    <hr>
    <h2 class="mt-4 mb-4">Daftar Dokter dan Jadwal Praktik</h2>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Dokter</th>
      <th scope="col">hari</th>
      <th scope="col">Jam Praktik</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        $jadwals= mysqli_query($mysqli, "SELECT * FROM `jadwal_periksa` inner join dokter on jadwal_periksa.id_dokter = dokter.id;");
        
        while($jadwal= mysqli_fetch_array($jadwals)){
    ?>
    <tr>
        <th scope="row"> <?php echo $no++ ?> </th>
        <td> <?php echo $jadwal['nama'] ?> </td>
        <td> <?php echo $jadwal['hari'] ?> </td>
        <td> <?php echo $jadwal['jam_mulai'] ?> - <?php echo $jadwal['jam_selesai'] ?> </td>
        <td> 
            <a href="index.php?page=manageJadwal&id= <?php echo $data['id'] ?>"></a> <i class=" bi bi-pencil-square text-warning"></i> 
            <a class="ms-3" href="index.php?page=manageJadwal&id= <?php echo $data['id'] ?>$aksi=hapus"></a> <i class="bi bi-trash3 text-danger "></i>
        </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</body>
</html>
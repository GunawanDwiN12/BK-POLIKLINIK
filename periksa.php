<?php
    include "koneksi.php";

    if(isset($_POST['simpan'])){
        $tambah= mysqli_query($mysqli, "INSERT INTO periksa(id_daftar_poli, tgl_periksa, catatan, biaya, obat)
            VALUES(
                '". $_POST['id_daftar_poli'] ."',
                '". $_POST['tgl_periksa'] ."',
                '". $_POST['catatan'] ."',
                '". $_POST['biaya'] ."',
                '". $_POST['obat'] ."'
            )
        ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa</title>
</head>
<body>
    <div class="container">
        <!--Form Input Data-->
        <h2 class="mt-5 mb-4 text-center">Periksa Pasien</h2>
        <hr>

        <form action="" method="post">
            <div class="mb-3 mt-3 row">
                <label for="" class="col-sm-2 col-form-label fw-bold">Daftar Poli</label>
                <div class="col-sm-6">
                    <select name="id_daftar_poli" class="form-select">
                        <?php
                            $selectedPoli= '';
                            $polis= mysqli_query($mysqli, "SELECT * FROM daftar_poli inner join pasien on daftar_poli.id_pasien = pasien.id;");

                            while($poli= mysqli_fetch_array($polis)){
                                $selectedPoli= 'selected="selected"';
                        ?>
                        <option value="<?php echo $poli['id_poli'] ?>" ><?php echo $poli['nama'] ?>, Keluhan: <?php echo $poli['keluhan'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 mt-3 row">
                <label for="tgl_periksa" class="col-sm-2 col-form-label fw-bold">Tanggal Periksa</label>
                <div class="col-sm-6">
                    <input class="form-control" type="datetime-local" name="tgl_periksa">
                </div>
            </div>
            <div class="mb-3 mt-3 row">
                <label for="catatan" class="col-sm-2 col-form-label fw-bold">Catatan</label>
                <div class="col-sm-6">
                    <textarea class="form-control" type="text" name="catatan"></textarea>
                </div>
            </div>
            <div class="mb-3 mt-3 row">
                <label for="obat" class="col-sm-2 col-form-label fw-bold">Obat</label>
                <div class="col-sm-6">
                    <select name="obat" class="form-select">
                        <?php
                            $selectedObat='';
                            $obats= mysqli_query($mysqli, "SELECT * FROM obat");

                            while($obat= mysqli_fetch_array($obats)){
                        ?>
                            <option value="<?php echo $obat['id'] ?>" <?php echo $selectedObat ?> > <?php echo $obat['nama_obat'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 mt-3 row">
                <label for="biaya" class="col-sm-2 col-form-label fw-bold">Biaya</label>
                <div class="col-sm-6">
                    <input class="form-control" type="number" value="150000" name="biaya" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <input class="btn btn-success rounded-pill px-5 mt-auto" type="submit" name="simpan" value="Selesai">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

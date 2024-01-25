<?php
    include "koneksi.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $no_rm= $_POST['no_rm'];
        $query= "SELECT * FROM pasien WHERE no_rm = '$no_rm'";
        $result= $mysqli->query($query);

        if(!$result){
            die("Query error: " . $mysqli->error);
        }

        if($result->num_rows == 1){
            $_SESSION['no_rm'] = $no_rm;
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/loginDokter.css">
    <title>Login Pasien</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="card-header text-center" style="font-weight: bold; font-size: 24px; background-color: #28a745; color: #fff;">Login Pasien</div>
            <div class="container p-4 rounded border border-2">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="no_rm" class="form-label">Nomor RM</label>
                        <input class="form-control" type="text" id="no_rm" name="no_rm" placeholder="Masukan Nomor RM anda">
                        <small class="form-text text-muted"><i>*Masukan nomor RM anda</i></small>
                    </div>
                    <div class="d-grid">
                        <input type="submit" name="simpan" value="Masuk" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
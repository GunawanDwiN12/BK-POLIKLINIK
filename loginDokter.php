<?php
    include "koneksi.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nip= $_POST['nip'];
        $passwords= $_POST['passwords'];

        $query = "SELECT * FROM dokter WHERE nip = '$nip'";
        $result= $mysqli->query($query);

        if(!$result){
            die("Query error: " . $mysqli->error);
        }

        if($result->num_rows == 1){
            $_SESSION['nip']= $nip;
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginDokter.css">
    <title>Login Dokter</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="container-fluid p-4 rounded border border-2">
                <form action="index.php?page=loginDokter" method="post">
                    <?php
                    if (isset($error)) {
                        echo '<div class="alert alert-danger">' . $error . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                    }
                    ?>
                    <div class="row">
                        <div class="col text-center">
                            <img src="./images/bg.png" class="img-fluid mb-4" alt="">
                        </div>
                        <div class="col mb-4">
                            <h2 class="text-center mb-4">Login Dokter</h2>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input class="form-control" type="text" id="nip" name="nip" placeholder="NIP">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" id="password" name="passwords" placeholder="Password">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="simpan" class="btn btn-success btn-block">Masuk</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>
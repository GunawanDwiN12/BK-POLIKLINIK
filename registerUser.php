<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = $mysqli->query($query);

        if ($result === false) {
            die("Query error: " . $mysqli->error);
        }

        if ($result->num_rows == 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
            if (mysqli_query($mysqli, $insert_query)) {
                echo "<script>
                alert('Pendaftaran Berhasil'); 
                document.location='index.php?page=loginUser';
                </script>";
            } else {
                $error = "Pendaftaran gagal";
            }
        } else {
            $error = "Username sudah digunakan";
        }
    } else {
        $error = "Password tidak cocok";
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" style="font-weight: bold; font-size: 24px; background-color: #28a745; color: #fff;">Register</div>
                <div class="card-body">
                    <form method="POST" action="index.php?page=registerUser">
                        <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        }
                        ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required placeholder="Masukan Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Masukan Password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required placeholder="Masukkan Ulang Password ">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-block">Daftar</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Sudah Punya Akun? <a href="index.php?page=loginUser">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

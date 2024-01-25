<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "User tidak ditemukan";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" style="font-weight: bold; font-size: 24px; background-color: #28a745; color: #fff;">Login Admin</div>
                <div class="card-body">
                    <form method="POST" action="index.php?page=loginUser">
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
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-block">Masuk</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Belum punya akun? <a href="index.php?page=registerUser">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

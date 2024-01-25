<?php
session_start();
if (isset($_SESSION['username'])) {
    // Hapus session
    session_unset();
    session_destroy();
} else if (isset($_SESSION['no_rm'])){
    session_unset();
    session_destroy();
} else if(isset($_SESSION['nip'])) {
    session_unset();
    session_destroy();
}

header("Location: index.php?page=loginUser");
exit();
?>
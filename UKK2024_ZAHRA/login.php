<?php
session_start();
include "./koneksi/koneksi.php";

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        $data = mysqli_fetch_array($result);
        $_SESSION['username'] = $data['username'];
        $_SESSION["login"] = true;

        $_SESSION['userid'] = $data['userid'];
        echo "<script>
        alert('Anda telah berhasil Login');
        location.href= 'home.php';
        </script>";
    }

    //cek username
    // if (mysqli_num_rows($result) === 1) {

    //     //cek password
    //     //ambil password sesuai username
    //     $row = mysqli_fetch_assoc($result);

    //     if (password_verify($password, $row['password'])) {
    //         //set session
    //         $_SESSION['username'] = $username;
    //         $_SESSION["login"] = true;


    //         echo"<script>
    //         alert('LOGIN BERHASIL');
    //         location.href= './admin/admin.php';
    //         </script>";
    //         exit;
    //     }
    // }

    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aset/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Document</title>
</head>

<body >


    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <h5>LOGIN</h5>
                        </div>
                        <form action="#" method="post">
                            <?php if (isset($error)) : ?>
                                <p style="color: red; font-size:13px;">username/password salah !!!</p>
                            <?php endif; ?>
                            <div>
                                <label class="form-label" for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label" for="">password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-primary" name="login">Login</button>

                            </div>
                            <hr>
                            <p>Dont have account? <a href="register.php"> Registration Here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="aset/js/bootstrap.min.js"></script>
</body>

</html>
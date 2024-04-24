<?php

include "./koneksi/koneksi.php";


if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil ditambahkan');
        location.href='login.php';
        </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}

function registrasi($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $email = strtolower(stripslashes($data["email"]));
    $namalengkap = strtolower(stripslashes($data["namalengkap"]));
    $alamat = strtolower(stripslashes($data["alamat"]));
    // $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    //cek username
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar!');
        </script>";
        return false;
    }

    //cek konfirmasi
    // if ($password !== $password2) {
    //     echo "<script>
    //     alert('konfirmasi password tidak sesuai');
    //     </script>";
    //     return false;
    // }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah user baru
    mysqli_query($koneksi, "INSERT INTO user Values('', '$username', '$password', '$email', '$namalengkap', '$alamat' )");
    return mysqli_affected_rows($koneksi);
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

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <h5>Registration</h5>
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

                            <div>
                                <label class="form-label" for="">email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label" for="">nama lengkap</label>
                                <input type="text" name="namalengkap" id="namalengkap" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label" for="">alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary" name="register">Registration</button>

                            </div>
                            <hr>
                            <p>have an account ?<a href="login.php"> login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="aset/js/bootstrap.min.js"></script>
</body>

</html>
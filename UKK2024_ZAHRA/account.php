<?php
session_start();
$userid = $_SESSION['userid'];


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include "./koneksi/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./aset/css/bootstrap.min.css">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-3 px-0 bg-light  shadow bg-white rounded position-fixed ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3  min-vh-100 ">
                    <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto  text-decoration-none text-black">
                        <span class="fs-5 d-none d-sm-inline">Web Gallery</span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-5 mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link align-middle px-0 text-black">
                                <i class="fs-3 bi-house"></i> <span class="ms-3 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="album.php" class="nav-link align-middle px-0 text-black">
                                <i class="fs-3 bi-journal-album"></i> <span class="ms-3 d-none d-sm-inline">Album</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="foto.php" class="nav-link align-middle px-0 text-black">
                                <i class="fs-3  bi-image"></i> <span class="ms-3 d-none d-sm-inline">Foto</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="account.php" class="nav-link align-middle px-0 text-black">
                                <i class="fs-3 bi-person"></i> <span class="ms-3 d-none d-sm-inline">Account</span>
                            </a>
                        </li>

                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <ul class="nav nav-pills " id="menu">
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link align-middle px-0 text-black">
                                    <i class="fs-3 bi-box-arrow-left"></i> <span class="ms-3 d-none d-sm-inline">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3 p-5" style="margin-left: 250px;">
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM user WHERE userid='$userid' ");
                while ($data = mysqli_fetch_array($result)) {
                ?>
               
                <div class="text-center mt-5"> 

                <h3>Account: <shpan><strong><?php echo $data['username'] ?></strong></span></h3> 
                    
                    
                </div>
                <?php } ?>
                <div class="container mt-3 p-5">

                    <div class="row justify-content-start p-5">
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-md-4 mt-2 ">
                                <div class="card" style="width: 20rem; ">

                                    <img src="./aset/image/<?php echo $data['lokasifile'] ?>" class="card-img-top" style="height: 18rem; border-radius:0px;">


                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>





    <script src="./aset/js/bootstrap.min.js"></script>
</body>

</html>
<?php
session_start();
$userid = $_SESSION['userid'];

include "./koneksi/koneksi.php";


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

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
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3  min-vh-100   ">
                    <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto  text-decoration-none text-black ">
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

            <div class="col py-3">
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="input-group flex-nowrap ">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="addon-wrapping">
                            </div>

                        </div>
                    </div>

                </div>



                <div class="container  p-5" style="margin-left:220px;">
                    <div class="row justify-content-start">
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid ");
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-md-4 mt-2 ">
                                <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                                    <!-- like -->
                                    <div class="card ">

                                        <div class="card-header">
                                            <span><strong><?php echo $data['username']; ?></strong></span>
                                            <br>
                                            <span><?php echo $data['namalengkap']; ?></span>
                                        </div>



                                        <img src="./aset/image/<?php echo $data['lokasifile'] ?>" class="card-img-top" style="height: 18rem; border-radius:0px;" title="<?php echo $data['judulfoto'] ?>">
                                        <div class="card-footer ">
                                            <?php
                                            $fotoid = $data['fotoid'];
                                            $likecek = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                                            if (mysqli_num_rows($likecek) == 1) { ?>
                                                <a href="./koneksi/proseslike.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="dontlike"><i class='fs-4 bi bi-heart-fill ' style="color:red;"></i></a>

                                            <?php } else { ?>
                                                <a href="./koneksi/proseslike.php?fotoid=<?php echo $data['fotoid']; ?>" type="submit" name='like'><i class='fs-4 bi bi-heart ' style="color:grey;"></i></a>

                                            <?php }

                                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                            echo mysqli_num_rows($like) . '  Like';
                                            ?>

                                            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class=" fs-4 bi bi-chat  m-2"style="color:grey;"></i></a>
                                            <?php
                                            $jlmkomen = mysqli_query($koneksi, "SELECT * FROM  komentar WHERE fotoid='$fotoid'");
                                            echo mysqli_num_rows($jlmkomen) . ' Comment';
                                            ?>
                                        </div>
                                    </div>
                                </a>

                                <!-- modal komentar -->
                                <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <img style="max-width: 100%" src="./aset/image/<?php echo $data['lokasifile'] ?>" class="card-omg-top" title="<?php echo $data['judulfoto'] ?>">

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="m-2">
                                                            <div class="overflow-auto">
                                                                <div class="sticky-top">
                                                                    <strong> <?php echo $data['judulfoto']; ?></strong>
                                                                    <br>
                                                                    <span class="badge bg-secondary "><?php echo $data['username']; ?></span>
                                                                    <span class="badge bg-secondary "><?php echo $data['tanggalunggahfoto']; ?></span>
                                                                    <!-- <span class="badge bg-primary "><?php echo $data['namaalbum']; ?></span> -->
                                                                    <hr>

                                                                    <p align="left">
                                                                        <?php echo $data['deskripsifoto']; ?>
                                                                    </p>
                                                                    <hr>

                                                                    <?php
                                                                    $fotoid = $data['fotoid'];
                                                                    $komentar = mysqli_query($koneksi, "SELECT * FROM komentar INNER JOIN user ON komentar.userid=user.userid WHERE komentar.fotoid='$fotoid'");
                                                                    while ($row = mysqli_fetch_array($komentar)) { ?>
                                                                        <p align='left'>
                                                                            <strong><?php echo $row['namalengkap'] ?></strong>
                                                                            <?php echo $row['isikomentar']; ?>
                                                                        </p>
                                                                    <?php  } ?>

                                                                    <hr>
                                                                    <div class="sticky-bottom">
                                                                        <form action="./koneksi/proseskomentar.php" method="post">
                                                                            <div class="input-group">
                                                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                                <input type="text" name="isikomentar" id="isikomentar" class="form-control" placeholder="Tambah komentar">
                                                                                <div class="input-group-prepend">
                                                                                    <button type="submit" name="kirim" class="btn btn-warning"><i class="p-3 bi bi-send"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- modal komen -->
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>





    <script src="./aset/js/bootstrap.min.js"></script>
</body>

</html>
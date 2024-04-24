<?php
session_start();
include "./koneksi/koneksi.php";


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggahfoto = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasifile = './aset/image/';
    $namafoto = rand() . '-' . $foto;

    move_uploaded_file($tmp, $lokasifile . $namafoto);

    $result = mysqli_query($koneksi, "INSERT INTO foto VALUES('','$judulfoto','$deskripsifoto','$tanggalunggahfoto','$namafoto','$albumid','$userid')");

    echo "<script>
    alert('Data Foto Berhasil Disimpan');
    location.href= 'foto.php';
    </script>";
}

//edit
if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggahfoto = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasifile = './aset/image/';
    $namafoto = rand() . '-' . $foto;

    if ($foto == null) {
        $result = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto' ,tanggalunggahfoto='$tanggalunggahfoto', albumid='$albumid' WHERE fotoid='$fotoid'");
    } else {
        $result = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
        $data = mysqli_fetch_array($result);
        if (is_file('./aset/image/' . $data['lokasifile'])) {
            unlink('./aset/image/' . $data['lokasifile']);
        }
        move_uploaded_file($tmp, $lokasifile . $namafoto);
        $result = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggahfoto='$tanggalunggahfoto', lokasifile='$namafoto', albumid='$albumid' WHERE fotoid='$fotoid'");
    }

    echo "<script>
    alert('Data Foto Berhasil di edit');
    location.href= 'foto.php';
    </script>";
}

//hapus
if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'];
    $result = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
    $data = mysqli_fetch_array($result);
    if (is_file('./aset/image/' . $data['lokasifile'])) {
        unlink('./aset/image/' . $data['lokasifile']);
    }
    $result = mysqli_query($koneksi, "DELETE FROM foto WHERE fotoid='$fotoid' ");

    echo "<script>
    alert('Data Foto Berhasil di Hapus');
    location.href= 'foto.php';
    </script>";
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
    <div class="container-fluid ">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-3 px-0 bg-light  shadow bg-white position-fixed ">
                <!-- sidebar -->
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
                <!-- sidebar -->
            </div>

            <div class="col py-3 p-5">
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



                <!-- Button modal tambah -->
                <button type="button" style="margin-left:240px;"  class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Foto
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Foto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <form action="#" method="post" enctype="multipart/form-data">
                                    <!-- FILE / lokasifile -->
                                    <label for="" class="form-label">Choose File :</label>
                                    <input class="form-control" type="file" name="lokasifile" id="lokasifile" required>

                                    <!-- judul foto -->
                                    <label for="" class="form-label">Judul Foto</label>
                                    <input type="text" name="judulfoto" id="judulfoto" class="form-control" required>

                                    <!-- deskripsi -->
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsifoto" id="deskripsifoto" class="form-control" required></textarea>

                                    <!-- pilih album -->
                                    <label for="" class="form-label">Abum</label>
                                    <select class="form-control" name="albumid" id="albumid" required>
                                        <?php
                                        $userid = $_SESSION['userid'];
                                        $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid ='$userid'");
                                        while ($data_album = mysqli_fetch_array($album)) { ?>
                                            <option value="<?php echo $data_album['albumid'] ?>">
                                                <?php echo $data_album['namaalbum'] ?>
                                            </option>

                                        <?php  } ?>
                                    </select>

                                    <!-- BUTTON TAMBAH-->
                                    <button type="submit" name="tambah" style="width: 100%;" id="tambah" class="btn btn-primary mt-2"> tambah foto</button>
                                </form>



                            </div>

                        </div>
                    </div>
                </div>
                <!-- modal -->


                <!-- table -->
                <div class="col-md-10 " style="margin-left: auto;">
                    <div class="card mt-3">
                        <div class="card-header">Data Album</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Judul Foto</th>
                                        <th>Deskripsi foto</th>
                                        <th>Album</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $userid = $_SESSION['userid'];
                                    $result = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid ='$userid'");
                                    while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td> <?php echo $no++  ?></td>
                                            <td><img src="./aset/image/<?php echo $data['lokasifile'] ?>" width="100"></td>
                                            <td> <?php echo $data['judulfoto']  ?></td>
                                            <td> <?php echo $data['deskripsifoto']  ?></td>
                                            <td> <?php echo $data['albumid']  ?></td>
                                            <td> <?php echo $data['tanggalunggahfoto']  ?></td>
                                            <td>

                                                <!-- edit -->
                                                <!-- Button modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid']; ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="edit<?php echo $data['fotoid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Foto</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="#" method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']; ?>">
                                                                    <label for="" class="form-label">Judul foto</label>
                                                                    <input type="text" name="judulfoto" value="<?php echo $data['judulfoto']; ?>" class="form-control" required>
                                                                    <label for="" class="form-label">Deskripsi</label>
                                                                    <textarea name="deskripsifoto" class="form-control" required> <?php echo $data['deskripsifoto']; ?> </textarea>
                                                                    <label for="" class="form-label">Abum</label>
                                                                    <select class="form-control" name="albumid" id="albumid">
                                                                        <?php
                                                                        $userid = $_SESSION['userid'];
                                                                        $album = mysqli_query($koneksi, "SELECT * FROM album  WHERE userid ='$userid'");
                                                                        while ($data_album = mysqli_fetch_array($album)) { ?>
                                                                            <option <?php if ($data_album['albumid'] == $data['albumid']) { ?> selected='selected' <?php } ?> value="<?php echo $data_album['albumid'] ?>">
                                                                                <?php echo $data_album['namaalbum'] ?>
                                                                            </option>

                                                                        <?php  } ?>
                                                                    </select>
                                                                    <label for="" class="form-label">Foto</label>

                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <img src="./aset/image/<?php echo $data['lokasifile']; ?>" alt="" width="100">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <label for="" class="form-label">Ganti File</label>
                                                                            <input class="form-control" type="file" name="lokasifile" id="lokasifile">
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="edit" id="edit" class="btn btn-warning">Edit</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- hapus -->
                                                <!-- Button modal -->

                                                <!-- <a name="hapus" id="hapus" href="foto.php<?php echo $data['fotoid']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus <?php echo $data['judulfoto']; ?> ini?')">Delete</a> -->


                                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid']; ?>">
                                                    <i class="bi bi-trash3"></i>

                                                </button>



                                                <!-- Modal Hapus -->
                                                <div class="modal fade" id="hapus<?php echo $data['fotoid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-body">
                                                                <form action="#" method="post">
                                                                    <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']; ?>">
                                                                    apakah anda yakin menghapus data <strong> <?php echo $data['judulfoto']; ?> </strong> ini?

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="hapus" id="hapus" class="btn btn-danger">Hapus</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php     } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <!-- table -->

            </div>
        </div>
    </div>





    <script src="./aset/js/bootstrap.min.js"></script>
</body>

</html>
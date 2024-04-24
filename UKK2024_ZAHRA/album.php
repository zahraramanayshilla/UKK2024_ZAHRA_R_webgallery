<?php
session_start();
include "./koneksi/koneksi.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

//tambah
if (isset($_POST['tambah'])) {
    $namaalbum = $_POST['namaalbum'];
    $deskripsialbum = $_POST['deskripsialbum'];
    $tanggaldibuatalbum = date('Y-m-d');
    $userid = $_SESSION['userid'];

    $result = mysqli_query($koneksi, "INSERT INTO album VALUES('','$namaalbum','$deskripsialbum','$tanggaldibuatalbum','$userid')");

    echo "<script>
    alert('DATA ALBUM BERHASIL DISIMPAN');
    location.href= 'album.php';
    </script>";
}

//edit
if (isset($_POST['edit'])) {
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsialbum = $_POST['deskripsialbum'];
    $tanggaldibuatalbum = date('Y-m-d');
    $userid = $_SESSION['userid'];

    $result = mysqli_query($koneksi, "UPDATE album SET namaalbum='$namaalbum', deskripsialbum='$deskripsialbum',tanggaldibuatalbum='$tanggaldibuatalbum' WHERE albumid='$albumid'");

    echo "<script>
    alert('DATA ALBUM BERHASIL DI EDIT');
    location.href= 'album.php';
    </script>";
}

//hapus
if (isset($_POST['hapus'])) {
    $albumid = $_POST['albumid'];
    $result = mysqli_query($koneksi, "DELETE FROM album WHERE albumid='$albumid'");

    echo "<script>
    alert('DATA ALBUM BERHASIL DI HAPUS');
    location.href= 'album.php';
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
            <div class="col-auto col-md-3 col-xl-2 px-sm-3 px-0 bg-light  shadow bg-white rounded position-fixed ">
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
                <button type="button" style="margin-left:250px;" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Album
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Album</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <form action="#" method="post">
                                    <label for="" class="form-label">nama album</label>
                                    <input type="text" name="namaalbum" id="namaalbum" class="form-control" required>
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsialbum" id="deskripsialbum" class="form-control" required></textarea>
                                    <button type="submit" style="width: 100%;" name="tambah" id="tambah" class="btn btn-primary mt-2"> tambah album</button>
                                </form>



                            </div>

                        </div>
                    </div>
                </div>
                <!-- modal -->


                <!-- table -->
                <div class="col-md-14 " style="margin-left:250px;">
                    <div class="card mt-3">
                        <div class="card-header">Data Album</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Album</th>
                                        <th>Deskripsi Album</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $userid = $_SESSION['userid'];
                                    $result = mysqli_query($koneksi, "SELECT * FROM album WHERE userid ='$userid'");
                                    while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td> <?php echo $no++  ?></td>
                                            <td> <?php echo $data['namaalbum']  ?></td>
                                            <td> <?php echo $data['deskripsialbum']  ?></td>
                                            <td> <?php echo $data['tanggaldibuatalbum']  ?></td>
                                            <td>


                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid']; ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="edit<?php echo $data['albumid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Album</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="#" method="post">
                                                                    <input type="hidden" name="albumid" value="<?php echo $data['albumid']; ?>">
                                                                    <label for="" class="form-label">nama album</label>
                                                                    <input type="text" name="namaalbum" value="<?php echo $data['namaalbum']; ?>" class="form-control" required>
                                                                    <label for="" class="form-label">Deskripsi</label>
                                                                    <textarea name="deskripsialbum" class="form-control" required> <?php echo $data['deskripsialbum']; ?> </textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="edit" id="edit" class="btn btn-warning">Edit</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid']; ?>">
                                                    <i class="bi bi-trash3"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="hapus<?php echo $data['albumid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="#" method="post">
                                                                    <input type="hidden" name="albumid" value="<?php echo $data['albumid']; ?>">
                                                                    apakah anda yakin menghapus data <strong> <?php echo $data['namaalbum']; ?> </strong> ini?

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
<?php
include_once '../../functions/functions.php';
// cek auth
if (empty($_SESSION['level'])) {
    header('location:../auth/index.php');
}
// end cek auth

$data = tampil("SELECT * FROM `akun` ORDER BY `akun`.`nama` ASC"); // Data Rekap

if (isset($_POST['tambah_akun'])) {
    if (akun_tambah($_POST)) {
        echo "<script>
     alert('Data Berhasil Di Tambahkan');
     document.location.href = '';
    </script>
    ";
    } else {
        echo "<script>
     alert('Data Gagal Di Tambahkan');
     document.location.href = '';
    </script>
    ";
    }
}


if (isset($_POST['update_akun'])) {
    if (akun_update($_POST)) {
        echo "<script>
     alert('Data Berhasil Di Update');
     document.location.href = '';
    </script>
    ";
    } else {
        echo "<script>
     alert('Data Gagal Di Update');
     document.location.href = '';
    </script>
    ";
    }
}

if (isset($_POST['hapus_akun'])) {
    if (akun_hapus($_POST)) {
        echo "<script>
     alert('Data Berhasil Di Hapus');
     document.location.href = '';
    </script>
    ";
    } else {
        echo "<script>
     alert('Data Gagal Di Hapus');
     document.location.href = '';
    </script>
    ";
    }
}


$title = "Akun | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_akun = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="col-md-12">
    <!-- TABLE HOVER -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Daftar Akun</h3>
        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambah_akun"><i class="lnr lnr-file-add"></i> Tambah</button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Waktu Login</th>
                        <th>Waktu Logout</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data  as $d) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['nama'] ?></td>
                            <td><?= $d['username'] ?></td>
                            <td><?= $d['password'] ?></td>
                            <td><?= $d['level'] ?></td>
                            <td><?= $d['waktu_login'] ?></td>
                            <td><?= $d['waktu_logout'] ?></td>
                            <td>
                                <button type="submit" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_akun<?= $d['id'] ?>"><i class="lnr lnr-pencil"></i> Edit</button>
                                <form method="POST" style="display: inline">
                                    <input type="hidden" name="id_akun" value=" <?= $d['id'] ?>">
                                    <button name="hapus_akun" onclick="return confirm('Apakah Data Ingin Dihapus?')" class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <!-- edit akun -->
                        <div class="modal fade" id="edit_akun<?= $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post">
                                            <input type="hidden" name="id_akun" value="<?= $d['id'] ?>">
                                            <input type="text" name="nama" value="<?= $d['nama'] ?>" class="form-control" placeholder=" Masukkan Nama" required>
                                            <br />
                                            <input type="text" name="username" value="<?= $d['username'] ?>" class="form-control" placeholder=" Masukkan Username" required>
                                            <br />
                                            <input type="text" name="password" value="<?= $d['password'] ?>" class="form-control" placeholder=" Masukkan Password" required>
                                            <br />
                                            <select class="form-control input-sm" name="level">
                                                <option value="">-- Pilih --</option>
                                                <option value="admin" <?php if ($d['level'] == 'admin') : ?> selected <?php endif; ?>>Admin</option>
                                                <option value="superadmin" <?php if ($d['level'] == 'superadmin') : ?> selected <?php endif; ?>>Super Admin</option>
                                            </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning btn-xs" name="update_akun">Update</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end edit akun -->

                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- END TABLE HOVER -->
</div>


<!-- tambah akun -->
<div class="modal fade" id="tambah_akun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="text" name="nama" class="form-control" placeholder=" Masukkan Nama" required>
                    <br />
                    <input type="text" name="username" class="form-control" placeholder=" Masukkan Username" required>
                    <br />
                    <input type="text" name="password" value="password" class="form-control" placeholder=" Masukkan Password" required>
                    <br />
                    <select class="form-control input-sm" name="level">
                        <option value="">-- Pilih --</option>
                        <option value="admin">Admin</option>
                        <option value="superadmin">Super Admin</option>
                    </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-xs" name="tambah_akun">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end tambah akun -->

<?php
include '../../tampleting/footer.php';
include '../../tampleting/html_end.php';
?>
<?php
include_once '../../functions/functions.php';

$data = tampil("SELECT * FROM `ayam` ORDER BY `ayam`.`id` DESC"); // Data Ayam
$kandang = tampil("SELECT * FROM `kandang` ORDER BY `kandang`.`kandang` ASC"); // Data Ayam


if (isset($_POST['tambah'])) {
    if (ayam_tambah($_POST)) {
        echo "<script>
     alert('Data Berhasil Di Tambahkan');
     document.location.href = 'index.php';
    </script>
    ";
    } else {
        echo "<script>
     alert('Data Gagal Di Tambahkan');
     document.location.href = 'index.php';
    </script>
    ";
    }
}

if (isset($_POST['edit'])) {
    $id_ayam = $_POST['id_ayam'];
    $edit = tampil("SELECT * FROM `ayam` WHERE id = $id_ayam")[0];
}

if (isset($_POST['update'])) {
    if (ayam_update($_POST)) {
        echo "<script>
     alert('Data Berhasil Di Update');
     document.location.href = 'index.php';
    </script>
    ";
    } else {
        echo "<script>
     alert('Data Gagal Di Update');
     document.location.href = 'index.php';
    </script>
    ";
    }
}

if (isset($_POST['hapus'])) {
    if (ayam_hapus($_POST)) {
        echo "<script>
     alert('Data Berhasil Di Hapus');
     document.location.href = 'index.php';
    </script>
    ";
    } else {
        echo "<script>
     alert('Data Gagal Di Hapus');
     document.location.href = 'index.php';
    </script>
    ";
    }
}

$title = "Ayam | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_ayam  = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="row">
    <div class="col-md-6">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Ayam</h3>
            </div>
            <div class="panel-body">
             <button type="submit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambah_ayam"><i class="lnr lnr-file-add"></i> Tambah</button>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
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
                                <td><?= $d['nama_ayam'] ?></td>
                                <td>
                                 <button type="submit" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit<?= $d['id'] ?>"><i class="lnr lnr-pencil"></i> Edit</button>
                                    <form method="post" style="display: inline">
                                        <input type="hidden" name="id_ayam" value="<?= $d['id'] ?>">
                                        <button type="submit" name="hapus" onclick="return confirm('Apakah Data Ingin Dihapus?')" class="btn btn-danger btn-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- edit rekap -->
                            <div class="modal fade" id="edit<?= $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Rekap</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post">
                                                <input type="hidden" name="id_ayam" value="<?= $d['id'] ?>">
                                                <input class="form-control" name="ayam" value="<?= $d['nama_ayam'] ?>" placeholder="Masukkan Nama Ayam" type="text" required>
                                                <br />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning btn-xs" name="update">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end edit rekap -->
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END TABLE HOVER -->
    </div>

    <div class="col-md-6">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Kandang</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kandang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kandang  as $d) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['kandang'] ?></td>
                                <td>
                                   <a href="#" class="btn btn-info btn-xs">Datail</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END TABLE HOVER -->
    </div>

</div>



<!--  Modal  -->
<div class="modal fade" id="tambah_ayam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Rekap</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post">
                                                <input class="form-control" name="ayam" placeholder="Masukkan Nama Ayam" type="text" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-xs" name="tambah">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
    </div>
<?php
include '../../tampleting/footer.php';
include '../../tampleting/html_end.php';
?>
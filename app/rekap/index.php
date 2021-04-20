<?php
include_once '../../functions/functions.php';

$data_ayam = tampil("SELECT * FROM `ayam` ORDER BY `ayam`.`id` DESC"); // Data Ayam

$data = tampil("SELECT rekap.id,ayam.nama_ayam, rekap.tanggal, rekap.jumlah 
                FROM `rekap`  LEFT JOIN ayam ON rekap.ayam_id = ayam.id  
                ORDER BY `rekap`.`id`  DESC"); // Data Rekap

if (isset($_POST['tambah_rekap'])) {
    if (rekap_tambah($_POST)) {
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

if (isset($_POST['update_rekap'])) {
    if (rekap_update($_POST)) {
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

if (isset($_POST['hapus_rekap'])) {
    if (rekap_hapus($_POST)) {
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

$title = "Rekap | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_rekap = true;
include '../../tampleting/navbar-sidebar.php';
?>
<div class="row">
    <div class="col-md-12">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Ayam</h3>
            </div>
            <div class="panel-body">
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
                        foreach ($data_ayam  as $d) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['nama_ayam'] ?></td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambah_rekap<?= $d['id'] ?>"><i class="lnr lnr-file-add"></i> Tambah</button>
                                    <form action="detail.php" method="GET" style="display: inline">
                                        <input type="hidden" name="id_ayam" value="<?= $d['id'] ?>">
                                        <button type="submit" class="btn btn-info btn-xs">Detail</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- tambah rekap -->
                            <div class="modal fade" id="tambah_rekap<?= $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Rekap</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <?= $d['nama_ayam'] ?> <br />
                                            </p>
                                            <br />
                                            <form method="post">
                                                <input type="hidden" name="id_ayam" value="<?= $d['id'] ?>">
                                                <input type="date" name="tanggal" class="form-control" required>
                                                <br />
                                                <input type="number" name="jumlah" class="form-control" placeholder=" Masukkan Jumlah" required>
                                                <br />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-xs" name="tambah_rekap">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end tambah rekap -->
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END TABLE HOVER -->
    </div>



    <div class="col-md-12">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Rekap</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
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
                                <td><?= $d['tanggal'] ?></td>
                                <td><?= $d['jumlah'] ?></td>
                                <td>
                                    <button type="submit" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_rekap<?= $d['id'] ?>"><i class="lnr lnr-pencil"></i> Edit</button>
                                    <form method="POST" style="display: inline">
                                        <input type="hidden" name="id_rekap" value=" <?= $d['id'] ?>">
                                        <button name="hapus_rekap" onclick="return confirm('Apakah Data Ingin Dihapus?')" class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- edit rekap -->
                            <div class="modal fade" id="edit_rekap<?= $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Rekap</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <p>
                                                <?= $d['nama_ayam'] ?> <br />
                                            </p>
                                            <br />
                                            <form method="post">
                                                <input type="hidden" name="id_rekap" value="<?= $d['id'] ?>">
                                                <input type="date" name="tanggal" class="form-control" value="<?= $d['tanggal'] ?>" required>
                                                <br />
                                                <input type="number" name="jumlah" class="form-control" placeholder=" Masukkan Jumlah" value="<?= $d['jumlah'] ?>" required>
                                                <br />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning btn-xs" name="update_rekap">Update</button>
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
</div>


<?php
include '../../tampleting/footer.php';
include '../../tampleting/html_end.php';
?>
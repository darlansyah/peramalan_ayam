<?php
include_once '../../functions/functions.php';

$data = tampil("SELECT * FROM `ayam` ORDER BY `ayam`.`id` DESC"); // Data Ayam



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
                                    <form method="post">
                                        <input type="hidden" name="id_ayam" value="<?= $d['id'] ?>">
                                        <button type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button>
                                        <button type="submit" name="hapus" onclick="return confirm('Apakah Data Ingin Dihapus?')" class="btn btn-danger btn-xs">Hapus</button>
                                    </form>
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

    <!-- tambah ayam -->
    <div class="col-md-6">

        <?php
        if (isset($_POST['edit'])) {
        ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Ayam</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <input type="hidden" name="id_ayam" value="<?= $edit['id'] ?>">
                        <input class="form-control" name="ayam" value="<?= $edit['nama_ayam'] ?>" placeholder="Masukkan Nama Ayam" type="text" required>
                        <br />
                        <button type="submit" class="btn btn-warning btn-block btn-xs" name="update">Update</button>
                        <a href="index.php" class="btn btn-default btn-block btn-xs">Kembali</a>
                    </form>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Ayam</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <input class="form-control" name="ayam" placeholder="Masukkan Nama Ayam" type="text" required>
                        <br />
                        <button type="submit" class="btn btn-primary btn-block btn-xs" name="tambah">Tambah</button>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
    <!-- end tambah ayam -->
</div>
<?php
include '../../tampleting/footer.php';
include '../../tampleting/html_end.php';
?>
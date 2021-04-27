<?php
include_once '../../functions/functions.php';
// cek auth
if (empty($_SESSION['level'])) {
    header('location:../auth/index.php');
}
// end cek auth

$data = tampil("SELECT * FROM `ayam` ORDER BY `ayam`.`id` DESC"); // Data Ayam
$title = "Peramalan | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_peramalan = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="col-md-12">
    <!-- TABLE HOVER -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Pilih Ayam</h3>
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
                                <form action="peramalan.php" method="GET" style="display: inline">
                                    <input type="hidden" name="id_ayam" value="<?= $d['id'] ?>">
                                    <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-line-chart"></i> Peramalan</button>
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
</div>

<?php
include '../../tampleting/footer.php';
include '../../tampleting/html_end.php';
?>
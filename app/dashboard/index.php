<?php
include_once '../../functions/functions.php';
// cek auth
$data = tampil("SELECT rekap.id,ayam.nama_ayam, kandang.kandang, rekap.tanggal, rekap.jumlah 
                FROM `rekap` 
                LEFT JOIN ayam ON rekap.ayam_id = ayam.id 
                LEFT JOIN kandang ON rekap.kandang_id = kandang.id 
                ORDER BY `rekap`.`id` DESC
                LIMIT 10 ");
if (empty($_SESSION['level'])) {
    header('location:../auth/index.php');
}
// end cek auth


$title = "Dashboard | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_dashboard = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="col-md-12">
    <!-- TABLE HOVER -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">10 Rekep Terakhir</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ayam</th>
                        <th>Kandang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data as $d) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['nama_ayam'] ?></td>
                            <td><?= $d['kandang'] ?></td>
                            <td><?= $d['tanggal'] ?></td>
                            <td><?= $d['jumlah'] ?></td>
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
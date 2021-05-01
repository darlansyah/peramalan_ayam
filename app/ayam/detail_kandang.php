<?php
include_once '../../functions/functions.php';
// cek auth
if (empty($_SESSION['level'])) {
    header('location:../auth/index.php');
}
// end cek auth

$id_kadang = $_GET['id_kandang'];
$kandang = tampil("SELECT kandang FROM kandang WHERE id = $id_kadang")[0];
$rekap_kandang = tampil("SELECT ayam.nama_ayam,rekap.tanggal, kandang.kandang, rekap.jumlah
 FROM rekap 
 LEFT JOIN ayam ON rekap.ayam_id = ayam.id 
 LEFT JOIN kandang ON rekap.kandang_id = kandang.id 
 WHERE kandang.id = $id_kadang
ORDER BY `rekap`.`tanggal` DESC
 ");


$title = "Rekap Perkandang| Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_ayam = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="col-md-12">
    <!-- TABLE HOVER -->
    <div class="panel">
        <div class="panel-heading">
            <h3><?= $kandang['kandang'] ?></h3>
            <h3 class="panel-title">Transaksi Penjualan</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Ayam</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($rekap_kandang as $d) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['tanggal'] ?></td>
                            <td><?= $d['nama_ayam'] ?></td>
                            <td><?= $d['jumlah'] ?></td>
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


<?php
include '../../tampleting/footer.php';
include '../../tampleting/html_end.php';
?>
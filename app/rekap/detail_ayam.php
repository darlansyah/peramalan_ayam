<?php
include_once '../../functions/functions.php';
// cek auth
if (empty($_SESSION['level'])) {
    header('location:../auth/index.php');
}
// end cek auth

$id_ayam = $_GET['id_ayam'];
$ayam = tampil("SELECT ayam.nama_ayam FROM ayam WHERE id = $id_ayam")[0];
$rekap_ayam = tampil("SELECT ayam.nama_ayam,rekap.tanggal, kandang.kandang, rekap.jumlah
 FROM rekap 
 LEFT JOIN ayam ON rekap.ayam_id = ayam.id 
 LEFT JOIN kandang ON rekap.kandang_id = kandang.id 
 WHERE ayam.id = $id_ayam
ORDER BY `rekap`.`tanggal` DESC
 ");


$title = "Rekap Perayam| Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_rekap = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="col-md-12">
    <!-- TABLE HOVER -->
    <div class="panel">
        <div class="panel-heading">
            <h3><?= $ayam['nama_ayam'] ?></h3>
            <h3 class="panel-title">Transaksi Penjualan</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Kandang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($rekap_ayam as $d) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['tanggal'] ?></td>
                            <td><?= $d['kandang'] ?></td>
                            <td><?= $d['jumlah'] ?></td>
                        </tr <?php
                            }
                                ?>>
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
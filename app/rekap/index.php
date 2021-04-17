<?php
include_once '../../functions/functions.php';

$data = tampil("SELECT rekap.id,ayam.nama_ayam, rekap.tanggal, rekap.jumlah 
                FROM `rekap`  LEFT JOIN ayam ON rekap.ayam_id = ayam.id  
                ORDER BY `rekap`.`id`  DESC"); // Data Rekap
$title = "Rekap | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_rekap = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="col-md-6">
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
                            <td>Hapus || Update</td>
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
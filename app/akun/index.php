<?php
include_once '../../functions/functions.php';
$data = tampil("SELECT * FROM `akun` ORDER BY `akun`.`nama` ASC"); // Data Rekap

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
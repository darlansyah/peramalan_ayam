<?php
include_once '../../functions/functions.php';
// cek auth
if (empty($_SESSION['level'])) {
    header('location:../auth/index.php');
}
// end cek auth


$title = "Dashboard | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_dashboard = true;
include '../../tampleting/navbar-sidebar.php';
?>

<div class="col-md-6">
    <!-- TABLE HOVER -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Halaman Dashboard</h3>
        </div>
    </div>
</div>

<?php
include '../../tampleting/footer.php';
include '../../tampleting/html_end.php';
?>
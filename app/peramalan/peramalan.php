<?php
include_once '../../functions/functions.php';
include_once '../../functions/function_metode.php';
// cek auth
if (empty($_SESSION['level'])) {
  header('location:../auth/index.php');
}
// end cek auth

$id_ayam = $_GET['id_ayam'];
$ayam  = tampil("SELECT * FROM `ayam` WHERE id = $id_ayam")[0];
$data = tampil("SELECT tanggal, SUM(jumlah) AS total 
                     FROM `rekap`
                     WHERE ayam_id = $id_ayam GROUP BY YEARWEEK(tanggal)");

$jumData = count($data);
$peramalan = des_holt($data);
// var_dump($peramalan[$jumData]);
// die;

$title = "Dashboard | Peramalan Ayam";
include '../../tampleting/html_head.php';
$a_peramalan = true;
include '../../tampleting/navbar-sidebar.php';
?>


<div class="col-md-9">
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title">Info</h3>
    </div>
    <div class="panel-body">
      <h3> <?= $ayam['nama_ayam'] ?> </h3>
      <h3> <b> Data (<?= $jumData ?>) </b> Tanggal</h3>
      <hr>
      <h2> <b> <?= $peramalan[$jumData]['periode'] ?> </b> (<?= round($peramalan[$jumData]['peramalan'])  ?>) </h2>
    </div>
  </div>
</div>

<div class="col-md-3 ">
  <!-- REALTIME CHART -->
  <div class="panel">

    <div class="panel-body">
      <ul class="list-unstyled list-justify">
        <li>Alpha: <span><?= $peramalan['alpha'] ?></span></li>
        <li>Beta: <span><?= $peramalan['beta'] ?></span></li>
      </ul>
      <div id="system-load" class="easy-pie-chart" data-percent="<?= round($peramalan[$jumData]['perError']) ?>">
        <span class="percent">MAPE <?= round($peramalan[$jumData]['perError']) ?></span>
        <canvas height="130" width="130"></canvas>
        <canvas height="130" width="130"></canvas>
      </div>
      <ul class="list-unstyled list-justify">
        <li>MAD: <span><?= $peramalan[$jumData]['absError'] ?></span></li>
      </ul>
    </div>
  </div>
</div>



<div class="col-md-12">
  <!-- TABLE HOVER -->
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title">Hasil Peramalan</h3>
    </div>
    <div class="panel-body">
      <table id="peramalan" class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Periode</th>
            <th>Data Aktual</th>
            <th>Trend</th>
            <th>Level</th>
            <th>Peramalan</th>
            <th>MAPE %</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          for ($i = count($peramalan) - 3; $i >= 0; $i--) : ?>
            <tr>
              <td> <?= $no++ ?> </td>
              <td> <?= $peramalan[$i]['periode'] ?> </td>
              <td> <?= $peramalan[$i]['data_aktual'] ?> </td>
              <td> <?= $peramalan[$i]['trend'] ?> </td>
              <td> <?= $peramalan[$i]['level'] ?> </td>
              <td> <?= $peramalan[$i]['peramalan'] ?> </td>
              <td> <?= $peramalan[$i]['perError'] ?> </td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
include '../../tampleting/footer.php';
?>
<!-- Javascript -->
<script src="../../assets/vendor/jquery/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="../../assets/vendor/chartist/js/chartist.min.js"></script>
<script src="../../assets/scripts/klorofil-common.js"></script>


<script>
  $(function() {
    // real-time pie chart
    var sysLoad = $('#system-load').easyPieChart({
      size: 130,
      barColor: function(percent) {
        return "rgb(" + Math.round(100 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
      },
      trackColor: 'rgba(245, 245, 245, 0.8)',
      scaleColor: false,
      lineWidth: 5,
      lineCap: "square",
      animate: 800
    });

  });
</script>
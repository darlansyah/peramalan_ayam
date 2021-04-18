<?php
// loade Darlansyah
// Peramalan Ayam
// Metode Double Expondensial Smotting Holt
session_start();
error_reporting(0);
//waktu WIB
date_default_timezone_set('Asia/Jakarta');
// koneksi database
$link = mysqli_connect("localhost", "root", "", "peramalan_ayam");

// menampilkan data
function tampil($query)
{
  global $link;
  $result = mysqli_query($link, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
// end menampilkan data


// akun------------------------>
function akun_tambah($data)
{
  global $link;
  $nama = $data['nama'];
  $username = $data['username'];
  $password = $data['password'];
  $level = $data['level'];

  mysqli_query($link, "INSERT INTO akun VALUES ('','$nama','$username','$password','$level','','')");
  return mysqli_affected_rows($link);
}
function akun_update($data)
{
  global $link;
  $id = $data['id_akun'];
  $nama = $data['nama'];
  $username = $data['username'];
  $password = $data['password'];
  $level = $data['level'];

  mysqli_query($link, " UPDATE akun SET
                  nama = '$nama',
                  username = '$username',
                  password = '$password',
                  level = '$level'
                  WHERE id = '$id'");

  return mysqli_affected_rows($link);
}
function akun_hapus($data)
{
  global $link;
  $id = $data['id_akun'];
  mysqli_query($link, "DELETE FROM akun WHERE id = $id");
  return mysqli_affected_rows($link);
}
// end akun<------------------------

// ayam------------------------>
function ayam_tambah($data)
{
  global $link;
  $ayam = $data['ayam'];

  mysqli_query($link, "INSERT INTO ayam VALUES ('','$ayam')");
  return mysqli_affected_rows($link);
}
function ayam_update($data)
{
  global $link;
  $id = $data['id_ayam'];
  $ayam = $data['ayam'];


  mysqli_query($link, "UPDATE ayam SET
                      nama_ayam = '$ayam'
                      WHERE id = $id");

  return mysqli_affected_rows($link);
}
function ayam_hapus($data)
{
  global $link;
  $id = $data['id_ayam'];
  mysqli_query($link, "DELETE FROM ayam WHERE id = $id");
  return mysqli_affected_rows($link);
}
// end ayam<------------------------


// rekap------------------------>
function rekap_tambah()
{
  //   SELECT tanggal, SUM(jumlah) AS jumlah FROM `rekap`
  // GROUP BY YEARWEEK(tanggal)
  return 'rekap_tambah';
}
function rekap_update()
{
  return 'rekap_update';
}
function rekap_hapus()
{
  return 'rekap_hapus';
}
// end rekap<------------------------






// CRUD---------------------------->
function tambah_kategori($data)
{
  global $link;
  $nama = $data['kategori'];

  // cek data kategori
  $cek_data = tampil("SELECT * FROM kategori WHERE nama = '$nama'");
  if (!empty($cek_data)) {
    echo "<script>
     alert('Data Nama Kategori Sudah Ada');
     document.location.href = 'index.php';
    </script>
    ";
    return false;
  }
  mysqli_query($link, "INSERT INTO kategori VALUES ('','$nama')");
  return mysqli_affected_rows($link);
}

function update_kategori($data)
{
  global $link;
  $id = $data['id_kategori'];
  $nama = $data['kategori'];

  // cek data kategori
  $cek_data = tampil("SELECT * FROM kategori WHERE nama = '$nama'");
  if (!empty($cek_data)) {
    echo "<script>
     alert('Data Nama Kategori Sudah Ada');
     document.location.href = 'index.php';
    </script>
    ";
    return false;
  }
  mysqli_query($link, "UPDATE kategori SET
                      nama = '$nama'
                      WHERE id = $id");

  return mysqli_affected_rows($link);
}

function hapus_kategori($data)
{
  global $link;
  $id = $data['id_kategori'];
  mysqli_query($link, "DELETE FROM kategori WHERE id = $id");
  return mysqli_affected_rows($link);
}
// end CRUD <----------------------------



// helper ---------------------------->
function minggu()
{
  $minggu = [
    'I',
    'II',
    'III',
    'IV',
    'V'
  ];
  return $minggu;
}

function bulan()
{
  $bulan = [
    'januari',
    'febuari',
    'maret',
    'april',
    'mei',
    'juni',
    'juli',
    'agustus',
    'september',
    'oktober',
    'november',
    'desember'
  ];
  return $bulan;
}

function tahun()
{
  $min = 2014;
  $max = date('Y');

  for ($i = $max; $i > $min; $i--) {
    $tahun[] = $i;
  }
  return $tahun;
}

function cekDataQuery($query)
{
  global $link;
  $result = mysqli_query($link, $query);
  $cekJumlah   = mysqli_num_rows($result);
  if ($cekJumlah == 0) {
    return FALSE;
  } else {
    return TRUE;
  }
}

// waktu login
function waktu_login($id, $waktu)
{
  global $link;

  $query = "UPDATE pengguna SET
            waktu_login = '$waktu'
            WHERE id = $id";

  mysqli_query($link, $query);
  return mysqli_affected_rows($link);
}
// end waktu login
// waktu logout
function waktu_logout($id, $waktu)
{
  global $link;
  $query = "UPDATE pengguna SET
            waktu_logout = '$waktu'
            WHERE id = $id";

  mysqli_query($link, $query);
  return mysqli_affected_rows($link);
}
// end waktu logout


function cekData($id_bp = 0, $minTahun = 0, $minBulan = 0, $minMinggu = "", $maxTahun = 0, $maxBulan = 0, $maxMinggu = "")
{

  $cekPeriodeMin = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = '$minTahun' AND bulan = '$minBulan' AND minggu = '$minMinggu'");
  $cekPeriodeMax = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = '$maxTahun' AND bulan = '$maxBulan' AND minggu = '$maxMinggu'");

  if (!$cekPeriodeMin) {
    return $data = [
      'respon' => false,
      'pesan' => 'Periode (MIN) Tidak di Temukan, Silakan Cek Data Rekap'
    ];
  }
  if (!$cekPeriodeMax) {
    return $data = [
      'respon' => false,
      'pesan' => 'Periode (MAX) Tidak di Temukan, Silakan Cek Data Rekap'
    ];
  }
  // var_dump($data);
  // die;

  if ($minTahun <= $maxTahun) { // apakah tahun terbaik ?
    $cekMinTahun = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp ");
    $cekMaxTahun = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $maxTahun");

    if ($cekMinTahun && $cekMaxTahun) { // apakah tahun ada ?
      $cekMinBulan = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $minTahun AND bulan = '$minBulan'");
      $cekMaxBulan = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $maxTahun AND bulan = '$maxBulan'");

      if ($cekMinBulan && $cekMaxBulan) { // apakah bulan ada ?
        $cekMinBulant = tampil("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $minTahun AND bulan = '$minBulan'")[0]['bulan'];
        $cekMaxBulant = tampil("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $maxTahun AND bulan = '$maxBulan'")[0]['bulan'];
        if ($minTahun == $maxTahun) {
          if (noBulan($cekMinBulant) <= noBulan($cekMaxBulant)) { // apakah bulan terbaik?
            $cekMinMinggu = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $minTahun AND bulan = '$minBulan' AND minggu = '$minMinggu'");
            $cekMaxMinggu = cekDataQuery("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $maxTahun AND bulan = '$maxBulan' AND minggu = '$maxMinggu'");

            if ($cekMinMinggu && $cekMaxMinggu) { // apakah minggu ada?
              $cekMinMinggut = tampil("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $minTahun AND bulan = '$minBulan' AND minggu = '$minMinggu'")[0]['minggu'];
              $cekMaxMinggut = tampil("SELECT * FROM `rekap` WHERE bahan_pokok_id = $id_bp AND tahun = $maxTahun AND bulan = '$maxBulan' AND minggu = '$maxMinggu'")[0]['minggu'];

              if (($minTahun == $maxTahun) && ($minBulan == $maxBulan)) { //  apakah mintahun == maxtahun && minbulan == maxbulan
                if (noMinggu($cekMinMinggut) < noMinggu($cekMaxMinggut)) { // apakah minggu terbalik
                  return true;
                } else { // end apakah minggu terbalik
                  return $data = [
                    'respon' => true,
                    'pesan' => NULL
                  ];
                }
              } else { // end  apakah mintahun == maxtahun && minbulan == maxbulan
                return $data = [
                  'respon' => true,
                  'pesan' => NULL
                ];
              }
            } else { // end apakah minggu ada?
              return $data = [
                'respon' => false,
                'pesan' => 'Silakan Cek Ulang Minggu Min Dan Max'
              ];
            }
          } else { // end apakah bulan terbaik?
            return $data = [
              'respon' => false,
              'pesan' => 'Bulan Terbalik'
            ];
          }
        }
      } else { // end apakah bulan ada ?
        return $data = [
          'respon' => false,
          'pesan' => 'Silakan Cek Ulang Bulan Min Dan Max'
        ];
      }
    } else { // end apakah tahun ada ?
      return $data = [
        'respon' => false,
        'pesan' => 'Silakan Cek Ulang Tahun Min Dan Max'
      ];
    }
  } else { // end apakah tahun terbaik ?
    return $data = [
      'respon' => false,
      'pesan' => 'Tahun(min) > Tahun(max)'
    ];
  }
}

function noBulan($bulan)
{ // array 0 - 11
  for ($i = 0; $i < 12; $i++) {
    if (bulan()[$i] == $bulan) {
      $no = $i;
    }
  }
  return $no;
}

function noMinggu($minggu)
{ // array 0 - 11
  for ($i = 0; $i <= 4; $i++) {
    if (minggu()[$i] == $minggu) {
      $no = $i;
    }
  }
  return $no;
}
// end helper <----------------------------

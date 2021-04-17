<?php

function des_holt($data, $periode = 1)
{
  $jdata = count($data) + 1; // jumlah data + 1
  // $alpha = 0.4;
  // $beta = 0.5;

  $min_mape = 9999;

  for ($a = 1; $a <= 9; $a++) { //a => alpha 
    for ($b = 1; $b <= 9; $b++) { //b => beta
      $param = [];
      $alpha = $a / 10;
      $beta = $b / 10;


      // pencarian pertama
      $lv1 = $data[0]['total']; //level 1
      $tr1 = $data[1]['total'] - $data[0]['total']; //  trend 1

      $param[] = [
        'periode' => $data[0]['tanggal'],
        'data_aktual' => number_format($data[0]['total'], 2, '.', ''),
        'level' => $lv1,
        'trend' => $tr1,
        'peramalan' => '-',
        'error' => '-',
        'absError' => '-',
        'perError' => '-'
      ];
      //end  pencarian pertama

      // pencarian ke n
      $jumAbsErrorn = 0;
      $jumPerError = 0;
      for ($i = 1; $i < count($data); $i++) {
        $lvn = ($alpha *
          $data[$i]['total']) +
          ((1 - $alpha) *
            ($param[$i - 1]['level']  + $param[$i - 1]['trend']));
        $trn = ($beta * ($lvn - $param[$i - 1]['level'])) + ((1 - $beta) *  $param[$i - 1]['trend']);
        $paramn = $param[$i - 1]['level'] + $param[$i - 1]['trend'];
        $errorn = $data[$i]['total'] - $paramn;
        $absErrorn = abs($errorn);
        $jumAbsErrorn = $jumAbsErrorn + $absErrorn; // jumlah mad
        if ($data[$i]['total'] == 0) {
          $perError = 0;
        } else {
          $perError = $absErrorn / $data[$i]['total'] * 100;
        }
        $jumPerError = $jumPerError + $perError; // jumlah mape

        $param[] = [
          'periode' => $data[$i]['tanggal'],
          'data_aktual' => number_format($data[$i]['total'], 2, '.', ''),
          'level' => $lvn,
          'trend' => $trn,
          'peramalan' => $paramn,
          'error' => $errorn,
          'absError' => $absErrorn,
          'perError' => $perError
        ];
      }
      $paramn = $param[$i - 1]['level'] + $param[$i - 1]['trend'];
      $rtAbsErrorn = $jumAbsErrorn / (count($data) - 1); // total MAD
      $rtJumPerError = $jumPerError / (count($data) - 1); // total MAPE

      $param[] = [
        'periode' => "Periode $jdata",
        'data_aktual' => '-',
        'level' => $param[count($data) - 1]['level'],
        'trend' => $param[count($data) - 1]['trend'] * 2,
        'peramalan' => $paramn,
        'error' => '-',
        'absError' => $rtAbsErrorn,
        'perError' => $rtJumPerError
      ];
      //end  pencarian ke n

      // mencari nilai mape
      if ($rtJumPerError < $min_mape) {
        $min_mape = $rtJumPerError;
        $peramalan = $param;
        $ab = ['alpha' => $alpha, 'beta' => $beta];
        $peramalan = array_merge($ab, $peramalan);
        // $peramalan = ['ab' => $ab, 'peramalan' => $peramalan];
      }
      // end mencari nilai mape
    }
  }
  // jumlah periode yang akan diramalkan
  $t = 2;
  $np = $jdata; // nomor periode
  for ($i = 1; $i < $periode; $i++) { // diamasis n=4
    $np++;
    $peramalan[] = [
      'periode' => "Periode $np",
      'data_aktual' => '-',
      'level' =>  $peramalan[count($data)]['level'],
      'trend' => $peramalan[count($data) - 1]['trend'] * ($t + $i),
      'peramalan' =>  $peramalan[count($data)]['level'] + $peramalan[count($data) - 1]['trend'] * (($t - 1) + $i),
      'error' => '-',
      'absError' => '-',
      'perError' => '-'
    ];
  }
  // end jumlah periode yang akan diramalkan

  return $peramalan;
}

function grafik($data)
{
  $x = "['" . $data[0]['periode'] . "',";
  $y_aktual = "['" . $data[0]['data_aktual'] . "',";
  $y_peramalan = "['" . $data[0]['peramalan'] . "',";
  for ($i = 1; $i <= count($data) - 4; $i++) {
    $x = $x . "'" . $data[$i]['periode'] . "',";
    $y_aktual = $y_aktual . "'" . $data[$i]['data_aktual'] . "',";
    $y_peramalan = $y_peramalan . "'" . $data[$i]['peramalan'] . "',";
  }

  $x = $x . "'" . $data[count($data) - 3]['periode'] . "']";
  $y_aktual = $y_aktual . "'" . $data[count($data) - 3]['data_aktual'] . "']";
  $y_peramalan = $y_peramalan . "'" . $data[count($data) - 3]['peramalan'] . "']";

  // var_dump($x );
  // die;
  $grafik = [
    'x' => $x,
    'y_aktual' => $y_aktual,
    'y_peramalan' => $y_peramalan
  ];

  // var_dump($data) ;
  // die;

  return $grafik;
}

<?php 
  require_once "../function/file-storage.php";
  require_once "../function/calculate.php";

  // mengambil data dari tiap bentuk
  $segitiga = getData('segitiga');
  $persegi = getData('persegi');
  $lingkaran = getData('lingkaran');
  // mengambil semua data
  $total = getData();

  // menghitung jumlah data
  $total_segitiga = count($segitiga);
  $total_persegi = count($persegi);
  $total_lingkaran = count($lingkaran);
  $total_data = count($total);

  // menghitung persentase
  $persentase_segitiga = round((($total_segitiga / $total_data) * 100), 2); 
  $persentase_persegi = round((($total_persegi / $total_data) * 100), 2); 
  $persentase_lingkaran = round((($total_lingkaran / $total_data) * 100), 2); 

  // Nilai maksimum
  $max_segitiga = max(array_column($segitiga, 'hasil'));
  $max_persegi = max(array_column($persegi, 'hasil'));
  $max_lingkaran = max(array_column($lingkaran, 'hasil'));
  $max_total = max(array_column($total, 'hasil'));

  // Nilai minimum
  $min_segitiga = min(array_column($segitiga, 'hasil'));
  $min_persegi = min(array_column($persegi, 'hasil'));
  $min_lingkaran = min(array_column($lingkaran, 'hasil'));
  $min_total = min(array_column($total, 'hasil'));
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Bangun Datar</title>
  <link rel="apple-touch-icon" href="../assets/img/favicon/favicon.ico">
  <link rel="icon" href="../assets/img/favicon/apple-touch-icon.png">
  
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendors/fontawesome/css/all.min.css" rel="stylesheet">
</head>
<body>
  <!-- menyertakan file component navbar -->
  <?php require_once "../templates/navbar.php" ?>

<div class="container py-4">
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./index.php" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav>

  <div class="row mb-4">

    <div class="col-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <div class="row"> 
            <div class="col-2">
              <div class="fs-1 text-success text-center rounded">
                <i class="fas fa-calculator"></i>
              </div>
            </div>
            <div class="col-10">
              <h6 class="card-title">
                Jumlah Perhitungan
              </h6>
              <span class="fs-4 fw-bold"><?= $total_data; ?> Data</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <div class="row">
            <div class="col-2">
              <div class="fs-1 text-danger text-center rounded">
                <i class="fas fa-plus-circle"></i>
              </div>
            </div>
            <div class="col-10">
              <h6 class="card-title">
                Nilai Maksimum
              </h6>
              <span class="fs-4 fw-bold"><?= $max_total; ?> cm<sup>2</sup></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <div class="row">
            <div class="col-2">
              <div class="fs-1 text-primary text-center rounded">
                <i class="fas fa-minus-circle"></i>
              </div>
            </div>
            <div class="col-10">
              <h6 class="card-title">
                Nilai Minimum
              </h6>
              <span class="fs-4 fw-bold"><?= $min_total; ?> cm<sup>2</sup></span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row my-4">

    <div class="col-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <h5 class="card-title fw-bold">
            Segitiga
          </h5>
          <div>Jumlah Data : <span class="fw-bold"><?= $total_segitiga; ?> Data</span></div>
          <div>Nilai Maksimum : <span class="fw-bold"><?= $max_segitiga; ?> cm<sup>2</sup></span></div>
          <div>Nilai Minimum : <span class="fw-bold"><?= $min_segitiga; ?> cm<sup>2</sup></span></div>
          <div>Persentase : <span class="fw-bold"><?= $persentase_segitiga; ?>%</span></div>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <h5 class="card-title fw-bold">
            Persegi
          </h5>
          <div>Jumlah Data : <span class="fw-bold"><?= $total_persegi; ?> Data</span></div>
          <div>Nilai Maksimum : <span class="fw-bold"><?= $max_persegi; ?> cm<sup>2</sup></span></div>
          <div>Nilai Minimum : <span class="fw-bold"><?= $min_persegi; ?> cm<sup>2</sup></span></div>
          <div>Persentase : <span class="fw-bold"><?= $persentase_persegi; ?>%</span></div>
        </div>
      </div>
    </div>
    
    <div class="col-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <h5 class="card-title fw-bold">
            Lingkaran
          </h5>
          <div>Jumlah Data : <span class="fw-bold"><?= $total_lingkaran; ?> Data</span></div>
          <div>Nilai Maksimum : <span class="fw-bold"><?= $max_lingkaran; ?> cm<sup>2</sup></span></div>
          <div>Nilai Minimum : <span class="fw-bold"><?= $min_lingkaran; ?> cm<sup>2</sup></span></div>
          <div>Persentase : <span class="fw-bold"><?= $persentase_lingkaran; ?>%</span></div>
        </div>
      </div>
    </div>

  </div>

  <div class="row my-4">
    <div class="col-12">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <h5 class="card-title fw-bold">
            Persentase Total Perhitungan
          </h5>
          <!-- chartJS -->
          <canvas id="donutChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>
  
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendors/fontawesome/js/all.min.js"></script>
  <script src="../assets/js/chart.min.js"></script>

  <!-- Membuat chart pie -->
  <script>
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Segitiga',
          'Persegi',
          'Lingkaran',
      ],
      datasets: [
        {
          data: [<?= $total_segitiga; ?>,<?= $total_persegi; ?>,<?= $total_lingkaran; ?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }

    new Chart(donutChartCanvas, {
      type: 'pie',
      data: donutData,
      options: donutOptions
    })
  </script>
</body>
</html>
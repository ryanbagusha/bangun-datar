<?php 
  require_once "../function/file-storage.php";
  require_once "../function/calculate.php";

  $result = getData('persegi');

  if(isset($_POST['submit'])){
    // mengambil nilai yang dikirimkan
    $sisi = $_POST['sisi'];

    // menghitung luas persegi
    $calculate = persegi($sisi);

    // data array untuk disimpan di file
    $data = [
      "bentuk" => "persegi",
      "param_1" => $sisi,
      "param_2" => null,
      "hasil" => $calculate,
      "waktu" => date("Y-m-d H:i")
    ];

    // menyimpan data ke file
    $result = save($data);

    // jika nilai kembalian save() berhasil
    // maka akan memunculkan peringatan dan redirect ke persegi.php
    if ($result) {
        echo "<script type='text/javascript'>
                alert('Luas Persegi dari Sisi = $sisi cm adalah $calculate cm2');
                document.location.href = './persegi.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data GAGAL disimpan...!');
                document.location.href = './persegi.php';
            </script>";
    }
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Persegi - Bangun Datar</title>
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
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Bangun Datar</a></li>
        <li class="breadcrumb-item active" aria-current="page">Persegi</li>
      </ol>
    </nav>

    <div class="card border-light shadow-sm">
      <div class="card-body">
        <h3 class="card-title fw-bold text-uppercase">
          Persegi
        </h3>
        <span>Data perhitungan persegi yang telah dilakukan</span>

        <div class="text-end my-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hitungModal">
            <i class="fas fa-calculator"></i>
            Hitung
          </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="hitungModal" tabindex="-1" aria-labelledby="hitungModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="hitungModalLabel">Hitung Luas Persegi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="fs-6 mb-3">
                  Rumus Luas Persegi: <span class="fw-bold">Sisi*Sisi</span>
                </div>

                <form method="POST">
                  <label for="sisi" class="form-label">Sisi</label>
                  <div class="input-group mb-3">
                    <input type="number" step="0.1" class="form-control" id="sisi" name="sisi" placeholder="Masukkan Panjang Sisi..." required>
                    <span class="input-group-text">cm</span>
                  </div>
                  <div class="input-group mb-3">
                    <input type="number" step="0.1" class="form-control" id="hasil" placeholder="Hasil Perhitungan..." readonly>
                    <span class="input-group-text">cm<sup>2</sup></span>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <table class="table table-hover table-bordered">
          <thead>
            <tr class="table-secondary">
              <th scope="col">No</th>
              <th scope="col">Waktu</th>
              <th scope="col">Sisi (s)</th>
              <th scope="col">Hasil</th>
            </tr>
          </thead>
          <tbody>
            <?php if($result != null): ?>
              <?php foreach($result as $key => $values): ?>
                <tr>
                  <th scope="row"><?= $key + 1; ?></th>
                  <td>
                    <?php
                      // mengubah format waktu ke hari/bulan/tahun jam:menit
                      $date = date_create($values['waktu']);
                      echo date_format($date, "d/m/Y H:i"); 
                    ?>
                  </td>
                  <td><?= $values['param_1']; ?> cm</td>
                  <td><?= $values['hasil']; ?> cm<sup>2</sup></td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class=" text-center fw-bold">Data Kosong</td>
                </tr>
              <?php endif; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
  
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendors/fontawesome/js/all.min.js"></script>

  <script>
    $("#sisi").keyup(function(){
    s = $("#sisi").val();
    total = s * s;
    $("#hasil").val(total);
  });
  </script>

</body>
</html>
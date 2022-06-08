<?php 
  require_once "../function/file-storage.php";
  require_once "../function/calculate.php";

  $result = getData('segitiga');

  if(isset($_POST['submit'])){
    // mengambil nilai yang dikirimkan
    $alas = $_POST['alas'];
    $tinggi = $_POST['tinggi'];

    // menghitung luas segitiga
    $calculate = segitiga($alas, $tinggi);

    // data array untuk disimpan di file
    $data = [
      "bentuk" => "segitiga",
      "param_1" => $alas,
      "param_2" => $tinggi,
      "hasil" => $calculate,
      "waktu" => date("Y-m-d H:i")
    ];

    // menyimpan data ke file
    $result = save($data);

    // jika nilai kembalian save() berhasil
    // maka akan memunculkan peringatan dan redirect ke segitiga.php
    if ($result) {
        echo "<script type='text/javascript'>
                alert('Luas Segitiga dari Alas = $alas cm dan Tinggi = $tinggi cm adalah $calculate cm2');
                document.location.href = './segitiga.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data GAGAL disimpan...!');
                document.location.href = './segitiga.php';
            </script>";
    }
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Segitiga - Bangun Datar</title>
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
        <li class="breadcrumb-item active" aria-current="page">Segitiga</li>
      </ol>
    </nav>

    <div class="card border-light shadow-sm">
      <div class="card-body">
        <h3 class="card-title fw-bold text-uppercase">
          Segitiga
        </h3>
        <span>Data perhitungan segitiga yang telah dilakukan</span>

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
                <h5 class="modal-title" id="hitungModalLabel">Hitung Luas Segitiga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="fs-6 mb-3">
                  Rumus Luas Segitiga: <span class="fw-bold">1/2*Alas*Tinggi</span>
                </div>

                <form method="POST">
                  <label for="alas" class="form-label">Alas</label>
                  <div class="input-group mb-3">
                    <input type="number" step="0.1" class="form-control" id="alas" name="alas" placeholder="Masukkan Panjang Alas..." required>
                    <span class="input-group-text">cm</span>
                  </div>
                  <label for="tinggi" class="form-label">Tinggi</label>
                  <div class="input-group mb-3">
                    <input type="number" step="0.1" class="form-control" id="tinggi" name="tinggi" placeholder="Masukkan Panjang Tinggi..." required>
                    <span class="input-group-text">cm</span>
                  </div>
                  <label for="hasil" class="form-label">Hasil</label>
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
              <th scope="col">Alas (a)</th>
              <th scope="col">Tinggi (t)</th>
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
                  <td><?= $values['param_2']; ?> cm</td>
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

  <!-- Menghitung luas segitiga pada form -->
  <script>
    $("#tinggi").keyup(function(){
    a = $("#alas").val();
    t = $("#tinggi").val();
    total = (a * t) / 2;
    $("#hasil").val(total);
  });
  </script>

</body>
</html>
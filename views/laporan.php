<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
} else {
  $_SESSION['page-name'] = "Laporan Penjualan";
  $_SESSION['page-url'] = "laporan";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("../resources/dash-header.php") ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body>
  <?php if (isset($_SESSION['message-success'])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-info'])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-warning'])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-danger'])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger'] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a href="./" class="nav-link active ps-0">Ringkasan</a>
                    </li>
                  </ul>
                  <?php if ($_SESSION['data-user']['role'] == 1) { ?>
                    <div>
                      <div class="btn-wrapper">
                        <a href="cetak-laporan" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <canvas id="myChart" style="width:100%;height: 450px;" class="shadow p-3 mt-3 rounded"></canvas>
                <?php
                if ($_SESSION['data-user']['role'] == 1) {
                  $januari = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='01'");
                  $januari = mysqli_num_rows($januari);

                  $februari = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='02'");
                  $februari = mysqli_num_rows($februari);

                  $maret = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='03'");
                  $maret = mysqli_num_rows($maret);

                  $april = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='04'");
                  $april = mysqli_num_rows($april);

                  $mei = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='05'");
                  $mei = mysqli_num_rows($mei);

                  $juni = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='06'");
                  $juni = mysqli_num_rows($juni);

                  $juli = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='07'");
                  $juli = mysqli_num_rows($juli);

                  $agustus = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='08'");
                  $agustus = mysqli_num_rows($agustus);

                  $september = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='09'");
                  $september = mysqli_num_rows($september);

                  $oktober = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='10'");
                  $oktober = mysqli_num_rows($oktober);

                  $november = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='11'");
                  $november = mysqli_num_rows($november);

                  $desember = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE month(penjualan_detail.updated_at)='12'");
                  $desember = mysqli_num_rows($desember);
                }
                if ($_SESSION['data-user']['role'] == 2) {
                  $januari = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='01'");
                  $januari = mysqli_num_rows($januari);

                  $februari = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='02'");
                  $februari = mysqli_num_rows($februari);

                  $maret = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='03'");
                  $maret = mysqli_num_rows($maret);

                  $april = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='04'");
                  $april = mysqli_num_rows($april);

                  $mei = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='05'");
                  $mei = mysqli_num_rows($mei);

                  $juni = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='06'");
                  $juni = mysqli_num_rows($juni);

                  $juli = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='07'");
                  $juli = mysqli_num_rows($juli);

                  $agustus = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='08'");
                  $agustus = mysqli_num_rows($agustus);

                  $september = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='09'");
                  $september = mysqli_num_rows($september);

                  $oktober = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='10'");
                  $oktober = mysqli_num_rows($oktober);

                  $november = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='11'");
                  $november = mysqli_num_rows($november);

                  $desember = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk WHERE produk.id_petani='$idUser' AND month(penjualan_detail.updated_at)='12'");
                  $desember = mysqli_num_rows($desember);
                }
                if ($_SESSION['data-user']['role'] == 4) {
                  $januari = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='01'");
                  $januari = mysqli_num_rows($januari);

                  $februari = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='02'");
                  $februari = mysqli_num_rows($februari);

                  $maret = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='03'");
                  $maret = mysqli_num_rows($maret);

                  $april = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='04'");
                  $april = mysqli_num_rows($april);

                  $mei = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='05'");
                  $mei = mysqli_num_rows($mei);

                  $juni = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='06'");
                  $juni = mysqli_num_rows($juni);

                  $juli = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='07'");
                  $juli = mysqli_num_rows($juli);

                  $agustus = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='08'");
                  $agustus = mysqli_num_rows($agustus);

                  $september = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='09'");
                  $september = mysqli_num_rows($september);

                  $oktober = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='10'");
                  $oktober = mysqli_num_rows($oktober);

                  $november = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='11'");
                  $november = mysqli_num_rows($november);

                  $desember = mysqli_query($conn, "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN petani ON produk.id_petani=petani.id_petani WHERE petani.id_user='$idUser' AND month(penjualan_detail.updated_at)='12'");
                  $desember = mysqli_num_rows($desember);
                }
                ?>
                <script type="text/javascript">
                  var ctx = document.getElementById("myChart").getContext('2d');
                  var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                      datasets: [{
                        label: 'Penjualan',
                        data: [<?= $januari ?>, <?= $februari ?>, '<?= $maret ?>', '<?= $april ?>', '<?= $mei ?>', '<?= $juni ?>', '<?= $juli ?>', '<?= $agustus ?>', '<?= $september ?>', '<?= $oktober ?>', '<?= $november ?>', '<?= $desember ?>'],
                        backgroundColor: 'rgba(2, 92, 225)',
                        borderColor: 'rgba(2, 92, 225)',
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero: true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-rounded mt-3">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless text-center">
                      <thead>
                        <tr>
                          <th>#Kode Pembelian</th>
                          <th>Nama Produk</th>
                          <th>Pembeli</th>
                          <th>Keterangan</th>
                          <th>Jumlah Beli</th>
                          <th>Harga</th>
                          <th>Total</th>
                          <th>Status Bayar</th>
                          <th>Tgl Beli</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($laporan_penjualan) == 0) { ?>
                          <tr>
                            <td colspan="9">Belum ada data pembelian</td>
                          </tr>
                          <?php } else if (mysqli_num_rows($laporan_penjualan) > 0) {
                          while ($row = mysqli_fetch_assoc($laporan_penjualan)) { ?>
                            <tr>
                              <td>#<?= $row['kode_pembelian'] ?></td>
                              <td>
                                <div class="d-flex">
                                  <img src="../assets/images/produk/<?= $row['img_produk'] ?>" alt="">
                                  <div class="my-auto">
                                    <h6><?= $row['nama_produk'] ?></h6>
                                  </div>
                                </div>
                              </td>
                              <td><?= $row['username'] ?><br>Telp: <?= $row['telpon'] ?></td>
                              <td><?= $row['keterangan'] ?></td>
                              <td><?= $row['jumlah_beli'] . " " . $row['satuan'] ?></td>
                              <td>Rp. <?= number_format($row['harga']) ?></td>
                              <td>Rp. <?= number_format($row['total']) ?></td>
                              <td>
                                <?php $id_penjualan = $row['id_penjualan'];
                                $pay = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_penjualan='$id_penjualan'");
                                if (mysqli_num_rows($pay) == 0) { ?>
                                  <p>Konfirmasi Bayar</p>
                                <?php } else { ?>
                                  <p><i class="mdi mdi-check-circle text-success"></i> Pembayaran Berhasil</p>
                                <?php } ?>
                              </td>
                              <td>
                                <div class="badge badge-opacity-success">
                                  <?php $dateCreate = date_create($row['created_at']);
                                  echo date_format($dateCreate, "d M Y h:i a"); ?>
                                </div>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>
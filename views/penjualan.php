<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 1) {
  header("Location: ./");
  exit();
}
$_SESSION['page-name'] = "Penjualan";
$_SESSION['page-url'] = "penjualan";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

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
                <div class="card card-rounded mt-3">
                  <div class="card-body">
                    <div class="table-responsive  mt-1">
                      <table class="table select-table text-center">
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
                            <th>Tgl Dibuat</th>
                            <th>Tgl Diubah</th>
                          </tr>
                        </thead>
                        <tbody id="search-page">
                          <?php if (mysqli_num_rows($penjualan) == 0) { ?>
                            <tr>
                              <td colspan="9">Belum ada data pembelian</td>
                            </tr>
                            <?php } else if (mysqli_num_rows($penjualan) > 0) {
                            while ($row = mysqli_fetch_assoc($penjualan)) { ?>
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
                                    <a href="pembayaran?confirm-pay=<?= $row['kode_pembelian'] ?>" class="btn btn-link text-decoration-none">Konfirmasi Bayar</a>
                                  <?php } else { ?>
                                    <a href="#" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#status-bayar<?= $row['id_detail'] ?>"><i class="mdi mdi-check-circle text-success"></i> Pembayaran Berhasil</a>
                                    <div class="modal fade" id="status-bayar<?= $row['id_detail'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title" id="exampleModalLabel">#<?= $row['kode_pembelian'] ?> Status Bayar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <?php while ($row_status = mysqli_fetch_assoc($pay)) { ?>
                                              <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                </symbol>
                                              </svg>
                                              <div class="alert alert-success d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                                  <use xlink:href="#check-circle-fill" />
                                                </svg>
                                                <div>
                                                  Pembayaran telah <strong>Lunas</strong>.
                                                </div>
                                              </div>
                                              <p>Metode pembayaran <strong>Tunai</strong> dengan bukti pembayaran sebagai berikut:</p>
                                              <img src="../assets/images/pembayaran/<?= $row_status['bukti_bayar'] ?>" style="width: 100%;height: 100%;" class="mt-3" alt="">
                                            <?php } ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  <?php } ?>
                                </td>
                                <td>
                                  <div class="badge badge-opacity-success">
                                    <?php $dateCreate = date_create($row['created_at']);
                                    echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="badge badge-opacity-warning">
                                    <?php $dateUpdate = date_create($row['updated_at']);
                                    echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                                  </div>
                                </td>
                              </tr>
                          <?php }
                          } ?>
                        </tbody>
                      </table>
                      <?php if ($total_role4 > $data_role4) { ?>
                        <div class="d-flex justify-content-between mt-4 flex-wrap">
                          <p class="text-muted">Showing 1 to <?= $data_role4 ?> of <?= $total_role4 ?> entries</p>
                          <nav class="ml-auto">
                            <ul class="pagination separated pagination-info">
                              <?php if (isset($page_role4)) {
                                if (isset($total_page_role4)) {
                                  if ($page_role4 > 1) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role4 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                    </li>
                                    <?php endif;
                                  for ($i = 1; $i <= $total_page_role4; $i++) : if ($i <= 4) : if ($i == $page_role4) : ?>
                                        <li class="page-item active">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-primary btn-sm rounded-0"><?= $i; ?></a>
                                        </li>
                                      <?php else : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-outline-primary btn-sm rounded-0"><?= $i ?></a>
                                        </li>
                                    <?php endif;
                                    endif;
                                  endfor;
                                  if ($total_page_role4 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role4 > 4) {
                                                                                    echo $page_role4;
                                                                                  } else if ($page_role4 <= 4) {
                                                                                    echo '5';
                                                                                  } ?>/" class="btn btn-<?php if ($page_role4 <= 4) {
                                                                                                          echo 'outline-';
                                                                                                        } ?>primary btn-sm rounded-0"><?php if ($page_role4 > 4) {
                                                                                                                                        echo $page_role4;
                                                                                                                                      } else if ($page_role4 <= 4) {
                                                                                                                                        echo '5';
                                                                                                                                      } ?></a>
                                    </li>
                                  <?php endif;
                                  if ($page_role4 < $total_page_role4 && $total_page_role4 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role4 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
                                    </li>
                              <?php endif;
                                }
                              } ?>
                            </ul>
                          </nav>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>
<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 1) {
  header("Location: ./");
  exit();
}
if (isset($_GET['id-buy'])) {
  $_SESSION['page-url'] = "pembayaran?id-buy=" . $_GET['id-buy'];
} else {
  $_SESSION['page-url'] = "pembayaran";
}
$_SESSION['page-name'] = "Pembayaran";
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
            <?php if ($_SESSION['data-user']['role'] == 3) {
              if (isset($_GET['confirm-pay'])) {
                if (mysqli_num_rows($confirm_pay) > 0) {
                  while ($row_conpay = mysqli_fetch_assoc($confirm_pay)) { ?>
                    <div class="col-md-12">
                      <div class="card">
                        <h5 class="card-header">#<?= $_GET['confirm-pay'] ?> Konfirmasi Pembayaran</h5>
                        <div class="card-body">
                          <h5 class="card-title"><?= $row_conpay['nama_produk'] ?></h5>
                          <p>Jumlah beli: <?= $row_conpay['jumlah_beli'] ?></p>
                          <p>Harga/satuan: Rp. <?= number_format($row_conpay['harga']) . "/" . $row_conpay['satuan'] ?></p>
                          <p>Total Bayar: Rp. <?= number_format($row_conpay['total']) ?></p>
                          <hr>
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                              <label for="formFile" class="form-label">Upload Bukti Bayar</label>
                              <input class="form-control" type="file" name="image" id="formFile" required>
                            </div>
                            <input type="hidden" name="id-penjualan" value="<?= $row_conpay['id_penjualan'] ?>">
                            <input type="hidden" name="total" value="<?= $row_conpay['total'] ?>">
                            <input type="hidden" name="id-produk" value="<?= $row_conpay['id_produk'] ?>">
                            <input type="hidden" name="stok" value="<?= $row_conpay['stok'] ?>">
                            <input type="hidden" name="jumlah-beli" value="<?= $row_conpay['jumlah_beli'] ?>">
                            <button type="submit" name="confirm-pay" class="btn btn-primary mt-3">Konfirmasi Bayar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                <?php }
                }
              }
            }
            if ($_SESSION['data-user']['role'] == 3) {
              if (isset($_GET['id-buy'])) { ?>
                <div class="col-lg-12">
                  <?php if (mysqli_num_rows($proses_pembayaran)) {
                    while ($row_proBuy = mysqli_fetch_assoc($proses_pembayaran)) { ?>
                      <div class="card">
                        <div class="card-header">
                          Proses Pembelian <?= $row_proBuy['nama_produk'] ?>
                        </div>
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <div class="col">
                              <h4>Data Produk</h4>
                              <p><strong>Deskripsi:</strong> <?= $row_proBuy['deskripsi'] ?></p>
                              <p><strong>Harga:</strong> Rp. <?= number_format($row_proBuy['harga']) ?></p>
                              <p><strong>Stok:</strong> <?= $row_proBuy['stok'] . " " . $row_proBuy['satuan'] ?></p>
                              <p><strong>Lokasi:</strong> <i class="mdi mdi-map-marker"></i> <?= $row_proBuy['lokasi'] . " (" . $row_proBuy['nama_petani'] . ")" ?></p>
                            </div>
                            <div class="col">
                              <h4>Kontak Penjual</h4>
                              <p><strong>Telpon:</strong> <?= $row_proBuy['telpon'] ?></p>
                              <p><strong>Alamat:</strong> <?= $row_proBuy['alamat'] ?></p>
                            </div>
                          </div>
                          <hr>
                          <form action="" method="post">
                            <h4>Data Pembelian</h4>
                            <div class="mb-3">
                              <label for="keterangan" class="form-label">Keterangan</label>
                              <input type="text" name="ket" class="form-control" id="keterangan" placeholder="Keterangan">
                            </div>
                            <div class="mb-3">
                              <label for="Jumlah Pembelian" class="form-label">Jumlah Pembelian <small>(per <?= $row_proBuy['satuan'] ?>)</small></label>
                              <input type="number" name="jumlah-beli" class="form-control" id="Jumlah Pembelian" placeholder="Jumlah Pembelian" required>
                            </div>
                            <input type="hidden" name="id-produk" value="<?= $row_proBuy['id_produk'] ?>">
                            <input type="hidden" name="id-penjual" value="<?= $row_proBuy['id_user'] ?>">
                            <input type="hidden" name="harga" value="<?= $row_proBuy['harga'] ?>">
                            <input type="hidden" name="nama-produk" value="<?= $row_proBuy['nama_produk'] ?>">
                            <input type="hidden" name="stok" value="<?= $row_proBuy['stok'] ?>">
                            <input type="hidden" name="satuan" value="<?= $row_proBuy['satuan'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                              <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                              </symbol>
                            </svg>
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                                <use xlink:href="#exclamation-triangle-fill" />
                              </svg>
                              <div>
                                Perhatian!!, sebelum anda membeli disarankan untuk menanyakan stok apakah masih ada atau tidak.
                              </div>
                            </div>
                            <button type="submit" name="buy-product" class="btn btn-primary mt-3">Konfirmasi Beli</button>
                          </form>
                        </div>
                      </div>
                  <?php }
                  } ?>
                </div>
              <?php } else if (!isset($_GET['id-buy'])) { ?>
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
                              <?php if (mysqli_num_rows($pembayaran) == 0) { ?>
                                <tr>
                                  <td colspan="9">Belum ada data pembelian</td>
                                </tr>
                                <?php } else if (mysqli_num_rows($pembayaran) > 0) {
                                while ($row = mysqli_fetch_assoc($pembayaran)) { ?>
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
                                    <td><?= $row['keterangan'] ?></td>
                                    <td><?= $row['jumlah_beli'] . " " . $row['satuan'] ?></td>
                                    <td>Rp. <?= number_format($row['harga']) ?></td>
                                    <td>Rp. <?= number_format($row['total']) ?></td>
                                    <td>
                                      <button type="button" class="btn btn-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#status-bayar<?= $row['id_detail'] ?>">
                                        Lihat Status
                                      </button>
                                      <div class="modal fade" id="status-bayar<?= $row['id_detail'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                          <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                              <h5 class="modal-title" id="exampleModalLabel">#<?= $row['kode_pembelian'] ?> Status Bayar</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <?php $id_penjualan = $row['id_penjualan'];
                                              $status_pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_penjualan='$id_penjualan'");
                                              if (mysqli_num_rows($status_pembayaran) == 0) { ?>
                                                <div class="row">
                                                  <div class="col-lg-4 text-dark text-left">
                                                    <h6 class="mt-3">Pembeli</h5>
                                                      <p><?= $row_inv['username'] ?></p>
                                                      <p><?= $row_inv['alamat'] ?></p>
                                                      <p><?= $row_inv['telpon'] ?></p>
                                                      <h6 class="mt-3">Tgl Pembelian</h6>
                                                      <p><?php $dateCreate = date_create($row['created_at']);
                                                          echo date_format($dateCreate, "d M Y h:i a"); ?></p>
                                                      <h6 class="mt-3">Penjual</h6>
                                                      <p><?= $row['username'] ?></p>
                                                      <p><?= $row['alamat'] ?></p>
                                                      <p><?= $row['telpon'] ?></p>
                                                      <h6 class="mt-3">Metode Pembayaran</h6>
                                                      <p><?= $row['bank'] . ' - ' . $row['norek'] ?></p>
                                                      <a href="pembayaran?confirm-pay=<?= $row['kode_pembelian'] ?>" class="btn btn-link text-decoration-none">Konfirmasi Bayar</a>
                                                  </div>
                                                  <div class="col-lg-8">
                                                    <div class="card mt-3">
                                                      <div class="card-header">
                                                        Data Pembelian
                                                      </div>
                                                      <div class="card-body">
                                                        <table class="table table-sm">
                                                          <thead>
                                                            <tr>
                                                              <th scope="col">Deskripsi</th>
                                                              <th scope="col">Jumlah</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <th scope="row"><?= $row['nama_produk'] . ' - ' . $row['jumlah_beli'] . " " . $row['satuan'] ?></th>
                                                              <td>Rp. <?= number_format($row['total']) ?></td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <?php } else if (mysqli_num_rows($status_pembayaran) > 0) {
                                                while ($row_status = mysqli_fetch_assoc($status_pembayaran)) { ?>
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
                                                      Pembayaran anda telah <strong>Lunas</strong>.
                                                    </div>
                                                  </div>
                                                  <p>Metode pembayaran <strong>Tunai</strong> dengan bukti pembayaran sebagai berikut:</p>
                                                  <img src="../assets/images/pembayaran/<?= $row_status['bukti_bayar'] ?>" style="width: 100%;height: 100%;" class="mt-3" alt="">
                                              <?php }
                                              } ?>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
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
                          <?php if ($total_role5 > $data_role5) { ?>
                            <div class="d-flex justify-content-between mt-4 flex-wrap">
                              <p class="text-muted">Showing 1 to <?= $data_role5 ?> of <?= $total_role5 ?> entries</p>
                              <nav class="ml-auto">
                                <ul class="pagination separated pagination-info">
                                  <?php if (isset($page_role5)) {
                                    if (isset($total_page_role5)) {
                                      if ($page_role5 > 1) : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                        </li>
                                        <?php endif;
                                      for ($i = 1; $i <= $total_page_role5; $i++) : if ($i <= 4) : if ($i == $page_role5) : ?>
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
                                      if ($total_page_role5 >= 4) : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role5 > 4) {
                                                                                        echo $page_role5;
                                                                                      } else if ($page_role5 <= 4) {
                                                                                        echo '5';
                                                                                      } ?>/" class="btn btn-<?php if ($page_role5 <= 4) {
                                                                                                              echo 'outline-';
                                                                                                            } ?>primary btn-sm rounded-0"><?php if ($page_role5 > 4) {
                                                                                                                                            echo $page_role5;
                                                                                                                                          } else if ($page_role5 <= 4) {
                                                                                                                                            echo '5';
                                                                                                                                          } ?></a>
                                        </li>
                                      <?php endif;
                                      if ($page_role5 < $total_page_role5 && $total_page_role5 >= 4) : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
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
            <?php }
            } ?>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>
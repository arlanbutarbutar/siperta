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
                            <th>Harga</th>
                            <th>Total</th>
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
                                <td><?= $row['kode_pembelian']?></td>
                                <td>
                                  <div class="d-flex">
                                    <img src="../assets/images/produk/<?= $row['img_produk']?>" alt="">
                                    <div class="my-auto">
                                      <h6><?= $row['nama_produk'] ?></h6>
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
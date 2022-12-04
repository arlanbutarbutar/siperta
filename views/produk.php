<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Produk";
$_SESSION['page-url'] = "produk";
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
          <?php if ($_SESSION['data-user']['role'] <= 2 || $_SESSION['data-user']['role'] == 4) { ?>
            <div class="row">
              <?php if ($_SESSION['data-user']['role'] == 2) { ?>
                <div class="col-lg-4">
                  <div class="card card-rounded mt-3">
                    <img src="../assets/images/produk.png" class="card-img-top" alt="">
                    <div class="card-body text-center">
                      <h5 class="card-title">Tambah Produk</h5>
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="img-produk" class="form-label">Thumbnail</label>
                          <input type="file" name="image" class="form-control" id="img-produk" placeholder="Thumbnail" required>
                        </div>
                        <div class="mb-3">
                          <label for="nama" class="form-label">Nama</label>
                          <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                          <label for="harga" class="form-label">Harga</label>
                          <input type="number" name="harga" class="form-control" id="harga" placeholder="Harga" required>
                        </div>
                        <div class="mb-3">
                          <label for="stok" class="form-label">Stok</label>
                          <input type="number" name="stok" class="form-control" id="stok" placeholder="Stok" required>
                        </div>
                        <div class="mb-3">
                          <label for="satuan" class="form-label">Satuan</label>
                          <select name="satuan" id="satuan" class="form-select" aria-label="Default select example" required>
                            <option selected value="">Pilih Satuan</option>
                            <?php foreach ($satuan as $row_satuan) : ?>
                              <option value="<?= $row_satuan['id_satuan'] ?>"><?= $row_satuan['satuan'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="distributor" class="form-label">Petani</label>
                          <select name="id-distributor" id="distributor" class="form-select" aria-label="Default select example" required>
                            <option selected value="">Pilih Petani</option>
                            <?php foreach ($distributor as $row_distributor) : ?>
                              <option value="<?= $row_distributor['id_distributor'] ?>"><?= $row_distributor['nama_distributor'] . ' (Lokasi: ' . $row_distributor['lokasi'] . ')' ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <button type="submit" name="add-produk" class="btn btn-primary mt-3">Tambah</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                <?php } else if ($_SESSION['data-user']['role'] == 1) { ?>
                  <div class="col-lg-12">
                  <?php } ?>
                  <div class="home-tab">
                    <div class="card card-rounded mt-3">
                      <div class="card-body">
                        <div class="table-responsive mt-1">
                          <table class="table select-table text-center">
                            <thead>
                              <tr>
                                <th>#Kode Porduk</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Petani</th>
                                <th>Tgl Dibuat</th>
                                <th>Tgl Diubah</th>
                                <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
                                  <th colspan="2">Aksi</th>
                                <?php } ?>
                              </tr>
                            </thead>
                            <tbody id="search-page">
                              <?php if (mysqli_num_rows($produk) == 0) { ?>
                                <tr>
                                  <td colspan="9">Belum ada data produk</td>
                                </tr>
                                <?php } else if (mysqli_num_rows($produk) > 0) {
                                while ($row = mysqli_fetch_assoc($produk)) { ?>
                                  <tr>
                                    <td>#<?= $row['kode_produk'] ?></td>
                                    <td>
                                      <div class="d-flex">
                                        <img src="../assets/images/produk/<?= $row['img_produk'] ?>" alt="">
                                        <div class="my-auto">
                                          <h6><?= $row['nama_produk'] ?></h6>
                                        </div>
                                      </div>
                                    </td>
                                    <td>Rp. <?= number_format($row['harga']) ?></td>
                                    <td><?= $row['stok'] . " " . $row['satuan'] ?></td>
                                    <td><?= $row['nama_distributor'] . " (" . $row['lokasi'] . ")" ?></td>
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
                                    <?php if ($_SESSION['data-user']['role'] <= 2) { ?>
                                      <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_produk'] ?>">
                                          <i class="mdi mdi-table-edit"></i>
                                        </button>
                                        <div class="modal fade" id="ubah<?= $row['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_produk'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <form action="" method="POST">
                                                <div class="modal-body">
                                                  <div class="mb-3">
                                                    <label for="img-produk" class="form-label">Thumbnail</label>
                                                    <input type="file" name="image" class="form-control" id="img-produk" placeholder="Thumbnail">
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" name="nama" value="<?= $row['nama_produk'] ?>" class="form-control" id="nama" placeholder="Nama" required>
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="harga" class="form-label">Harga</label>
                                                    <input type="number" name="harga" value="<?= $row['harga'] ?>" class="form-control" id="harga" placeholder="Harga" required>
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="stok" class="form-label">Stok</label>
                                                    <input type="number" name="stok" value="<?= $row['stok'] ?>" class="form-control" id="stok" placeholder="Stok" required>
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="satuan" class="form-label">Satuan</label>
                                                    <select name="satuan" id="satuan" class="form-select" aria-label="Default select example" required>
                                                      <option selected value="<?= $row['id_satuan'] ?>"><?= $row['satuan'] ?></option>
                                                      <?php $id_satuan = $row['id_satuan'];
                                                      $takeSatuan = mysqli_query($conn, "SELECT * FROM satuan WHERE id_satuan!='$id_satuan'");
                                                      if (mysqli_num_rows($takeSatuan) > 0) {
                                                        while ($rowSatuan = mysqli_fetch_assoc($takeSatuan)) { ?>
                                                          <option value="<?= $rowSatuan['id_satuan'] ?>"><?= $rowSatuan['satuan'] ?></option>
                                                      <?php }
                                                      } ?>
                                                    </select>
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="distributor" class="form-label">Petani</label>
                                                    <select name="id-distributor" id="distributor" class="form-select" aria-label="Default select example" required>
                                                      <option selected value="<?= $row['id_distributor'] ?>"><?= $row['nama_distributor'] ?></option>
                                                      <?php $id_distributor = $row['id_distributor'];
                                                      $takeDistributor = mysqli_query($conn, "SELECT * FROM distributor WHERE id_distributor!='$id_distributor'");
                                                      if (mysqli_num_rows($takeDistributor) > 0) {
                                                        while ($rowDistributor = mysqli_fetch_assoc($takeDistributor)) { ?>
                                                          <option value="<?= $rowDistributor['id_distributor'] ?>"><?= $rowDistributor['nama_distributor'] . ' (Lokasi: ' . $rowDistributor['lokasi'] . ')' ?></option>
                                                      <?php }
                                                      } ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                  <input type="hidden" name="id-produk" value="<?= $row['id_produk'] ?>">
                                                  <input type="hidden" name="img-produk" value="<?= $row['img_produk'] ?>">
                                                  <input type="hidden" name="nama-produk" value="<?= $row['nama_produk'] ?>">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                  <button type="submit" name="edit-produk" class="btn btn-warning">Ubah</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_produk'] ?>">
                                          <i class="mdi mdi-delete"></i>
                                        </button>
                                        <div class="modal fade" id="hapus<?= $row['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_produk'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                Anda yakin ingin menghapus <?= $row['nama_produk'] ?> ini?
                                              </div>
                                              <form action="" method="POST">
                                                <div class="modal-footer justify-content-center">
                                                  <input type="hidden" name="id-produk" value="<?= $row['id_produk'] ?>">
                                                  <input type="hidden" name="img-produk" value="<?= $row['img_produk'] ?>">
                                                  <input type="hidden" name="nama-produk" value="<?= $row['nama_produk'] ?>">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                  <button type="submit" name="delete-produk" class="btn btn-danger">Hapus</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                    <?php } ?>
                                  </tr>
                              <?php }
                              } ?>
                            </tbody>
                          </table>
                          <?php if ($total_role3 > $data_role3) { ?>
                            <div class="d-flex justify-content-between mt-4 flex-wrap">
                              <p class="text-muted">Showing 1 to <?= $data_role3 ?> of <?= $total_role3 ?> entries</p>
                              <nav class="ml-auto">
                                <ul class="pagination separated pagination-info">
                                  <?php if (isset($page_role3)) {
                                    if (isset($total_page_role3)) {
                                      if ($page_role3 > 1) : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                        </li>
                                        <?php endif;
                                      for ($i = 1; $i <= $total_page_role3; $i++) : if ($i <= 4) : if ($i == $page_role3) : ?>
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
                                      if ($total_page_role3 >= 4) : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role3 > 4) {
                                                                                        echo $page_role3;
                                                                                      } else if ($page_role3 <= 4) {
                                                                                        echo '5';
                                                                                      } ?>/" class="btn btn-<?php if ($page_role3 <= 4) {
                                                                                                              echo 'outline-';
                                                                                                            } ?>primary btn-sm rounded-0"><?php if ($page_role3 > 4) {
                                                                                                                                            echo $page_role3;
                                                                                                                                          } else if ($page_role3 <= 4) {
                                                                                                                                            echo '5';
                                                                                                                                          } ?></a>
                                        </li>
                                      <?php endif;
                                      if ($page_role3 < $total_page_role3 && $total_page_role3 >= 4) : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
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
              <?php }
            if ($_SESSION['data-user']['role'] == 3) { ?>
                <div class="row" id="search-page">
                  <?php if (mysqli_num_rows($produk) > 0) {
                    while ($row = mysqli_fetch_assoc($produk)) { ?>
                      <div class="col-lg-3">
                        <div class="card mt-3" style="width: 15rem;">
                          <img src="../assets/images/produk/<?= $row['img_produk'] ?>" class="card-img-top" alt="Image Produk">
                          <div class="card-body">
                            <h6><?= $row['nama_produk'] ?></h6>
                            <h3 class="card-title">Rp. <?= number_format($row['harga']) ?></h3>
                            <p><?= $row['deskripsi'] ?></p>
                            <p>Stok <?= $row['stok'] . " " . $row['satuan'] ?></p>
                            <p><i class="mdi mdi-map-marker"></i> <?= $row['lokasi'] . " (" . $row['nama_distributor'] . ")" ?></p>
                            <div class="d-flex">
                              <a href="pembayaran?id-buy=<?= $row['kode_produk'] ?>" class="btn btn-primary">Beli</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php }
                  }
                  if ($total_role6 > $data_role6) { ?>
                    <div class="d-flex justify-content-between mt-4 flex-wrap">
                      <p class="text-muted">Showing 1 to <?= $data_role6 ?> of <?= $total_role6 ?> entries</p>
                      <nav class="ml-auto">
                        <ul class="pagination separated pagination-info">
                          <?php if (isset($page_role6)) {
                            if (isset($total_page_role6)) {
                              if ($page_role6 > 1) : ?>
                                <li class="page-item">
                                  <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role6 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                </li>
                                <?php endif;
                              for ($i = 1; $i <= $total_page_role6; $i++) : if ($i <= 4) : if ($i == $page_role6) : ?>
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
                              if ($total_page_role6 >= 4) : ?>
                                <li class="page-item">
                                  <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role6 > 4) {
                                                                                echo $page_role6;
                                                                              } else if ($page_role6 <= 4) {
                                                                                echo '5';
                                                                              } ?>/" class="btn btn-<?php if ($page_role6 <= 4) {
                                                                                                      echo 'outline-';
                                                                                                    } ?>primary btn-sm rounded-0"><?php if ($page_role6 > 4) {
                                                                                                                                    echo $page_role6;
                                                                                                                                  } else if ($page_role6 <= 4) {
                                                                                                                                    echo '5';
                                                                                                                                  } ?></a>
                                </li>
                              <?php endif;
                              if ($page_role6 < $total_page_role6 && $total_page_role6 >= 4) : ?>
                                <li class="page-item">
                                  <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role6 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
                                </li>
                          <?php endif;
                            }
                          } ?>
                        </ul>
                      </nav>
                    </div>
                  <?php } ?>
                </div>
              <?php
            }
            if ($_SESSION['data-user']['role'] != 4) { ?>
            </div>
          <?php }
            require_once("../resources/dash-footer.php") ?>
</body>

</html>
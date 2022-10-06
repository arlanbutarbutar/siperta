<?php require_once("../controller/script.php"); ?>
<div class="container m-0 p-0">
  <div class="row">
    <?php if ($_SESSION['data-user']['role'] == 2) { ?>
      <div class="col-lg-3 h-100">
        <div>
          <a href="#" data-bs-toggle="modal" data-bs-target="#tambah-produk">
            <div class="card mt-3 h-100" style="width: 15rem;">
              <div class="card-body text-center mt-4">
                <i class="mdi mdi-plus menu-icon" style="font-size: 75px;"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="modal fade" id="tambah-produk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-center">
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
                    <label for="distributor" class="form-label">Distributor</label>
                    <select name="id-distributor" id="distributor" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Distributor</option>
                      <?php foreach ($distributor as $row_distributor) : ?>
                        <option value="<?= $row_distributor['id_distributor'] ?>"><?= $row_distributor['nama_distributor'] . ' (Lokasi: ' . $row_distributor['lokasi'] . ')' ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="add-produk" class="btn btn-primary text-white">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php }
    if (mysqli_num_rows($produkOverview) > 0) {
      while ($row = mysqli_fetch_assoc($produkOverview)) { ?>
        <div class="col-lg-3">
          <div class="card mt-3" style="width: 15rem;">
            <img src="../assets/images/produk/<?= $row['img_produk'] ?>" class="card-img-top" alt="Image Produk">
            <div class="card-body">
              <h6><?= $row['nama_produk'] ?></h6>
              <h3 class="card-title">Rp. <?= number_format($row['harga']) ?></h3>
              <p>Stok <?= $row['stok'] . " " . $row['satuan'] ?></p>
              <p><i class="mdi mdi-map-marker"></i> <?= $row['lokasi'] . " (" . $row['nama_distributor'] . ")" ?></p>
              <?php if ($_SESSION['data-user']['role'] == 3) { ?>
                <div class="d-flex">
                  <a href="pembayaran?id-buy=<?= $row['kode_produk'] ?>" class="btn btn-primary">Beli</a>
                </div>
              <?php } else if ($_SESSION['data-user']['role'] == 2) { ?>
                <div class="d-flex mt-3">
                  <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_produk'] ?>">Ubah</a>
                  <div class="modal fade" id="ubah<?= $row['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_produk'] ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                          <div class="modal-body text-center">
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
                              <label for="distributor" class="form-label">Distributor</label>
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
                  <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_produk'] ?>">Hapus</a>
                  <div class="modal fade" id="hapus<?= $row['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_produk'] ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                          Anda yakin ingin menghapus <?= $row['nama_produk'] ?> ini?
                        </div>
                        <form action="" method="post">
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
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
    <?php }
    } ?>
  </div>
</div>
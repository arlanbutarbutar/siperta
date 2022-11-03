<?php require_once('../controller/script.php');
if ($_SESSION['page-url'] == "users") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "users.username LIKE '%$data%' OR users.id_user!='$idUser' AND users.email LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' AND $quer ORDER BY users.id_user DESC LIMIT 100";
    $users = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($users) == 0) { ?>
    <tr>
      <td colspan="9">Belum ada data pengguna</td>
    </tr>
    <?php } else if (mysqli_num_rows($users) > 0) {
    while ($row = mysqli_fetch_assoc($users)) { ?>
      <tr>
        <td>
          <div class="d-flex">
            <img src="../assets/images/user.png" alt="">
            <div class="my-auto">
              <h6><?= $row['username'] ?></h6>
              <p><?= $row['roles'] ?></p>
            </div>
          </div>
        </td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['jenis_kelamin'] ?></td>
        <td><?= $row['telpon'] ?></td>
        <td><?= $row['alamat'] ?></td>
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
        <td>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_user'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Role <?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="role" class="form-label">Role</label>
                      <select name="role" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Pilih Role</option>
                        <?php foreach ($users_role as $row_role) : ?>
                          <option value="<?= $row_role['id_role'] ?>"><?= $row_role['roles'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-user" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['username'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="submit" name="hapus-user" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php }
  }
}
if ($_SESSION['page-url'] == "distributor") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "nama_distributor LIKE '%$data%' OR lokasi LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM distributor WHERE $quer ORDER BY id_distributor DESC LIMIT 100";
    $distributor = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($distributor) == 0) { ?>
    <tr>
      <td colspan="5">Belum ada data distributor</td>
    </tr>
    <?php } else if (mysqli_num_rows($distributor) > 0) {
    while ($row = mysqli_fetch_assoc($distributor)) { ?>
      <tr>
        <td><?= $row['nama_distributor'] ?></td>
        <td><?= $row['lokasi'] ?></td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_distributor'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_distributor'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_distributor'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['nama_distributor'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-distributor" value="<?= $row['id_distributor'] ?>">
                    <input type="hidden" name="nama" value="<?= $row['nama_distributor'] ?>">
                    <button type="submit" name="delete-distributor" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php }
  }
}
if ($_SESSION['page-url'] == "penjualan") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "produk.nama_produk LIKE '%$data%' OR users.username LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM penjualan_detail JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan JOIN produk ON penjualan_detail.id_produk=produk.id_produk JOIN satuan ON produk.id_satuan=satuan.id_satuan JOIN users ON penjualan.id_pembeli=users.id_user WHERE produk.id_penjual='$idUser' AND $quer ORDER BY penjualan_detail.id_detail DESC LIMIT 100";
    $penjualan = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($penjualan) == 0) { ?>
    <tr>
      <td colspan="9">Belum ada data pembelian</td>
    </tr>
    <?php } else if (mysqli_num_rows($penjualan) > 0) {
    while ($row = mysqli_fetch_assoc($penjualan)) { ?>
      <tr>
        <td><?= $row['kode_pembelian'] ?></td>
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
          <a href="pembayaran?confirm-pay=<?= $row['kode_pembelian'] ?>" class="btn btn-link text-decoration-none">Konfirmasi Bayar</a>
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
  }
}
if ($_SESSION['page-url'] == "produk") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      if ($_SESSION['data-user']['role'] == 2) {
        $quer .= "produk.id_penjual='$idUser' AND produk.nama_produk LIKE '%$data%'";
      } else if ($_SESSION['data-user']['role'] == 3) {
        $quer .= "produk.nama_produk LIKE '%$data%'";
      }
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM produk JOIN distributor ON produk.id_distributor=distributor.id_distributor JOIN satuan ON produk.id_satuan=satuan.id_satuan WHERE $quer ORDER BY produk.id_produk DESC LIMIT 100";
    $produk = mysqli_query($conn, $query);
  }
  if ($_SESSION['data-user']['role'] <= 2 || $_SESSION['data-user']['role'] == 4) {
    if (mysqli_num_rows($produk) == 0) { ?>
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
    }
  } else if ($_SESSION['data-user']['role'] == 3) {
    if (mysqli_num_rows($produk) > 0) {
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
  }
} ?>
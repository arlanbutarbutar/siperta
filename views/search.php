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
      <td colspan="6">Belum ada data distributor</td>
    </tr>
    <?php } else if (mysqli_num_rows($distributor) > 0) {
    while ($row = mysqli_fetch_assoc($distributor)) { ?>
      <tr>
        <td><?= $row['nama_distributor'] ?></td>
        <td><?= $row['lokasi'] ?></td>
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
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_distributor'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_distributor'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_distributor'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= $row['nama_distributor'] ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="lokasi" class="form-label">Lokasi</label>
                      <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Lokasi" value="<?= $row['lokasi'] ?>" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-distributor" value="<?= $row['id_distributor'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_distributor'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="edit-distributor" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
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
} ?>
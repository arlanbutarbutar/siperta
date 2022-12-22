<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] != 1) {
  header("Location: ./");
  exit();
}
$_SESSION['page-name'] = "Kelola Pengguna";
$_SESSION['page-url'] = "users";
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Telp</th>
                            <th>Alamat</th>
                            <th>Status Akun</th>
                            <th>Tgl Dibuat</th>
                            <th>Tgl Diubah</th>
                            <th colspan="2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="search-page">
                          <?php if (mysqli_num_rows($users) == 0) { ?>
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
                                <td><?php if ($row['id_status'] == 1) {
                                      echo "Aktif";
                                    } else if ($row['id_status'] == 2) {
                                      echo "Tidak Aktif";
                                    } ?></td>
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
                                              <label for="status" class="form-label">Status Akun</label>
                                              <select name="status" class="form-select" aria-label="Default select example" required>
                                                <option selected value="">Pilih Status</option>
                                                <option value="1">Aktif</option>
                                                <option value="2">Tidak Aktif</option>
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
                          } ?>
                        </tbody>
                      </table>
                      <?php if ($total_role1 > $data_role1) { ?>
                        <div class="d-flex justify-content-between mt-4 flex-wrap">
                          <p class="text-muted">Showing 1 to <?= $data_role1 ?> of <?= $total_role1 ?> entries</p>
                          <nav class="ml-auto">
                            <ul class="pagination separated pagination-info">
                              <?php if (isset($page_role1)) {
                                if (isset($total_page_role1)) {
                                  if ($page_role1 > 1) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role1 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                    </li>
                                    <?php endif;
                                  for ($i = 1; $i <= $total_page_role1; $i++) : if ($i <= 4) : if ($i == $page_role1) : ?>
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
                                  if ($total_page_role1 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role1 > 4) {
                                                                                    echo $page_role1;
                                                                                  } else if ($page_role1 <= 4) {
                                                                                    echo '5';
                                                                                  } ?>/" class="btn btn-<?php if ($page_role1 <= 4) {
                                                                                                          echo 'outline-';
                                                                                                        } ?>primary btn-sm rounded-0"><?php if ($page_role1 > 4) {
                                                                                                                                      echo $page_role1;
                                                                                                                                    } else if ($page_role1 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                    </li>
                                  <?php endif;
                                  if ($page_role1 < $total_page_role1 && $total_page_role1 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role1 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
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
<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] != 1) {
  header("Location: ./");
  exit();
}
$_SESSION['page-name'] = "Kelola Distributor";
$_SESSION['page-url'] = "distributor";
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
            <div class="col-lg-3">
              <div class="card card-rounded mt-3">
                <img src="../assets/images/distributor.png" class="card-img-top" alt="">
                <div class="card-body text-center">
                  <h5 class="card-title">Tambah Distributor</h5>
                  <form action="" method="post">
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <select class="form-select" name="id-user" id="nama" aria-label="Default select example" required>
                        <option selected value="">Pilih Distributor</option>
                        <?php foreach ($select_distributor as $row_dis) : ?>
                          <option value="<?= $row_dis['id_user'] ?>"><?= $row_dis['username'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <button type="submit" name="add-distributor" class="btn btn-primary mt-3">Tambah</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="home-tab">
                <div class="card card-rounded mt-3">
                  <div class="card-body">
                    <div class="table-responsive mt-1">
                      <table class="table select-table text-center">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th colspan="1">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="search-page">
                          <?php if (mysqli_num_rows($distributor) == 0) { ?>
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
                          } ?>
                        </tbody>
                      </table>
                      <?php if ($total_role2 > $data_role2) { ?>
                        <div class="d-flex justify-content-between mt-4 flex-wrap">
                          <p class="text-muted">Showing 1 to <?= $data_role2 ?> of <?= $total_role2 ?> entries</p>
                          <nav class="ml-auto">
                            <ul class="pagination separated pagination-info">
                              <?php if (isset($page_role2)) {
                                if (isset($total_page_role2)) {
                                  if ($page_role2 > 1) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                    </li>
                                    <?php endif;
                                  for ($i = 1; $i <= $total_page_role2; $i++) : if ($i <= 4) : if ($i == $page_role2) : ?>
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
                                  if ($total_page_role2 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role2 > 4) {
                                                                                    echo $page_role2;
                                                                                  } else if ($page_role2 <= 4) {
                                                                                    echo '5';
                                                                                  } ?>/" class="btn btn-<?php if ($page_role2 <= 4) {
                                                                                                          echo 'outline-';
                                                                                                        } ?>primary btn-sm rounded-0"><?php if ($page_role2 > 4) {
                                                                                                                                      echo $page_role2;
                                                                                                                                    } else if ($page_role2 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                    </li>
                                  <?php endif;
                                  if ($page_role2 < $total_page_role2 && $total_page_role2 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
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
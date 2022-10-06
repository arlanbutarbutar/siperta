<?php require_once("../controller/script.php");
if (isset($_SESSION['data-user'])) {
  header("Location: ../views/");
  exit();
}
$_SESSION['page-name'] = "Daftar Akun";
$_SESSION['page-url'] = "daftar";
?>
<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/auth-header.php") ?></head>

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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <h4>Daftar Akun SIPERTA</h4>
              <h6 class="fw-light">Daftarkan akun kamu untuk mulai berbelanja.</h6>
              <form class="pt-3" action="" method="POST" autocomplete="off">
                <div class="form-group">
                  <label for="username">Nama</label>
                  <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) {
                                                                            echo $_POST['username'];
                                                                          } ?>" class="form-control form-control-lg" placeholder="Username" minlength="3" required>
                </div>
                <div class="form-group">
                  <label for="email">e-Mail</label>
                  <input type="email" name="email" id="email" value="<?php if (isset($_POST['email'])) {
                                                                        echo $_POST['email'];
                                                                      } ?>" class="form-control form-control-lg" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="password">Kata Sandi</label>
                  <input type="password" name="password" id="password" value="<?php if (isset($_POST['password'])) {
                                                                                echo $_POST['password'];
                                                                              } ?>" class="form-control form-control-lg" placeholder="Kata Sandi" min="8" required>
                </div>
                <div class="form-group">
                  <label for="jenis-kelamin">Jenis Kelamin</label>
                  <select name="jenis-kelamin" id="jenis-kelamin" class="form-control form-control-lg" required>
                    <?php if (!isset($_POST['jenis-kelamin'])) { ?>
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value='Pria'>Pria</option>
                      <option value='Wanita'>Wanita</option>
                    <?php } else if (isset($_POST['jenis-kelamin'])) {
                      if ($_POST['jenis-kelamin'] == "Pria") {
                        echo "
                          <option value='Pria'>Pria</option>
                          <option value='Wanita'>Wanita</option>
                        ";
                      } else {
                        echo "
                          <option value='Wanita'>Wanita</option>
                          <option value='Pria'>Pria</option>
                        ";
                      }
                    } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="telpon">Telepon</label>
                  <input type="number" name="telpon" id="telpon" value="<?php if (isset($_POST['telpon'])) {
                                                                          echo $_POST['telpon'];
                                                                        } ?>" placeholder="telpon" class="form-control form-control-lg" minlength="11" maxlength="12" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" id="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                                        echo $_POST['alamat'];
                                                                      } ?>" placeholder="Alamat" class="form-control form-control-lg" minlength="5" required>
                </div>
                <div class="mt-3">
                  <button type="submit" name="daftar" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Daftar</button>
                </div>
              </form>
              <p class="mt-3 d-flex justify-content-center">Sudah punya akun? <a href="./" class="nav-link p-0">Masuk</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once("../resources/auth-footer.php") ?>
</body>

</html>
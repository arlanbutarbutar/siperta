<?php if (!isset($_SESSION[''])) {
  session_start();
}
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");

if (isset($_SESSION['time-message'])) {
  if ((time() - $_SESSION['time-message']) > 2) {
    if (isset($_SESSION['message-success'])) {
      unset($_SESSION['message-success']);
    }
    if (isset($_SESSION['message-info'])) {
      unset($_SESSION['message-info']);
    }
    if (isset($_SESSION['message-warning'])) {
      unset($_SESSION['message-warning']);
    }
    if (isset($_SESSION['message-danger'])) {
      unset($_SESSION['message-danger']);
    }
    if (isset($_SESSION['message-dark'])) {
      unset($_SESSION['message-dark']);
    }
    unset($_SESSION['time-alert']);
  }
}

$baseURL = "http://127.0.0.1:1010/apps/siperta/";

// if (!isset($_SESSION['data-user'])) {
if (isset($_POST['daftar'])) {
  if (daftar($_POST) > 0) {
    $_SESSION['message-success'] = "Akun kamu berhasil didaftarkan, silakan masuk untuk mulai berbelanja.";
    $_SESSION['time-message'] = time();
    header("Location: ./");
    exit();
  }
}
if (isset($_POST['masuk'])) {
  if (masuk($_POST) > 0) {
  }
}

$card_produk = mysqli_query($conn, "SELECT * FROM produk JOIN distributor ON produk.id_distributor=distributor.id_distributor JOIN satuan ON produk.id_satuan=satuan.id_satuan");
if (isset($_POST['buy-product-visitor'])) {
  $_SESSION['id-buy'] = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-buy']))));
  header("Location: auth/");
  exit();
}
// }
if (isset($_SESSION['data-user'])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['id']))));
  $users_role = mysqli_query($conn, "SELECT * FROM users_role");

  if ($_SESSION['data-user']['role'] == 1) {
    $data_role1 = 25;
    $result_role1 = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser'");
    $total_role1 = mysqli_num_rows($result_role1);
    $total_page_role1 = ceil($total_role1 / $data_role1);
    $page_role1 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role1 = ($page_role1 > 1) ? ($page_role1 * $data_role1) - $data_role1 : 0;
    $users = mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' ORDER BY users.id_user DESC LIMIT $awal_data_role1, $data_role1");
    if (isset($_POST['ubah-user'])) {
      if (ubah_user($_POST) > 0) {
        $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['hapus-user'])) {
      if (hapus_user($_POST) > 0) {
        $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }

    $data_role2 = 25;
    $result_role2 = mysqli_query($conn, "SELECT * FROM distributor");
    $total_role2 = mysqli_num_rows($result_role2);
    $total_page_role2 = ceil($total_role2 / $data_role2);
    $page_role2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role2 = ($page_role2 > 1) ? ($page_role2 * $data_role2) - $data_role2 : 0;
    $distributor = mysqli_query($conn, "SELECT * FROM distributor ORDER BY id_distributor DESC LIMIT $awal_data_role2, $data_role2");
    $select_distributor = mysqli_query($conn, "SELECT * FROM users WHERE id_role='4'");
    if (isset($_POST['add-distributor'])) {
      if (add_distributor($_POST) > 0) {
        $_SESSION['message-success'] = "Distributor " . $_POST['nama'] . " berhasil di tambahkan.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['delete-distributor'])) {
      if (delete_distributor($_POST) > 0) {
        $_SESSION['message-success'] = "Distributor " . $_POST['nama'] . " berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }

    $data_role3 = 25;
    $result_role3 = mysqli_query($conn, "SELECT * FROM produk");
    $total_role3 = mysqli_num_rows($result_role3);
    $total_page_role3 = ceil($total_role3 / $data_role3);
    $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
    $produk = mysqli_query($conn, "SELECT * FROM produk JOIN distributor ON produk.id_distributor=distributor.id_distributor JOIN satuan ON produk.id_satuan=satuan.id_satuan ORDER BY produk.id_produk DESC LIMIT $awal_data_role3, $data_role3");

    $data_role4 = 25;
    $result_role4 = mysqli_query($conn, "SELECT * FROM penjualan_detail");
    $total_role4 = mysqli_num_rows($result_role4);
    $total_page_role4 = ceil($total_role4 / $data_role4);
    $page_role4 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role4 = ($page_role4 > 1) ? ($page_role4 * $data_role4) - $data_role4 : 0;
    $penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
      JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
      JOIN produk ON penjualan_detail.id_produk=produk.id_produk
      JOIN satuan ON produk.id_satuan=satuan.id_satuan
      JOIN users ON penjualan.id_pembeli=users.id_user
      ORDER BY penjualan_detail.id_detail 
      DESC LIMIT $awal_data_role4, $data_role4
    ");

    $laporan_penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
      JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
      JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan
      JOIN produk ON penjualan_detail.id_produk=produk.id_produk
      JOIN satuan ON produk.id_satuan=satuan.id_satuan
      JOIN users ON penjualan.id_pembeli=users.id_user
      ORDER BY penjualan_detail.id_detail DESC
    ");
  }

  if ($_SESSION['data-user']['role'] <= 2) {
    if (isset($_POST['edit-produk'])) {
      if (edit_produk($_POST) > 0) {
        $_SESSION['message-success'] = "Produk " . $_POST['nama-produk'] . " berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['delete-produk'])) {
      if (delete_produk($_POST) > 0) {
        $_SESSION['message-success'] = "Produk " . $_POST['nama-produk'] . " berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }

    if (isset($_POST['confirm-pay'])) {
      if (confirm_pay($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil mengkonfirmasi pembayaran.";
        $_SESSION['time-message'] = time();
        header("Location: penjualan");
        exit();
      }
    }

    if ($_SESSION['data-user']['role'] == 2) {
      $distributor = mysqli_query($conn, "SELECT * FROM distributor");
      $satuan = mysqli_query($conn, "SELECT * FROM satuan");

      $data_role3 = 25;
      $result_role3 = mysqli_query($conn, "SELECT * FROM produk");
      $total_role3 = mysqli_num_rows($result_role3);
      $total_page_role3 = ceil($total_role3 / $data_role3);
      $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
      $produk = mysqli_query($conn, "SELECT * FROM produk JOIN distributor ON produk.id_distributor=distributor.id_distributor JOIN satuan ON produk.id_satuan=satuan.id_satuan WHERE produk.id_penjual='$idUser' ORDER BY produk.id_produk DESC LIMIT $awal_data_role3, $data_role3");
      if (isset($_POST['add-produk'])) {
        if (add_produk($_POST) > 0) {
          $_SESSION['message-success'] = "Produk baru berhasil di tambahkan.";
          $_SESSION['time-message'] = time();
          header("Location: " . $_SESSION['page-url']);
          exit();
        }
      }

      $data_role4 = 25;
      $result_role4 = mysqli_query($conn, "SELECT * FROM penjualan_detail");
      $total_role4 = mysqli_num_rows($result_role4);
      $total_page_role4 = ceil($total_role4 / $data_role4);
      $page_role4 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $awal_data_role4 = ($page_role4 > 1) ? ($page_role4 * $data_role4) - $data_role4 : 0;
      $penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
        JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
        JOIN produk ON penjualan_detail.id_produk=produk.id_produk
        JOIN satuan ON produk.id_satuan=satuan.id_satuan
        JOIN users ON penjualan.id_pembeli=users.id_user
        WHERE produk.id_penjual='$idUser' 
        ORDER BY penjualan_detail.id_detail 
        DESC LIMIT $awal_data_role4, $data_role4
      ");

      $laporan_penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
        JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
        JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan
        JOIN produk ON penjualan_detail.id_produk=produk.id_produk
        JOIN satuan ON produk.id_satuan=satuan.id_satuan
        JOIN users ON penjualan.id_pembeli=users.id_user
        WHERE produk.id_penjual='$idUser' 
        ORDER BY penjualan_detail.id_detail DESC
      ");
    }
  }

  if ($_SESSION['data-user']['role'] <= 3) {

    if (isset($_GET['confirm-pay'])) {
      $id_pembelian = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['confirm-pay']))));
      $confirm_pay = mysqli_query($conn, "SELECT * FROM penjualan_detail 
        JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
        JOIN produk ON penjualan_detail.id_produk=produk.id_produk 
        JOIN satuan ON produk.id_satuan=satuan.id_satuan
        WHERE penjualan_detail.kode_pembelian='$id_pembelian'
      ");
    }

    if ($_SESSION['data-user']['role'] == 3) {
      if (isset($_POST['confirm-pay'])) {
        if (confirm_pay($_POST) > 0) {
          $_SESSION['message-success'] = "Berhasil mengkonfirmasi pembayaran.";
          $_SESSION['time-message'] = time();
          header("Location: " . $_SESSION['page-url']);
          exit();
        }
      }
      if (isset($_GET['id-buy'])) {
        $id_buy = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id-buy']))));
        $proses_pembayaran = mysqli_query($conn, "SELECT * FROM produk
          JOIN users ON produk.id_penjual=users.id_user
          JOIN distributor ON produk.id_distributor=distributor.id_distributor
          JOIN satuan ON produk.id_satuan=satuan.id_satuan
          WHERE produk.kode_produk='$id_buy'
        ");
        if (isset($_POST['buy-product'])) {
          if (buy_product($_POST) > 0) {
            $_SESSION['message-success'] = "Pembelian berhasil! Silakan ke lokasi untuk pengambilan " . $_POST['nama-produk'] . ".";
            $_SESSION['time-message'] = time();
            header("Location: pembayaran");
            exit();
          }
        }
      }

      $data_role5 = 25;
      $result_role5 = mysqli_query($conn, "SELECT * FROM pembayaran");
      $total_role5 = mysqli_num_rows($result_role5);
      $total_page_role5 = ceil($total_role5 / $data_role5);
      $page_role5 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $awal_data_role5 = ($page_role5 > 1) ? ($page_role5 * $data_role5) - $data_role5 : 0;
      $pembayaran = mysqli_query($conn, "SELECT * FROM penjualan_detail
        JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
        JOIN produk ON penjualan_detail.id_produk=produk.id_produk
        JOIN satuan ON produk.id_satuan=satuan.id_satuan
        JOIN users ON produk.id_penjual=users.id_user
        WHERE penjualan.id_pembeli='$idUser' ORDER BY penjualan_detail.id_detail DESC LIMIT $awal_data_role5, $data_role5
      ");

      $data_role6 = 25;
      $result_role6 = mysqli_query($conn, "SELECT * FROM produk");
      $total_role6 = mysqli_num_rows($result_role6);
      $total_page_role6 = ceil($total_role6 / $data_role6);
      $page_role6 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $awal_data_role6 = ($page_role6 > 1) ? ($page_role6 * $data_role6) - $data_role6 : 0;
      $produk = mysqli_query($conn, "SELECT * FROM produk 
        JOIN distributor ON produk.id_distributor=distributor.id_distributor 
        JOIN satuan ON produk.id_satuan=satuan.id_satuan 
        ORDER BY produk.id_produk DESC LIMIT $awal_data_role6, $data_role6
      ");

      $my_inv = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
      $row_inv = mysqli_fetch_assoc($my_inv);
    }
  }

  if ($_SESSION['data-user']['role'] <= 4) {
    $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
    if (isset($_POST['ubah-profile'])) {
      if (ubah_profile($_POST) > 0) {
        $_SESSION['message-success'] = "Profil akun anda berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    
    $produkOverview = mysqli_query($conn, "SELECT * FROM produk JOIN distributor ON produk.id_distributor=distributor.id_distributor JOIN satuan ON produk.id_satuan=satuan.id_satuan ORDER BY produk.id_produk DESC LIMIT 15");

    if ($_SESSION['data-user']['role'] == 4) {
      $data_role3 = 25;
      $result_role3 = mysqli_query($conn, "SELECT * FROM produk");
      $total_role3 = mysqli_num_rows($result_role3);
      $total_page_role3 = ceil($total_role3 / $data_role3);
      $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
      $produk = mysqli_query($conn, "SELECT * FROM produk 
        JOIN distributor ON produk.id_distributor=distributor.id_distributor 
        JOIN satuan ON produk.id_satuan=satuan.id_satuan 
        WHERE distributor.id_user='$idUser' 
        ORDER BY produk.id_produk 
        DESC LIMIT $awal_data_role3, $data_role3
      ");

      $data_role4 = 25;
      $result_role4 = mysqli_query($conn, "SELECT * FROM penjualan_detail");
      $total_role4 = mysqli_num_rows($result_role4);
      $total_page_role4 = ceil($total_role4 / $data_role4);
      $page_role4 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $awal_data_role4 = ($page_role4 > 1) ? ($page_role4 * $data_role4) - $data_role4 : 0;
      $penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
        JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
        JOIN produk ON penjualan_detail.id_produk=produk.id_produk
        JOIN distributor ON produk.id_distributor=distributor.id_distributor 
        JOIN satuan ON produk.id_satuan=satuan.id_satuan
        JOIN users ON penjualan.id_pembeli=users.id_user
        WHERE distributor.id_user='$idUser' 
        ORDER BY penjualan_detail.id_detail 
        DESC LIMIT $awal_data_role4, $data_role4
      ");

      $laporan_penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
        JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
        JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan
        JOIN produk ON penjualan_detail.id_produk=produk.id_produk
        JOIN distributor ON produk.id_distributor=distributor.id_distributor 
        JOIN satuan ON produk.id_satuan=satuan.id_satuan
        JOIN users ON penjualan.id_pembeli=users.id_user
        WHERE distributor.id_user='$idUser' 
        ORDER BY penjualan_detail.id_detail DESC
      ");
    }
  }
}

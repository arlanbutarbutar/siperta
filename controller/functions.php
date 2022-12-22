<?php
// if (!isset($_SESSION['data-user'])) {
function daftar($data)
{
  global $conn;
  $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
  $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
  $checkMail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($checkMail) > 0) {
    $_SESSION['message-danger'] = "Maaf, akun yang kamu masukan sudah terdaftar.";
    $_SESSION['time-message'] = time();
    return false;
  }
  $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
  $jenis_kelamin = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jenis-kelamin']))));
  $telpon = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telpon']))));
  $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
  $password = password_hash($password, PASSWORD_DEFAULT);
  $id_role = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
  if ($id_role == 3) {
    $id_status = 1;
  } else {
    $id_status = 2;
  }
  mysqli_query($conn, "INSERT INTO users(id_role,id_status,username,email,password,jenis_kelamin,telpon,alamat) VALUES('$id_role','$id_status','$username','$email','$password','$jenis_kelamin','$telpon','$alamat')");
  return mysqli_affected_rows($conn);
}
function masuk($data)
{
  global $conn;
  $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
  $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));

  // check account
  $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($checkAccount) == 0) {
    $_SESSION['message-danger'] = "Maaf, akun yang anda masukan belum terdaftar.";
    $_SESSION['time-message'] = time();
    return false;
  } else if (mysqli_num_rows($checkAccount) > 0) {
    $row = mysqli_fetch_assoc($checkAccount);
    if ($row['id_status'] == 2) {
      $_SESSION['message-danger'] = "Maaf, akun anda belum di aktivasi oleh admin.";
      $_SESSION['time-message'] = time();
      return false;
    } else if ($row['id_status'] == 1) {
      if (password_verify($password, $row['password'])) {
        $_SESSION['data-user'] = [
          'id' => $row['id_user'],
          'role' => $row['id_role'],
          'username' => $row['username'],
          'email' => $row['email'],
        ];
        if ($row['id_role'] != 3) {
          header("Location: ../views/");
          exit();
        } else if ($row['id_role'] == 3) {
          if (isset($_SESSION['id-buy'])) {
            header("Location: ../views/pembayaran?id-buy=" . $_SESSION['id-buy']);
            exit();
          } else if (!isset($_SESSION['id-buy'])) {
            header("Location: ../views/");
            exit();
          }
        }
      } else {
        $_SESSION['message-danger'] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
  }
}
// }
if (isset($_SESSION['data-user'])) {
  if ($_SESSION['data-user']['role'] == 1) {
    function ubah_user($data)
    {
      global $conn, $time;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE users SET id_status='$status', updated_at='$updated_at' WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function hapus_user($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function add_petani($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      $checkNama = mysqli_query($conn, "SELECT * FROM petani WHERE id_user='$id_user'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama petani yang anda masukan sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      } else {
        $takeUser = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
        $row = mysqli_fetch_assoc($takeUser);
        $nama = $row['username'];
        $lokasi = $row['alamat'];
        mysqli_query($conn, "INSERT INTO petani(id_user,nama_petani,lokasi) VALUES('$id_user','$nama','$lokasi')");
      }
      return mysqli_affected_rows($conn);
    }
    function delete_petani($data)
    {
      global $conn;
      $id_petani = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-petani']))));
      mysqli_query($conn, "DELETE FROM petani WHERE id_petani='$id_petani'");
      return mysqli_affected_rows($conn);
    }
  }
  if ($_SESSION['data-user']['role'] <= 2) {
    function imageProduk()
    {
      $namaFile = $_FILES["image"]["name"];
      $ukuranFile = $_FILES["image"]["size"];
      $error = $_FILES["image"]["error"];
      $tmpName = $_FILES["image"]["tmp_name"];
      if ($error === 4) {
        $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
        $_SESSION['time-message'] = time();
        return false;
      }
      $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
        $_SESSION['time-message'] = time();
        return false;
      }
      if ($ukuranFile > 2000000) {
        $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message'] = time();
        return false;
      }
      $namaFile_encrypt = crc32($namaFile);
      $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
      move_uploaded_file($tmpName, '../assets/images/produk/' . $encrypt);
      return $encrypt;
    }
    function edit_produk($data)
    {
      global $conn, $time;
      $id_produk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-produk']))));
      $img_produk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['img-produk']))));
      if (!empty($_FILES['image']['name'])) {
        $image = imageProduk();
        if (!$image) {
          return false;
        } else {
          unlink('../assets/images/produk/' . $img_produk);
        }
      } else {
        $image = $img_produk;
      }
      $id_petani = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-petani']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
      $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));
      $satuan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['satuan']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE produk SET id_petani='$id_petani', img_produk='$image', nama_produk='$nama', harga='$harga', stok='$stok', id_satuan='$satuan', updated_at='$updated_at' WHERE id_produk='$id_produk'");
      return mysqli_affected_rows($conn);
    }
    function delete_produk($data)
    {
      global $conn;
      $id_produk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-produk']))));
      $img_produk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['img-produk']))));
      unlink('../assets/images/produk/' . $img_produk);
      mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id_produk'");
      return mysqli_affected_rows($conn);
    }
    if ($_SESSION['data-user']['role'] == 2) {
      function add_produk($data)
      {
        global $conn, $idUser;
        $kode_produk = mt_rand(1000, 9999);
        $image = imageProduk();
        if (!$image) {
          return false;
        }
        $id_petani = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-petani']))));
        $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
        $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
        $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));
        $satuan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['satuan']))));
        mysqli_query($conn, "INSERT INTO produk(id_petani,id_pengepul,kode_produk,img_produk,nama_produk,harga,stok,id_satuan) VALUES('$id_petani','$idUser','$kode_produk','$image','$nama','$harga','$stok','$satuan')");
        return mysqli_affected_rows($conn);
      }
    }
  }
  if ($_SESSION['data-user']['role'] <= 4) {
    function ubah_profile($data)
    {
      global $conn, $idUser;
      $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
      $jenis_kelamin = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jk']))));
      $telpon = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telpon']))));
      $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
      $norek = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['norek']))));
      $bank = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bank']))));
      mysqli_query($conn, "UPDATE users SET username='$username', jenis_kelamin='$jenis_kelamin', telpon='$telpon', alamat='$alamat', norek='$norek', bank='$bank' WHERE id_user='$idUser'");
      return mysqli_affected_rows($conn);
    }
    function imageBayar()
    {
      $namaFile = $_FILES["image"]["name"];
      $ukuranFile = $_FILES["image"]["size"];
      $error = $_FILES["image"]["error"];
      $tmpName = $_FILES["image"]["tmp_name"];
      if ($error === 4) {
        $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
        $_SESSION['time-message'] = time();
        return false;
      }
      $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
        $_SESSION['time-message'] = time();
        return false;
      }
      if ($ukuranFile > 2000000) {
        $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message'] = time();
        return false;
      }
      $namaFile_encrypt = crc32($namaFile);
      $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
      move_uploaded_file($tmpName, '../assets/images/pembayaran/' . $encrypt);
      return $encrypt;
    }
    function confirm_pay($data)
    {
      global $conn;
      $id_penjualan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-penjualan']))));
      $metode_bayar = "Tunai";
      $total = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['total']))));
      $image = imageBayar();
      if (!$image) {
        return false;
      }
      $id_produk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-produk']))));
      $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));
      $jumlah_beli = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jumlah-beli']))));
      $stok_now = $stok - $jumlah_beli;
      mysqli_query($conn, "UPDATE produk SET stok='$stok_now' WHERE id_produk='$id_produk'");
      mysqli_query($conn, "INSERT INTO pembayaran(id_penjualan,metode_bayar,total,bukti_bayar) VALUES('$id_penjualan','$metode_bayar','$total','$image')");
      return mysqli_affected_rows($conn);
    }
    function confirm_invalid($data)
    {
      global $conn;
      $id_bayar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bayar']))));
      mysqli_query($conn, "UPDATE pembayaran SET status_bayar='2' WHERE id_bayar='$id_bayar'");
      return mysqli_affected_rows($conn);
    }
    function confirm_valid($data)
    {
      global $conn;
      $id_bayar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bayar']))));
      mysqli_query($conn, "UPDATE pembayaran SET status_bayar='1' WHERE id_bayar='$id_bayar'");
      return mysqli_affected_rows($conn);
    }
    if ($_SESSION['data-user']['role'] == 3) {
      function buy_product($data)
      {
        global $conn, $idUser;
        $id_produk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-produk']))));
        $takeID = mysqli_query($conn, "SELECT * FROM penjualan ORDER BY id_penjualan DESC LIMIT 1");
        if (mysqli_num_rows($takeID) > 0) {
          $rowID = mysqli_fetch_assoc($takeID);
          $id_penjualan = $rowID['id_penjualan'] + 1;
        } else {
          $id_penjualan = 1;
        }
        $kode_pembelian = mt_rand(1000, 9999);
        $ket = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ket']))));
        $jumlah_beli = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jumlah-beli']))));
        $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));
        $satuan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['satuan']))));
        if ($jumlah_beli > $stok) {
          $_SESSION['message-danger'] = "Maaf, jumlah pembelian yang anda inginkan melampaui batas persedian yaitu " . $stok . " " . $satuan . ".";
          $_SESSION['time-message'] = time();
          return false;
        }
        $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
        $total = $jumlah_beli * $harga;
        mysqli_query($conn, "INSERT INTO penjualan(id_penjualan,id_pembeli,keterangan,jumlah_beli,total) VALUES('$id_penjualan','$idUser','$ket','$jumlah_beli','$total')");
        mysqli_query($conn, "INSERT INTO penjualan_detail(id_produk,id_penjualan,kode_pembelian) VALUES('$id_produk','$id_penjualan','$kode_pembelian')");
        return mysqli_affected_rows($conn);
      }
      function confirm_try($data)
      {
        global $conn;
        $id_bayar = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bayar']))));
        $imageOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['imageOld']))));
        if (!empty($_FILES['image']['name'])) {
          $image = imageBayar();
          if (!$image) {
            return false;
          } else {
            unlink('../assets/images/pembayaran/' . $imageOld);
          }
        } else {
          $image = $imageOld;
        }
        mysqli_query($conn, "UPDATE pembayaran SET bukti_bayar='$image', status_bayar='3' WHERE id_bayar='$id_bayar'");
        return mysqli_affected_rows($conn);
      }
    }
  }
}

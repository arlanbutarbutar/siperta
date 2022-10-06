<?php
if (!isset($_SESSION['data-user'])) {
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
    mysqli_query($conn, "INSERT INTO users(username,email,password,jenis_kelamin,telpon,alamat) VALUES('$username','$email','$password','$jenis_kelamin','$telpon','$alamat')");
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
      if (password_verify($password, $row['password'])) {
        $_SESSION['data-user'] = [
          'id' => $row['id_user'],
          'role' => $row['id_role'],
          'username' => $row['username'],
          'email' => $row['email'],
        ];
      } else {
        $_SESSION['message-danger'] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
  }
}
if (isset($_SESSION['data-user'])) {
  if ($_SESSION['data-user']['role'] == 1) {
    function ubah_user($data)
    {
      global $conn, $time;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      $role = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['role']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE users SET id_role='$role', updated_at='$updated_at' WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function hapus_user($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function add_distributor($data)
    {
      global $conn;
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $checkNama = mysqli_query($conn, "SELECT * FROM distributor WHERE nama_distributor='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama distributor yang anda masukan sudah ada.";
        $_SESSION['time-message'] = time();
        return false;
      }
      $lokasi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['lokasi']))));
      mysqli_query($conn, "INSERT INTO distributor(nama_distributor,lokasi) VALUES('$nama','$lokasi')");
      return mysqli_affected_rows($conn);
    }
    function edit_distributor($data)
    {
      global $conn, $time;
      $id_distributor = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-distributor']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
      if ($nama != $namaOld) {
        $checkNama = mysqli_query($conn, "SELECT * FROM distributor WHERE nama_distributor='$nama'");
        if (mysqli_num_rows($checkNama) > 0) {
          $_SESSION['message-danger'] = "Maaf, nama distributor yang anda masukan sudah ada.";
          $_SESSION['time-message'] = time();
          return false;
        }
      }
      $lokasi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['lokasi']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE distributor SET nama_distributor='$nama', lokasi='$lokasi', updated_at='$updated_at' WHERE id_distributor='$id_distributor'");
      return mysqli_affected_rows($conn);
    }
    function delete_distributor($data)
    {
      global $conn;
      $id_distributor = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-distributor']))));
      mysqli_query($conn, "DELETE FROM distributor WHERE id_distributor='$id_distributor'");
      return mysqli_affected_rows($conn);
    }
  }
  if ($_SESSION['data-user']['role'] == 2) {
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
    function add_produk($data)
    {
      global $conn, $idUser;
      $kode_produk = mt_rand(1000, 9999);
      $image = imageProduk();
      if (!$image) {
        return false;
      }
      $id_distributor = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-distributor']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
      $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));
      $satuan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['satuan']))));
      mysqli_query($conn, "INSERT INTO produk(id_distributor,id_penjual,kode_produk,img_produk,nama_produk,harga,stok,id_satuan) VALUES('$id_distributor','$idUser','$kode_produk','$image','$nama','$harga','$stok','$satuan')");
      return mysqli_affected_rows($conn);
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
      $id_distributor = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-distributor']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $harga = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['harga']))));
      $stok = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['stok']))));
      $satuan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['satuan']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE produk SET id_distributor='$id_distributor', img_produk='$image', nama_produk='$nama', harga='$harga', stok='$stok', id_satuan='$satuan', updated_at='$updated_at' WHERE id_produk='$id_produk'");
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
  }
  if ($_SESSION['data-user']['role'] == 3) {
  }
}

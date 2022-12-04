<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Cetak Laporan";
$_SESSION['page-url'] = "cetak-laporan";

if ($_SESSION['data-user']['role'] == 1) {
  $penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
    JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
    JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan
    JOIN produk ON penjualan_detail.id_produk=produk.id_produk
    JOIN satuan ON produk.id_satuan=satuan.id_satuan
    JOIN users ON penjualan.id_pembeli=users.id_user
    ORDER BY penjualan_detail.id_detail DESC
  ");
}
if ($_SESSION['data-user']['role'] == 2) {
  $penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
    JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
    JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan
    JOIN produk ON penjualan_detail.id_produk=produk.id_produk
    JOIN satuan ON produk.id_satuan=satuan.id_satuan
    JOIN users ON penjualan.id_pembeli=users.id_user
    WHERE produk.id_pengepul='$idUser' 
    ORDER BY penjualan_detail.id_detail DESC
  ");
}
if ($_SESSION['data-user']['role'] == 4) {
  $penjualan = mysqli_query($conn, "SELECT * FROM penjualan_detail 
    JOIN penjualan ON penjualan_detail.id_penjualan=penjualan.id_penjualan
    JOIN pembayaran ON penjualan.id_penjualan=pembayaran.id_penjualan
    JOIN produk ON penjualan_detail.id_produk=produk.id_produk
    JOIN petani ON produk.id_petani=petani.id_petani 
    JOIN satuan ON produk.id_satuan=satuan.id_satuan
    JOIN users ON penjualan.id_pembeli=users.id_user
    WHERE petani.id_user='$idUser' 
    ORDER BY penjualan_detail.id_detail DESC
  ");
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Penjualan SIPERTA.xls");
?>

<center>
  <h3>Data Penjualan SIPERTA</h3>
</center>
<table border="1">
  <thead>
    <tr>
      <th>#Kode Pembelian</th>
      <th>Nama Produk</th>
      <th>Pembeli</th>
      <th>Keterangan</th>
      <th>Jumlah Beli</th>
      <th>Harga</th>
      <th>Total</th>
      <th>Status Bayar</th>
      <th>Tgl Beli</th>
    </tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($penjualan) == 0) { ?>
      <tr>
        <td colspan="9">Belum ada data pembelian</td>
      </tr>
      <?php } else if (mysqli_num_rows($penjualan) > 0) {
      while ($row = mysqli_fetch_assoc($penjualan)) { ?>
        <tr>
          <td>#<?= $row['kode_pembelian'] ?></td>
          <td><?= $row['nama_produk'] ?></td>
          <td><?= $row['username'] ?><br>Telp: <?= $row['telpon'] ?></td>
          <td><?= $row['keterangan'] ?></td>
          <td><?= $row['jumlah_beli'] . " " . $row['satuan'] ?></td>
          <td>Rp. <?= number_format($row['harga']) ?></td>
          <td>Rp. <?= number_format($row['total']) ?></td>
          <td>
            <?php $id_penjualan = $row['id_penjualan'];
            $pay = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_penjualan='$id_penjualan'");
            if (mysqli_num_rows($pay) == 0) { ?>
              <p>Konfirmasi Bayar</p>
            <?php } else { ?>
              <p><i class="mdi mdi-check-circle text-success"></i> Pembayaran Berhasil</p>
            <?php } ?>
          </td>
          <td>
            <div class="badge badge-opacity-success">
              <?php $dateCreate = date_create($row['created_at']);
              echo date_format($dateCreate, "d M Y h:i a"); ?>
            </div>
          </td>
        </tr>
    <?php }
    } ?>
  </tbody>
</table>
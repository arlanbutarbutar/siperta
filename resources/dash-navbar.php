<div class="d-sm-flex align-items-center justify-content-between border-bottom">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link action active ps-0" id="overview" data-bs-toggle="tab" role="tab" style="cursor: pointer;" aria-controls="overview" aria-selected="true">Ringkasan</a>
    </li>
    <?php if ($_SESSION['data-user']['role'] == 2) { ?>
      <li class="nav-item">
        <a class="nav-link action" id="sale" data-bs-toggle="tab" role="tab" style="cursor: pointer;" aria-controls="sale" aria-selected="true">Penjualan</a>
      </li>
    <?php }
    if ($_SESSION['data-user']['role'] != 1) { ?>
      <li class="nav-item">
        <a class="nav-link action border-0" id="payment" data-bs-toggle="tab" role="tab" style="cursor: pointer;" aria-controls="payment" aria-selected="true">Pembayaran</a>
      </li>
    <?php } ?>
  </ul>
</div>
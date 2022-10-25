<nav class="sidebar sidebar-offcanvas shadow" id="sidebar" style="background-color: #0A62C7;">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon text-white"></i>
        <span class="menu-title text-white">Dashboard</span>
      </a>
    </li>
    <?php if($_SESSION['data-user']['role']==1){?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
        <i class="mdi mdi-account-multiple-outline menu-icon text-white"></i>
        <span class="menu-title text-white">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='distributor'">
        <i class="mdi mdi-account-multiple-outline menu-icon text-white"></i>
        <span class="menu-title text-white">Distributor</span>
      </a>
    </li>
    <?php }?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='produk'">
        <i class="mdi mdi-cube menu-icon text-white"></i>
        <span class="menu-title text-white">Produk</span>
      </a>
    </li>
    <?php if($_SESSION['data-user']['role']<=2){?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='penjualan'">
        <i class="mdi mdi-cart-outline menu-icon text-white"></i>
        <span class="menu-title text-white">Penjualan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='laporan'">
        <i class="mdi mdi-library menu-icon text-white"></i>
        <span class="menu-title text-white">Laporan</span>
      </a>
    </li>
    <?php }if($_SESSION['data-user']['role']==3){?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pembayaran'">
        <i class="mdi mdi-cash-multiple menu-icon text-white"></i>
        <span class="menu-title text-white">Pembayaran</span>
      </a>
    </li>
    <?php }?>
  </ul>
</nav>
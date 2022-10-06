<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php if($_SESSION['data-user']['role']==1){?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='distributor'">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Distributor</span>
      </a>
    </li>
    <?php }if($_SESSION['data-user']['role']>=2){?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='produk'">
        <i class="mdi mdi-cube menu-icon"></i>
        <span class="menu-title">Produk</span>
      </a>
    </li>
    <?php if($_SESSION['data-user']['role']==2){?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='penjualan'">
        <i class="mdi mdi-cart-outline menu-icon"></i>
        <span class="menu-title">Penjualan</span>
      </a>
    </li>
    <?php }?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pembayaran'">
        <i class="mdi mdi-cash-multiple menu-icon"></i>
        <span class="menu-title">Pembayaran</span>
      </a>
    </li>
    <?php }?>
  </ul>
</nav>
<?php require_once("controller/script.php");
$_SESSION['page-name'] = "";
$_SESSION['page-url'] = "./";
$_SESSION['actual-link'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
  <meta charset="utf-8">
  <title>SIPERTA</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="assets/css/animate.min.css" rel="stylesheet">
  <link href="assets/css/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="assets/css/style-front.css" rel="stylesheet">
</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
      <div class="col-lg-6 d-none d-lg-block">
        <div class="d-inline-flex align-items-center h-100">
          <!-- <a class="text-body mr-3" href="">About</a>
          <a class="text-body mr-3" href="">Contact</a>
          <a class="text-body mr-3" href="">Help</a>
          <a class="text-body mr-3" href="">FAQs</a> -->
        </div>
      </div>
      <div class="col-lg-6 text-right text-lg-right">
        <div class="d-inline-flex align-items-center">
          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
            <div class="dropdown-menu dropdown-menu-right">
              <button onclick="window.location.href='auth/'" class="dropdown-item" type="button">Sign in</button>
              <button onclick="window.location.href='auth/daftar'" class="dropdown-item" type="button">Sign up</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
      <div class="col-lg-12">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
          <a href="" class="text-decoration-none">
            <span class="h1 text-uppercase text-dark bg-light px-2">SI</span>
            <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">PERTA</span>
          </a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto py-0">
              <a href="./" class="nav-item nav-link active">Beranda</a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar End -->


  <!-- Carousel Start -->
  <div class="container-fluid mb-3">
    <div class="row px-xl-5">
      <div class="col-lg-12">
        <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#header-carousel" data-slide-to="1"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item position-relative active" style="height: 430px;">
              <img class="position-absolute w-100 h-100" src="assets/images/bg1.jpeg" style="object-fit: cover;">
              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                  <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#product">Lihat Produk</a>
                </div>
              </div>
            </div>
            <div class="carousel-item position-relative" style="height: 430px;">
              <img class="position-absolute w-100 h-100" src="assets/images/bg2.jpeg" style="object-fit: cover;">
              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                  <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#product">Lihat Produk</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->


  <!-- Featured Start -->
  <div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
          <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
          <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
          <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
          <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
          <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
          <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
          <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
          <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
        </div>
      </div>
    </div>
  </div>
  <!-- Featured End -->


  <!-- Products Start -->
  <div class="container-fluid pt-5 pb-3" id="product">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">PRODUK PILIHAN</span></h2>
    <div class="row px-xl-5">
      <?php if (mysqli_num_rows($card_produk) > 0) {
        while ($row = mysqli_fetch_assoc($card_produk)) { ?>
          <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4 shadow">
              <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100" src="assets/images/produk/<?= $row['img_produk'] ?>" alt="">
                <div class="product-action">
                  <form action="" method="post">
                    <input type="hidden" name="id-buy" value="<?= $row['kode_produk']?>">
                    <button type="submit" name="buy-product" class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></button>
                  </form>
                </div>
              </div>
              <div class="px-4">
                <p class="h6 text-decoration-none text-truncate pt-4"><?= $row['nama_produk'] ?></p>
                <h5 class="text-primary mt-n2">Rp. <?= number_format($row['harga']) ?></h5>
                <p>Stok <?= $row['stok'] . " " . $row['satuan'] ?></p>
                <p class="pb-2"><?= $row['nama_distributor'] . " - " . $row['lokasi'] ?></p>
              </div>
            </div>
          </div>
      <?php }
      } ?>
    </div>
  </div>
  <!-- Products End -->


  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-secondary mt-5">
    <div class="row mx-xl-5 py-4">
      <div class="col-md-6 px-xl-0">
        <p class="mb-md-0 text-center text-md-left text-secondary">
          &copy; <a class="text-primary" href="https://netmedia-framecode.com" target="_blank">Netmedia Framecode</a>. All Rights Reserved. Designed
          by
          <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
        </p>
      </div>
      <div class="col-md-6 px-xl-0 text-center text-md-right">
        <img class="img-fluid" src="assets/images/payments.png" alt="">
      </div>
    </div>
  </div>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/easing.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

  <!-- Contact Javascript File -->
  <script src="assets/js/jqBootstrapValidation.min.js"></script>
  <script src="assets/js/contact.js"></script>

  <!-- Template Javascript -->
  <script src="assets/js/main.js"></script>
</body>

</html>
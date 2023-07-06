<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script defer src="js/bootstrap.bundle.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">BD POLICE</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ms-auto mb-2 mx-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Police Station</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Web</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Complain</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link active btn btn-primary" aria-current="page" href="pages/login/login.php">Login</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner img-fluid">
      <div class="carousel-item carousal-img active bg-img1">
        <!-- <img src="images/carousal1.jpg" class="d-block w-100 img-fluid" alt="..."> -->
      </div>
      <div class="carousel-item carousal-img bg-img2">
        <!-- <img src="images/carousal2.jpg" class="d-block w-100 img-fluid" alt="..."> -->
      </div>
      <div class="carousel-item carousal-img bg-img3">
        <!-- <img src="images/carousal3.jpg" class="d-block w-100 img-fluid" alt="..."> -->
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Site footer --
    <!----------- Footer ------------>
  <footer class="footer-bs">
    <div class="row">
      <div class="col-md-3 footer-brand animated fadeInLeft">
        <h2>Logo</h2>
        <p>Suspendisse hendrerit tellus laoreet luctus pharetra. Aliquam porttitor vitae orci nec ultricies. Curabitur vehicula, libero eget faucibus faucibus, purus erat eleifend enim, porta pellentesque ex mi ut sem.</p>
        <p>© 2014 BS3 UI Kit, All rights reserved</p>
      </div>
      <div class="col-md-4 footer-nav animated fadeInUp">
        <h4>Menu —</h4>
        <div class="col-md-6">
          <ul class="pages">
            <li><a href="#">Travel</a></li>
            <li><a href="#">Nature</a></li>
            <li><a href="#">Explores</a></li>
            <li><a href="#">Science</a></li>
            <li><a href="#">Advice</a></li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="list">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contacts</a></li>
            <li><a href="#">Terms & Condition</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-2 footer-social animated fadeInDown">
        <h4>Follow Us</h4>
        <ul>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">RSS</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-ns animated fadeInRight">
        <h4>Newsletter</h4>
        <p>A rover wearing a fuzzy suit doesn’t alarm the real penguins</p>
        <p>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
          </span>
        </div><!-- /input-group -->
        </p>
      </div>
    </div>
  </footer>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
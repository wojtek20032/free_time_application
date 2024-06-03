<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login-register/index.php');
  exit();
}
if (isset($_POST['sign_out'])) {
  unset($_POST['sign_out']);
  session_unset();
  session_destroy();
  header('Location: ../login-register/index.php');
  exit();
}
require ("../db.php");
$id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="menu.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    function openGoogleMaps() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var latitude = position.coords.latitude;
          var longitude = position.coords.longitude;

          var mapsUrl =
            "https://www.google.com/maps?q=" + latitude + "," + longitude;

          window.open(mapsUrl);
        });
      } else {
        alert("Error in finding your location! Check your browser!");
      }
    }
  </script>
  <script>
    var dropdownMenu = document.querySelector(".dropdown-menu");
    if (dropdownMenu) {
      dropdownMenu.setAttribute("data-bs-popper", "dynamic");
    }
  </script>
  <script>
    function logout() {
      event.preventDefault();
      document.getElementById("logout-form").submit();
      window.location.href = "../login-register/index.php";
    }
  </script>
  <title>Menu Główne</title>
</head>

<body>
  <div class="container">
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid" style="display: block">
        <div class="header">
          <div class="dropdown">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false"
              style="padding: 0%">
              <img src="../icons/menu.png" />
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../calendar/terminarz.php">Terminarz</a></li>
              <li><a class="dropdown-item" href="https://onedrive.live.com/login/">OneDrive</a></li>
              <li><a class="dropdown-item" href="https://github.com">GitHub</a></li>

              <li><a class="dropdown-item" href="../menu/menu.php">Menu</a></li>
            </ul>
          </div>
          <a class="navbar-brand" href="../menu/menu.php">
            <h1>Kampa</h1>
          </a>
          <div class="dropdown">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false"
              style="padding: 0%">
              <img src="../icons/user.png" />
            </button>
            <ul class="dropdown-menu dropdown-menu-right" id="profile">
              <li><a class="dropdown-item" href="../profil/profil.php">Profil</a></li>
              <li><a class="dropdown-item" href="../powiadomienia/powiadomienia.php">Powiadomienia</a></li>
              <li>
                <form id="logout-form" method="POST">
                  <button class="dropdown-item" name="sign_out" type="submit" onclick="logout()">Wyloguj</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="greeting">
      <?php
      if (isset($_SESSION['username'])) {

        ?>
        <h1><?php printf("Witaj %s\n", $_SESSION['username']);
        unset($_SESSION['username']);
      }
      ?></h1>
    </div>
    <div class="desc">
      <h1>Znajdz sobie cos do zrobienia w czasie wolnym !</h1>
    </div>
    <div class="search-bar">
      <nav class="navbar">
        <div class="container-fluid">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">
              Szukaj
            </button>
          </form>
        </div>
      </nav>
    </div>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-12 col-xxl-4 mb-3" id="card-inner">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              </h5>
              <div class="more">
                <a class="ModalBtn btn btn-primary" href="../powiadomienia/powiadomienia.php">Zobacz wiecej</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xxl-4 mb-3" id="card-inner">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              </h5>
              <div class="more">
                <a class="ModalBtn btn btn-primary" href="../powiadomienia/powiadomienia.php">Zobacz wiecej</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xxl-4 mb-3" id="card-inner">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              </h5>
              <div class="more">
                <a class="ModalBtn btn btn-primary" href="../powiadomienia/powiadomienia.php">Zobacz wiecej</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <div class="container-fluid">
    <button onclick="openGoogleMaps()">
      <a href="#"><img src="../icons/placeholder.png" /></a>
    </button>
    </div>
  </footer>
  </div>
  <script src="menu.js"></script>
</body>

</html>
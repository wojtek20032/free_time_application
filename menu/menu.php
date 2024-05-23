<?php include_once('../user.php');?>
<?php include_once('../db.php');?>
<?php
    session_start();
    $user = $_SESSION['User'];
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="menu.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
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
    <title>Menu Główne</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="display: block">
          <div class="header">
            <div class="dropdown">
              <button
                class="btn btn-secondary"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                style="padding: 0%"
              >
                <img src="icons/menu.png" />
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../calendar/terminarz.html">Terminarz</a></li>
                <li><a class="dropdown-item" href="https://onedrive.live.com/login/">OneDrive</a></li>
                <li><a class="dropdown-item" href="https://github.com">GitHub</a></li>
                <li><a class="dropdown-item" href="menu.html">Menu</a></li>
              </ul>
            </div>
            <a class="navbar-brand" href="menu.html"><h1>Kampa</h1></a>
            <div class="dropdown">
              <button
                class="btn btn-secondary"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                style="padding: 0%"
              >
                <img src="icons/user.png" />
              </button>
              <ul
                class="dropdown-menu dropdown-menu-right"
                id="profile"
              >
                <li><a class="dropdown-item" href="../profil/profil.html">Profil</a></li>
                <li><a class="dropdown-item" href="#">Powiadomienia</a></li>
                <li><a class="dropdown-item" href="#">Wyloguj</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="search-bar">
        <nav class="navbar bg-body-tertiary">
          <div class="container-fluid">
            <form class="d-flex" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success" type="submit">
                Szukaj
              </button>
            </form>
          </div>
        </nav>
      </div>
    </main>
    <footer>
      <button onclick="openGoogleMaps()">
        <a href="#"><img src="icons/placeholder.png" /></a>
      </button>
    </footer>
  </body>
</html>

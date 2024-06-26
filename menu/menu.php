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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Anek+Kannada:wght@100..800&display=swap" rel="stylesheet">
  <title>Menu Główne</title>
</head>

<body>
  <div class="container">
    <header>
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid" style="display: block">
          <div class="header">
            <div class="left">
              <div class="dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0%">
                  <img src="../icons/menu.png" />
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../event/terminarz.php">Terminarz</a></li>
                  <li><a class="dropdown-item" href="https://onedrive.live.com/login/">OneDrive</a></li>
                  <li><a class="dropdown-item" href="https://github.com">GitHub</a></li>
                  <li><a class="dropdown-item" href="../menu/menu.php">Menu</a></li>
                </ul>
              </div>
              <a href="../kalendarz/kalendarz.php"><img src="../icons/calendar.png" id="calendar"></a>
            </div>
            <a class="navbar-brand" href="../menu/menu.php">
              <h1>Kampa</h1>
            </a>
            <div class="right">
              <a href="../powiadomienia/powiadomienia.php"><img src="../icons/bell.png" id="bell"></a>
              <div class="dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0%">
                  <img src="../icons/user.png" />
                </button>
                <ul class="dropdown-menu dropdown-menu-right" id="profile">
                  <li><a class="dropdown-item" href="../profil/profil.php">Profil</a></li>
                  <li>
                    <form id="logout-form" method="POST">
                      <button class="dropdown-item" name="sign_out" type="submit" onclick="logout()">Wyloguj</button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="greeting col-12">
        <?php
        if (isset($_SESSION['username'])) {

          ?>
          <h1><?php printf("Witaj %s\n", $_SESSION['username']);
          unset($_SESSION['username']);
        }
        ?></h1>
      </div>
      <div class="desc col-12">
        <h1 class="typing-effect">Znajdz sobie cos do zrobienia w czasie wolnym !</h1>

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
          <div class="col-12 col-xxl-7 mb-3" id="card-inner">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
                  Nawigacja
                </h5>
                <div class="steps">
                  <button onclick="startMovingImageLeft('../icons/arrow.png',12,72)">
                    <h5>
                      Jeśli chcesz dodać nowy event, proszimy do Terminarzu
                    </h5>
                  </button>
                  <button onclick="startMovingImageLeft('../icons/arrow.png',94,72)">
                    <h5>
                      Kalendarz pokaże ciebie twoje plany na przyszłość
                    </h5>
                  </button>
                  <button onclick="startMovingImageRight('../icons/arrow.png',93,72)">
                    <h5>
                      Powiadomienia przypominają o najbliższych eventach
                    </h5>
                  </button>
                  <button onclick="startMovingImageRight('../icons/arrow.png',12,72)">
                    <h5>
                      W Profilu możesz zmienić hasło
                    </h5>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <div id="image-container"></div>
    <footer>
      <div class="container-fluid">
        <button onclick="openGoogleMaps()">
          <a href="#"><img src="../icons/placeholder.png" /></a>
        </button>
      </div>
    </footer>
  </div>
  <script src="menu.js"></script>
  <script>
    let typingEffect = document.getElementsByClassName("typing-effect")[0];
    typingEffect.addEventListener('animationend', (event) => {
      if (event.animationName === 'typing') {
        typingEffect.style.borderRightColor = 'transparent';
      }
    });
  </script>
  <script>
    if ("Notification" in window) {
      if (Notification.permission === "granted" && pageAccessedByReload == false && JSON.parse(window.localStorage.getItem("cached_notifications")).length > 0) {
        notify();
      } else {
        Notification.requestPermission().then(res => {
          if (res === "granted" && pageAccessedByReload == false && JSON.parse(window.localStorage.getItem("cached_notifications")).length > 0) {
            notify();
          }
        })
      }
    } else {
      console.error("Browser does not support notifications");
    }

    function notify() {
      let len = JSON.parse(window.localStorage.getItem("cached_notifications")).length;
      let str = (len == 1 ? " powiadomienie" : (len < 5 ? " powiadomienia" : " powiadomien"));
      const notification = new Notification('Powiadomienia', {
        body: 'Masz ' + len + str + ', sprawdz!',
        icon: 'https://unsplash.it/400/400',
        vibration: [300, 200, 300],
      });

      notification.addEventListener('click', function () {
        window.location.href = '../powiadomienia/powiadomienia.php';
      });

      setTimeout(() => notification.close(), 5 * 1000);

    }
  </script>
</body>

</html>
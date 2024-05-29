<?php
session_start();
?>
<?php require ("../db.php"); ?>

<!DOCTYPE html>
<html lang="pl">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="powiadomienia.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
    <title>Powiadomienia</title>
  </head>

  <body>
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
                <li><a class="dropdown-item" href="../calendar/terminarz.html">Terminarz</a></li>
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
                <li><a class="dropdown-item" href="../profil/profil.html">Profil</a></li>
                <li><a class="dropdown-item" href="../powiadomienia/powiadomienia.php">Powiadomienia</a></li>
                <li><a class="dropdown-item" href="#">Wyloguj</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="container-fluid" id="main-content">
        <div class="row">
          <div class="col-sm-4 mb-3 mb-sm-0" id="card-inner">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data</h5>
                <div class="more">
                  <a href="#" class="btn btn-primary">Zobacz wiecej</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4" id="card-inner">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data</h5>
                <div class="more">
                  <a href="#" class="btn btn-primary">Zobacz wiecej</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 mb-3 mb-sm-0" id="card-inner">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data</h5>
                <div class="more">
                  <a href="#" class="btn btn-primary">Zobacz wiecej</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 mb-3 mb-sm-0" id="card-inner">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data</h5>
                <div class="more">
                  <a href="#" class="btn btn-primary">Zobacz wiecej</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4" id="card-inner">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data</h5>
                <div class="more">
                  <a href="#" class="btn btn-primary">Zobacz wiecej</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 mb-3 mb-sm-0" id="card-inner">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data</h5>
                <div class="more">
                  <a href="#" class="btn btn-primary">Zobacz wiecej</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
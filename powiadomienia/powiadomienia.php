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
?>
<?php require ("../db.php");

$id = $_SESSION['user_id'];
?>

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
  <script>function logout() {
      event.preventDefault();
      document.getElementById("logout-form").submit();
      window.location.href = "../login-register/index.php";
    }</script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Anek+Kannada:wght@100..800&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid" style="display: block">
        <div class="header">
          <div class="dropdown">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
              style="padding: 0%">
              <img src="../icons/menu.png" />
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../event/terminarz.php">Terminarz</a></li>
              <li><a class="dropdown-item" href="https://onedrive.live.com/login/">OneDrive</a></li>
              <li><a class="dropdown-item" href="https://github.com">GitHub</a></li>
              <li><a class="dropdown-item" href="../menu/menu.php">Menu</a></li>
            </ul>
          </div>
          <a class="navbar-brand" href="../menu/menu.php">
            <h1>Kampa</h1>
          </a>
          <div class="dropdown">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
              style="padding: 0%">
              <img src="../icons/user.png" />
            </button>
            <ul class="dropdown-menu dropdown-menu-right" id="profile">
              <li><a class="dropdown-item" href="../profil/profil.php">Profil</a></li>
              <li>
                <form id="logout-form" method="POST" style="margin-bottom: 0">
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
    <div class="container-fluid" id="main-content">
      <div class="row">
      </div>
    </div>
  </main>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="change_text_on_click">Little Page Content</h2>
      <h3 id="note_to_change"></h3>
      <p>
      <h3 id="change_of_desc">This is the content of the little page.</h3>
      <h4 id="status"></h4>
      </p>
    </div>
  </div>
  <script src="powiadomienia.js"></script>
</body>

</html>
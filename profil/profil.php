<?php 
include_once('../user.php'); 
include_once('../db.php'); 

session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../login-register/index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE idUzytkownika = '$user_id'");
$user_data = mysqli_fetch_array($query);

$username = $user_data['Username'];
$email = $user_data['E_mail'];

$status = "";

if (isset($_POST['change_password'])) {
    $current_password = sha1($_POST['current_password']);
    $new_password = sha1($_POST['new_password']);
    $confirm_password = sha1($_POST['confirm_password']);

    if ($new_password != $confirm_password) {
        $status = "New passwords do not match.";
    } else {
        $user = new User($username, $email, $current_password);
        $result = $user->login($email, $current_password, $conn);
        if ($result === true) {
            $update_query = "UPDATE users SET hashed_password='$new_password' WHERE idUzytkownika='$user_id'";
            if (mysqli_query($conn, $update_query)) {
                $status = "Password changed successfully!";
            } else {
                $status = "Error updating password.";
            }
        } else {
            $status = "Current password is incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="profil.css">
    <script defer src="profil.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <img src="../icons/user.png" alt="User Icon">
            <h1 class="profile-title">Mój Profil</h1>
        </header>
        <div class="profile-info">
            <div class="info">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
            </div>
            <div class="info">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <button class="styled-button" onclick="window.location.href='../menu/menu.php'">Powrót do menu</button>
            <button class="styled-button" id="toggle-button">Change Password</button>
            <div class="change-password" id="change-password-section" style="display: none;">
                <h2>Change Password</h2>
                <form action="" method="post">
                    <div class="info">
                        <label for="current_password">Current Password:</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>
                    <div class="info">
                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>
                    <div class="info">
                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" name="change_password" class="styled-button">Submit</button>
                </form>
            </div>
            <div id="status-message" style="display: none;"><?php echo $status; ?></div>
        </div>
    </div>

    <div id="status-modal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <p id="modal-message"></p>
        </div>
    </div>
</body>
</html>

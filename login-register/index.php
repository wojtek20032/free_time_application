<?php include_once('../user.php'); ?>
<?php include_once('../db.php'); ?>
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website With Login & Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <?php
                if(isset($_SESSION['status'])){
                    echo $_SESSION['status'];
                    unset($_SESSION['status']);
                }
            ?>
            <form method="POST" id="login_form">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" required name="log">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" required name="passwd">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" name="Login_button" class="btn">Login</button>
                <?php 
                    if(isset($_POST['Login_button'])){
                        $pass = sha1($_POST['passwd']);
                        $user_to_verify = new User("empty", $_POST['log'], $pass);
                        $mail = $user_to_verify->getEmail();
                        $result = $user_to_verify->login($mail, $pass, $conn);
                        if($result === true){
                            $_SESSION['user_id'] = $user_to_verify->getId(); 
                            $_SESSION['username'] = $user_to_verify->getName();
                            header('location: ../menu/menu.php');
                            exit();
                        } else {
                            $_SESSION['status'] = "Credentials do not match, verify them or register first";
                            header('location: index.php');
                            exit();
                        }
                    }
                ?>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
        <div class="form-box register">
            <h2>Registration</h2>
            <form method="POST" id="register_form">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" required name="username_register">
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" required name="email_register">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" required name="password_register">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" required> I agree to the ToS</label>
                </div>
                <button type="submit" class="btn" name="Register_button">Register</button>
                <?php 
                    if(isset($_POST['Register_button'])){
                        $pass = sha1($_POST['password_register']);
                        $user = new User($_POST['username_register'], $_POST['email_register'], $pass);
                        $name = $user->getName();
                        $mail = $user->getEmail();
                        $query = "INSERT INTO users (Username, E_mail, hashed_password) VALUES ('$name', '$mail', '$pass')";
                        $query_to_run = mysqli_query($conn, $query);
                        if($query_to_run){
                            $_SESSION['status'] = "User registered successfully";
                            header('location: index.php');
                            exit();
                        }
                        $conn->close();
                        unset($_POST['Register_button']);
                    }
                ?>
                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

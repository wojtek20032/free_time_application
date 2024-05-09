
<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website With Login & Registration | Codeha </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
    <div class="wrapper">
        <div class="form-box login"> <h2>Login</h2>
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
            <input type="password" required name = "passwd"> <label>Password</label>
            </div>
            <div class="remember-forgot">
            <label><input type="checkbox"> Remember me</label>
            <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="login-register">
            <p>Don't have an account? <a href="#"
            class="register-link">Register</a></
            p>
            </div>
            </form>
            </div>
            <div class="form-box register"> <h2>Registration</h2>
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
                <input type="email" required name = "email_register">
                <label>Email</label>
                </div>
                <div class="input-box">
                <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" required name="password_register"> <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                    <label><input type="checkbox" > I agree to the ToS</label>
                    </div>
                    <button type="submit" class="btn">Register</button>
                    <?php 
                    if(isset($_POST['username_register']) && isset($_POST['email_register']) && isset($_POST['password_register'])){
                        $conn = new mysqli('localhost', 'root','','logins_db');
                        $user = $_POST['username_register'];
                        $mail = $_POST['email_register'];
                        $hash = sha1($_POST['password_register']);
                        $querry = "INSERT INTO users (Username, E_mail, hashed_password) VALUES ('$user','$mail','$hash')";
                        $conn->query($querry);
                        $conn->close();
                        ?>
                        <h2>User registered</h2>
                        <?php 
                        $_POST = array();
                    }
                    ?>
                    <div class="login-register">
                    <p>Already have an account? <a href="#"
                    class="login-link">Login</a></
                    p>
                    </div>
                    </form>
                    </div>

            </div>
            
<script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
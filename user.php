<?php
class User {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $hash) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $hash;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function login($email, $password, $connection) {
        $query = mysqli_query($connection, "SELECT * FROM users WHERE E_mail = '$email' AND hashed_password = '$password'");
        if ($result = mysqli_fetch_array($query)) {
            $this->setId($result['idUzytkownika']);
            $this->setName($result['Username']);
            $this->setEmail($result['E_mail']);
            $this->setPassword($result['hashed_password']);
            return true;
        }
        return false;
    }

    public function changePassword($currentPassword, $newPassword) {
        if (password_verify($currentPassword, $this->password)) {
            $this->setPassword($newPassword);
            return "Password changed successfully!";
        } else {
            return "Current password is incorrect.";
        }
    }

    public function changeEmail($newEmail) {
        $this->email = $newEmail;
        return "Email changed successfully!";
    }
}





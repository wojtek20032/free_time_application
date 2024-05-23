<?php

class User {
    private $name;
    private $email;
    private $password;

    
    public function __construct($name,$email,$hash) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $hash;
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

    public function getPassword(){
        return $this->$password;
    }
  
    public function setEmail($email) {
        $this->email = $email;
    }
    public static function login($email, $password,$connection) {
        $querry = mysqli_query($connection,"SELECT * from users");
        while($result = mysqli_fetch_array($querry)){
            if ($result['E_mail'] === $email && $result['hashed_password'] == $password) {
                return $result;
            }
        }
            return null;//połączenie z baza 
        
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



<?php

class User {
    private $name;
    private $lastName;
    private $email;
    private $hashedPassword;

    
    public function __construct($name, $lastName, $email, $password) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->setPassword($password); 
    }

   
    public function getName() {
        return $this->name;
    }

    
    public function setName($name) {
        $this->name = $name;
    }

   
    public function getLastName() {
        return $this->lastName;
    }

 
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    
    public function getEmail() {
        return $this->email;
    }

  
    public function setEmail($email) {
        $this->email = $email;
    }


    public function setPassword($password) {
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

  
    public function login($email, $password) {
        if ($this->email === $email && password_verify($password, $this->hashedPassword)) {
            return "Login successful!";
        } else {
            return "Invalid email or password.";
        }
    }


    public function changePassword($currentPassword, $newPassword) {
        if (password_verify($currentPassword, $this->hashedPassword)) {
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



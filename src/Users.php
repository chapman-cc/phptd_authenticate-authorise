<?php

class USER 
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)){
            return $this->$name;
        } else {
            return false;
        }
    }

    public function register() 
    {
        global $db;
        
        $hashed = password_hash($this->password, PASSWORD_BCRYPT);

        try {
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $hashed);
            $stmt->execute();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkForDuplicatedUsername() 
    {
        global $db;
        
        try {    
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            $result = $stmt->fetch();
        } catch (Exception $e) {
            throw $e;
        }
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
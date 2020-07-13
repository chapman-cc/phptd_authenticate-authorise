<?php

use Ramsey\Uuid\Uuid;

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
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            return false;
        }
    }

    public function register()
    {
        global $db;

        $hashed = password_hash($this->password, PASSWORD_BCRYPT);
        $uuid = uniqid($this->username);

        try {
            $query = "INSERT INTO users (username, password, uuid) VALUES (:username, :password, :uuid)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $hashed);
            $stmt->bindParam(':uuid', $uuid);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }

        if ($result) {
            return $this->getUser();
        } else {
            return false;
        }
    }

    public function verify()
    {
        $result = $this->getUser();
        if (password_verify($this->password, $result['password'])) {
            return $result;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        global $db;

        try {
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function checkForDuplicatedUsername()
    {
        $result = $this->getUser();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

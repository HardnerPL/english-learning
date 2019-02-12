<?php

class User {
    private $id;
    private $username;
    private $password;
    private $role;
    
    function __construct($id, $username, $password, $role) {
        global $mysql;
        $this->id = $id;
        $this->username = $mysql->escape($username);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->role = $role;
    }
    
    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }
    
    function getRole() {
        return $this->role;
    }

    function verifyPassword($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return password_verify($this->password, $hash);
    }
    
    static function add($user) {
        global $mysql;
        $query = "INSERT INTO users (username, password, role) VALUES ('{$user->getUsername()}', '{$user->getPassword()}', '{$user->getRole()}')";
        $mysql->query($query);
    }
    
    static function isUsernameFree($username) {
        global $mysql;
        $query = "SELECT id FROM users WHERE username = '$username'";
        $mysql->query($query);
        return $mysql->resultCount() > 0 ? true : false;
    }

}


<?php

class User {

    private $id;
    private $username;
    private $password;

    /**
     * Creates an object of User class
     * @global type $mysql
     * @param type $id
     * @param type $username
     * @param type $password
     */
    function __construct($id, $username, $password) {
        global $mysql;
        $this->id = $id;
        $this->username = $mysql->escape($username);
        $this->password = $password;
    }

    /**
     * Creates an object of User class from username
     * @global type $mysql
     * @param type $username
     * @return \User
     */
    function fromUsername($username) {
        global $mysql;
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $mysql->query($query);
        if ($mysql->resultCount() == 0) {
            return NULL;
        } else {
            $row = $mysql->getRow($result);
            $instance = new User($row['id'], $username, $row['password']);
            return $instance;
        }
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
        global $mysql;
        $query = "SELECT role FROM users WHERE username = '{$this->username}'";
        $result = $mysql->query($query);
        $row = $mysql->getRow($result);
        return $row['role'];
    }

    function getLessons() {
        global $mysql;
        $query = "SELECT lessons FROM users WHERE username = '{$this->username}'";
        $result = $mysql->query($query);
        $row = $mysql->getRow($result);
        return $row['lessons'];
    }

    function getSaved() {
        global $mysql;
        $query = "SELECT wordId FROM user_words WHERE userId = '{$this->id}'";
        $mysql->query($query);
        return $mysql->resultCount();
    }

    function getStars($count) {
        global $mysql;
        $query = "SELECT wordId FROM user_words WHERE userId = '{$this->id}' AND stars = $count";
        $mysql->query($query);
        return $mysql->resultCount();
    }

    function getPoints() {
//        $points = $this->getStars(1);
//        $points += $this->getStars(2) * 20;
//        $points += $this->getStars(3) * 40;
//        $points += $this->getStars(4) * 60;
//        $points += $this->getStars(5) * 100;
        global $mysql;
        $query = "SELECT points FROM users WHERE username = '{$this->username}'";
        $result = $mysql->query($query);
        $row = $mysql->getRow($result);
        return $row['points'];
    }

    function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    static function add($user) {
        global $mysql;
        $query = "INSERT INTO users (username, password) VALUES ('{$user->getUsername()}', '{$user->getPassword()}')";
        $mysql->query($query);
    }

    static function isUsernameFree($username) {
        global $mysql;
        $query = "SELECT id FROM users WHERE username = '$username'";
        $mysql->query($query);
        return $mysql->resultCount() > 0 ? true : false;
    }

    static function getLeaderboard() {
        global $mysql;
        $query = "SELECT * FROM users ORDER BY points DESC";
        return $mysql->query($query);
    }
}
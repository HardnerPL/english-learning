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
        $this->id = $id;
        $this->username = Database::escape($username);
        $this->password = $password;
    }

    /**
     * Creates an object of User class from username
     * @global type $mysql
     * @param type $username
     * @return \User
     */
    function fromUsername($username) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = Database::query($query);
        if (Database::resultCount() == 0) {
            return NULL;
        } else {
            $row = Database::getRow($result);
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
        $query = "SELECT role FROM users WHERE username = '{$this->username}'";
        $result = Database::query($query);
        $row = Database::getRow($result);
        return $row['role'];
    }

    function getLessons() {
        $query = "SELECT lessons FROM users WHERE username = '{$this->username}'";
        $result = Database::query($query);
        $row = Database::getRow($result);
        return $row['lessons'];
    }

    function getSaved() {
        $query = "SELECT wordId FROM user_words WHERE userId = '{$this->id}'";
        Database::query($query);
        return Database::resultCount();
    }

    function getStars($count) {
        $query = "SELECT wordId FROM user_words WHERE userId = '{$this->id}' AND stars = $count";
        Database::query($query);
        return Database::resultCount();
    }

    function getWordStars($id) {
        $query = "SELECT stars FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
        $result = Database::query($query);
        return Database::getRow($result)['stars'];
    }

    function getWordLessonDate($id) {
        $query = "SELECT lessonDate FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
        $result = Database::query($query);
        if ($date = Database::getRow($result)['lessonDate']) {
            return $date;
        }
        return "Never";
    }
    
    function getWordStreak($id) {
        $query = "SELECT streak FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
        $result = Database::query($query);
        return Database::getRow($result)['streak'];
    }
    
// TO DO
//    function getWordExpireDate($id) {
//        $query = "SELECT expireLeve FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
//        $result = Database::query($query);
//        $level = Database::getRow($result)['expireLevel'];
//        $date = $this->getWordLessonDate($id);
//        switch ($level) {
//            case 1:
//                break;
//            case 2:
//                break;
//            case 3:
//                break;
//            case 4:
//                break;
//            case 5:
//                break;
//            case 6:
//        }
//    }

    function getPoints() {
        $points = $this->getStars(1);
        $points += $this->getStars(2) * 20;
        $points += $this->getStars(3) * 40;
        $points += $this->getStars(4) * 60;
        $points += $this->getStars(5) * 100;
//        $query = "SELECT points FROM users WHERE username = '{$this->username}'";
//        $result = Database::query($query);
//        $row = Database::getRow($result);
        return $points;
    }

    function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    static function add($user) {
        $query = "INSERT INTO users (username, password) VALUES ('{$user->getUsername()}', '{$user->getPassword()}')";
        Database::query($query);
    }

    static function isUsernameFree($username) {
        $query = "SELECT id FROM users WHERE username = '$username'";
        Database::query($query);
        return Database::resultCount() > 0 ? true : false;
    }

    static function getLeaderboard() {
        $query = "SELECT * FROM users ORDER BY points DESC";
        $leaderboardResult = Database::query($query);
        $resultCount = Database::resultCount();
        for ($i = 0; $i < $resultCount; $i++) {
            $row = Database::getRow($leaderboardResult);
            $users[$i] = User::fromUsername($row['username']);
        }
        usort($users, function($firstUser, $secondUser) {
            return $firstUser->getPoints() < $secondUser->getPoints();
        });
        return $users;
    }

    function saveWord($id) {
        $query = "INSERT INTO user_words (wordId, userId) VALUES ('$id', '{$this->getId()}')";
        Database::query($query);
    }

}

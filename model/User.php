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
        $this->username = DatabaseManager::escape($username);
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
        $result = DatabaseManager::query($query);
        if (DatabaseManager::resultCount() == 0) {
            return NULL;
        } else {
            $row = DatabaseManager::getRow($result);
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
        $result = DatabaseManager::query($query);
        $row = DatabaseManager::getRow($result);
        return $row['role'];
    }

    function getLessons() {
        $query = "SELECT lessons FROM users WHERE username = '{$this->username}'";
        $result = DatabaseManager::query($query);
        $row = DatabaseManager::getRow($result);
        return $row['lessons'];
    }

    function getSavedCount() {
        $query = "SELECT wordId FROM user_words WHERE userId = '{$this->id}'";
        DatabaseManager::query($query);
        return DatabaseManager::resultCount();
    }

    function getStars($count) {
        $query = "SELECT wordId FROM user_words WHERE userId = '{$this->id}' AND stars = $count";
        DatabaseManager::query($query);
        return DatabaseManager::resultCount();
    }

    function getWordStars($id) {
        $query = "SELECT stars FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
        $result = DatabaseManager::query($query);
        return DatabaseManager::getRow($result)['stars'];
    }

    public function getWordSaved($id) {
        $query = "SELECT * FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
        DatabaseManager::query($query);
        return DatabaseManager::resultCount() > 0 ? true : false;
    }

    function getWordLessonDate($id) {
        $query = "SELECT lessonDate FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
        $result = DatabaseManager::query($query);
        if ($date = DatabaseManager::getRow($result)['lessonDate']) {
            return $date;
        }
        return "Never";
    }
    
    function getWordStreak($id) {
        $query = "SELECT streak FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
        $result = DatabaseManager::query($query);
        return DatabaseManager::getRow($result)['streak'];
    }
    
// TO DO
//    function getWordExpireDate($id) {
//        $query = "SELECT expireLeve FROM user_words WHERE userId = '{$this->id}' AND wordId = '$id'";
//        $result = DatabaseManager::query($query);
//        $level = DatabaseManager::getRow($result)['expireLevel'];
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
//        $result = DatabaseManager::query($query);
//        $row = DatabaseManager::getRow($result);
        return $points;
    }

    function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    static function add($user) {
        $query = "INSERT INTO users (username, password) VALUES ('{$user->getUsername()}', '{$user->getPassword()}')";
        DatabaseManager::query($query);
    }

    static function isUsernameFree($username) {
        $query = "SELECT id FROM users WHERE username = '$username'";
        DatabaseManager::query($query);
        return DatabaseManager::resultCount() > 0 ? true : false;
    }

    static function getLeaderboard() {
        $query = "SELECT * FROM users ORDER BY points DESC";
        $leaderboardResult = DatabaseManager::query($query);
        $resultCount = DatabaseManager::resultCount();
        for ($i = 0; $i < $resultCount; $i++) {
            $row = DatabaseManager::getRow($leaderboardResult);
            $users[$i] = User::fromUsername($row['username']);
        }
        usort($users, function($firstUser, $secondUser) {
            return $firstUser->getPoints() < $secondUser->getPoints();
        });
        return $users;
    }

    function saveWord($id) {
        $query = "INSERT INTO user_words (wordId, userId) VALUES ('$id', '{$this->getId()}')";
        DatabaseManager::query($query);
    }

    public static function getUser() {
        return sessionGet('user');
    }

    public static function login() {
        $loginResult = "";
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = User::fromUsername($username);
            if (empty($user)) {
                $loginResult = "NO_USER";
            } else if (!$user->verifyPassword($password)) {
                $loginResult = "WRONG_PASSWORD";
            } else {
                $_SESSION['user'] = $user;
                $loginResult = "SUCCESS";
                header("Location: index.php");
            }
        }
    }

    public static function logout() {
        sessionUnset('user');
    }

}

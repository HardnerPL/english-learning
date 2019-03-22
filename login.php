<!DOCTYPE html>

<?php
require_once 'includes/Loader/Loader.php';

(new Loader('user'))->load();

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

$display = new Display();
$display->setTemplates('loginForm');
$display->display();
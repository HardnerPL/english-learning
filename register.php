<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once 'includes/Loader/Loader.php';

(new Loader('user'))->load();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    if (strlen($password) < 8) {
        $registerResult = "PASSWORD_TOO_SHORT";
    } else if (strlen($username) > 32) {
        $registerResult = "USERNAME_TOO_LONG";
    } else if (User::isUsernameFree($username)) {
        $registerResult = "USERNAME_IN_USE";
    }
    // TO DO: INCLUDES_ILLEGAL_CHARACTERS
    else if ($password != $repeatPassword) {
        $registerResult = "DIFFERENT_PASSWORDS";
    } else {
        $user = new User(0, $username, password_hash($password, PASSWORD_DEFAULT));
        User::add($user);
        $registerResult = "SUCCESS";
    }
}

$display = new Display();
$display->setTemplates('registerForm');
$display->display();

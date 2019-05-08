
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT'] . '/english-learning/');
require_once ROOT . "controller/Home.php";

(new Home())->pageNotFinished();

/*
require_once 'includes/Loader/Loader.php';
(new Loader())->load();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$display = new Display();
$display->setTemplates('learnSettings');
$display->setScripts('learnScripts');
$display->display();
 */
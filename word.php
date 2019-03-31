<!DOCTYPE html>

<?php
require_once 'includes/Loader/Loader.php';

(new Loader('user, word'))->load();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if (isset($_GET['id']) && $id = $_GET['id']) {
    $word = Word::fromId($id);
} else {
    Loader::url("index.php");
}

$display = new Display();
$display->setTemplates('word, sidebar');
$display->setScripts('wordScripts');
$display->display();
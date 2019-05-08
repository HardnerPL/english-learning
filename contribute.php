<!DOCTYPE html>

<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . '/english-learning/');
require_once ROOT . "controller/Home.php";

(new Home())->pageNotFinished();

die();
require_once 'includes/Loader/Loader.php';

(new Loader('user, word'))->load();


if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    Loader::url("index.php");
}

if (isset($_POST['contribute'])) {
    $name = DatabaseManager::escape(strtolower($_POST['name']));
    $explanation = DatabaseManager::escape($_POST['explanation']);
    $type = DatabaseManager::escape(strtolower($_POST['type']));
    $use = DatabaseManager::escape(strtolower($_POST['use']));
    $difficulty = DatabaseManager::escape(strtolower($_POST['difficulty']));
    $synonyms = DatabaseManager::escape(strtolower($_POST['synonyms']));
    $related = DatabaseManager::escape(strtolower($_POST['related']));
    if($user->getRole() == 'admin' || $user->getRole() == 'approved') {
        $status = 'accepted';
    } else {
        $status = 'draft';
    }
    
    if (!Word::isWordCreated($name)) {
        $word = new Word(0, $name, $explanation, $type, $use, $difficulty, $status, $user->getId(), $synonyms, $related);
        Word::add($word);
    }
}

$display = new Display();
$display->setTemplates('contribute');
$display->display();

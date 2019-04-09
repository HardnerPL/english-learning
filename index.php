<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php

require 'controler/Controler.php';

echo $_SERVER['REQUEST_URI'];

$query = "SELECT * FROM words WHERE status = 'accepted'";
if (isset($_POST['search'])) {
    $search = Database::escape($_POST['search']);
    $query .= " AND name LIKE '%$search%'";
}
if (isset($_POST['saved']) && isset($user)) {
    $saved = $_POST['saved'];
    if ($saved == "true") {
        $query .= " AND id IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
    } else if ($saved == "false") {
        $query .= " AND id NOT IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
    }
}
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    if ($type != "all") {
        $query .= " AND type = '$type'";
    }
}
$words = array();
$wordsQueryResult = Database::query($query);
while ($row = Database::getRow($wordsQueryResult)) {
    array_push($words, Word::fromRow($row));
}

$data = array();
$data['words'] = $words;
$data['user'] = $user;

$controler = new Controler();
$controler->view('table', $data);
$controler->view('sidebar', $data);

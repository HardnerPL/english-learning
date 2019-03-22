<?php
require_once '../Loader/Loader.php';
(new Loader())->load();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    die("NO SESSION");
}
if (isset($_POST['save']) && isset($user)) {
    $saveId = $_POST['save'];
    $user->saveWord($saveId);
    $word = Word::fromId($saveId);
} else {
    die("LMAO");
}

(new Template("learnSave"))->load();
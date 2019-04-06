<?php

require_once '../Loader/Loader.php';
(new Loader())->load();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    die("NO SESSION");
}
if (isset($_POST['save']) && isset($user) && isset($_POST['mode'])) {
    $saveId = $_POST['save'];
    $mode = $_POST['mode'];
    $user->saveWord($saveId);
    $word = Word::fromId($saveId);
} else {
    die("LMAO");
}

if ($mode == 'table') {
    (new Template('tableRow'))->load();
} else if ($mode == 'word') {
    (new Template('wordSave'))->load();
}

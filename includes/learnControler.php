<?php

require_once 'loader.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    die("NO SESSION");
}

if (isset($_GET['function'])) {
    $inst = $_GET['function'];
    if ($inst == "start") {
        unset($_SESSION['learn']);
        $query = "SELECT * FROM words WHERE status = 'accepted'";
        $saved = $_GET['saved'];
        $count = $_GET['count'];
        if ($saved == "true") {
            $query .= " AND id IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
        } else if ($saved == "false") {
            $query .= " AND id NOT IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
        }
        $query .= " ORDER BY RAND() LIMIT $count";
        $result = $mysql->query($query);
        $words = array();
        $current = 0;
        while ($row = $mysql->getRow($result)) {
            $word = Word::fromRow($row);
            array_push($words, $word);
        }
        $_SESSION['learn'] = $words;
        $_SESSION['currentLearn'] = $current;
        ?>
        <div class="bg-dark text-light p-3 w-50 mx-auto">
            <div class="mx-auto w-50">
                <input class="form-control" id="answear" type="text" placeholder="Your answear"></input>
            </div>
            <hr class="dark-hr">
            <div class="font-weight-light">
                <?= $words[0]->getDefinition() ?>
            </div>
            <div class="text-center mt-1">
                <button onclick="learn('answear')" id="confirm" class="btn btn-primary">Answear</button>
            </div>
        </div>
        <?php
    } else if ($inst == "answear") {
        $answear = $_GET['answear'];
        $words = $_SESSION['learn'];
        $current = $_SESSION['currentLearn'];
        if ($answear == $words[$current]->getName()) {
            echo "GOOD JOB!";
        } else {
            echo "NO! The answear was " . $words[$current]->getName();
        }
    }
}
?>


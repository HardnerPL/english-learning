<?php
require_once '../Loader/Loader.php';
(new Loader())->load();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    die("NO SESSION");
}

if (isset($_GET['function'])) {
    $inst = $_GET['function'];
    if ($inst == "start") {
        unset($_SESSION['learn']);
        
        $saved = $_GET['saved'];
        $count = $_GET['count'];
        $words = array();
        $current = 0;
        
        $query = "SELECT * FROM words WHERE status = 'accepted'";
        if ($saved == "true") {
            $query .= " AND id IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
        } else if ($saved == "false") {
            $query .= " AND id NOT IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
        }
        $query .= " ORDER BY RAND() LIMIT $count";
        $result = Database::query($query);
        while ($row = Database::getRow($result)) {
            $word = Word::fromRow($row);
            array_push($words, $word);
        }
        
        $_SESSION['learnWords'] = $words;
        $_SESSION['learnCurrent'] = $current;
        $_SESSION['learnScore'] = array();
        
        (new Template('learnQuestion'))->load();
        
    } else if ($inst == "answear") {
        $answear = $_GET['answear'];
        $words = $_SESSION['learnWords'];
        $current = $_SESSION['learnCurrent'];
        $word = $words[$current];
        $synonyms = explode(",", $word->getSynonyms());
        foreach ($synonyms as $key => $value) {
            $synonyms[$key] = trim($value);
        }
        if ($answear == $word->getName() || $answear == ltrim($word->getName(), "to ")) {
            array_push($_SESSION['learnScore'], 1);
            (new Template('learnCorrect'))->load();
        } else {
            array_push($_SESSION['learnScore'], 0);
            (new Template('learnIncorrect'))->load();
        }
        (new Template('learnWord'))->load();
    } else if ($inst == "load") {
        $words = $_SESSION['learnWords'];
        $_SESSION['learnCurrent'] += 1;
        $current = $_SESSION['learnCurrent'];
        if ($current < sizeof($words)) {
            (new Template('learnQuestion'))->load();
        } else {
            $score = 0;
            foreach($_SESSION['learnScore'] as $point) {
                $score += $point;
            }
            (new Template('learnResult'))->load();
        }
    }
}

function asd() {
    $current = "asd";
    $words = array();
}
?>


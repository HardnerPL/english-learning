<?php
require_once '../Loader/Loader.php';
(new Loader())->load();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    die("NO SESSION");
}

if (isset($_POST['function'])) {
    $inst = $_POST['function'];
    if ($inst == "start") {
        unset($_SESSION['learn']);
        
        $saved = $_POST['saved'];
        $count = $_POST['count'];
        $words = array();
        $current = 0;
        
        $query = "SELECT * FROM words WHERE status = 'accepted'";
        if ($saved == "true") {
            $query .= " AND id IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
        } else if ($saved == "false") {
            $query .= " AND id NOT IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
        }
        $query .= " ORDER BY RAND() LIMIT $count";
        $result = DatabaseManager::query($query);
        while ($row = DatabaseManager::getRow($result)) {
            $word = Word::fromRow($row);
            array_push($words, $word);
        }
        
        $_SESSION['learnWords'] = $words;
        $_SESSION['learnCurrent'] = $current;
        $_SESSION['learnScore'] = array();
        
        (new Template('learnQuestion'))->load();
        
    } else if ($inst == "answer") {
        $answer = ltrim($_POST['answer'], "to ");
        $words = $_SESSION['learnWords'];
        $current = $_SESSION['learnCurrent'];
        $word = $words[$current];
        $synonyms = explode(",", $word->getSynonyms());
        foreach ($synonyms as $key => $value) {
            $synonyms[$key] = ltrim(trim($value), "to ");
        }
        
        if ($answer == ltrim($word->getName(), "to ")) {
            array_push($_SESSION['learnScore'], 1);
            $_SESSION['learnCurrent'] += 1;
            (new Template('learnCorrect'))->load();
            (new Template('learnWord'))->load();
        } else if (!empty($answer) && in_array($answer, $synonyms)) {
            //(new Template('learnSynonym'))->load();
            (new Template('learnQuestion'))->load();
        } else {
            array_push($_SESSION['learnScore'], 0);
            $_SESSION['learnCurrent'] += 1;
            (new Template('learnIncorrect'))->load();
            (new Template('learnWord'))->load();
        }
    } else if ($inst == "load") {
        $words = $_SESSION['learnWords'];
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


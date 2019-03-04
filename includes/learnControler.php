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
        $_SESSION['learnWords'] = $words;
        $_SESSION['learnCurrent'] = $current;
        $_SESSION['learnScore'] = 0;
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
        $words = $_SESSION['learnWords'];
        $current = $_SESSION['learnCurrent'];
        $name = $words[$current]->getName();
        $synonyms = explode(",", $words[$current]->getSynonyms());
        foreach ($synonyms as $key => $value) {
            $synonyms[$key] = trim($value);
        }
        if ($answear == $name || $answear == ltrim($name, "to ")) {
            $_SESSION['learnScore'] += 1;
            ?>
            <div class="bg-dark text-light p-3 w-50 mx-auto">
                <div class="text-center">
                    <h4>Correct answear!</h4>
                </div>
                <hr class="dark-hr">
                <div class="text-center mt-1">
                    <button onclick="learn('load')" id="confirm" class="btn btn-primary">Next</button>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="bg-dark text-light p-3 w-50 mx-auto">
                <div class="text-center">
                    <h4>Incorrect! The answear was "<?= $words[$current]->getName() ?>"</h4>
                </div>
                <hr class="dark-hr">
                <div class="text-center mt-1">
                    <button onclick="learn('load')" id="confirm" class="btn btn-primary">Next</button>
                </div>
            </div>
            <?php
        }
    } else if ($inst == "load") {
        $words = $_SESSION['learnWords'];
        $_SESSION['learnCurrent'] += 1;
        $current = $_SESSION['learnCurrent'];
        if ($current < sizeof($words)) {
            ?>
            <div class="bg-dark text-light p-3 w-50 mx-auto">
                <div class="mx-auto w-50">
                    <input class="form-control" id="answear" type="text" placeholder="Your answear"></input>
                </div>
                <hr class="dark-hr">
                <div class="font-weight-light">
                    <?= $words[$current]->getDefinition() ?>
                </div>
                <div class="text-center mt-1">
                    <button onclick="learn('answear')" id="confirm" class="btn btn-primary">Answear</button>
                </div>
            </div>
            <?php
        } else {
            $score = $_SESSION['learnScore'];
            ?>
            <div class="bg-dark text-light p-3 w-50 mx-auto">
                <div class="text-center">
                    <h4>You're done! Your score: <?= $score . "/" . $current ?></h4>
                </div>
            </div>
            <?php
        }
    }
}

function asd() {
    $current = "asd";
    $words = array();
}
?>


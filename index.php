<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once 'includes/loader.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if (isset($_GET['save']) && isset($user)) {
    $saveId = $_GET['save'];
    $user->saveWord($saveId);
    Loader::url("index.php");
}
?>

<html>
    <?php Loader::loadHeader() ?>
    <body>
        <?php Loader::loadNavbar() ?>
        <div class="container mt-4">
            <div class="row">
                <div class="col-9">
                    <div class="p-2 bg-dark text-light font-weight-bold text-center border-left border-right">
                        Dictionary
                    </div>
                    <table class="table bg-dark text-light table-bordered">
                        <?php
                        $query = "SELECT * FROM words WHERE status = 'accepted'";
                        if (isset($_GET['search'])) {
                            $search = $mysql->escape($_GET['search']);
                            $query .= " AND name LIKE '%$search%'";
                        }
                        if (isset($_GET['saved']) && isset($user)) {
                            $saved = $_GET['saved'];
                            if ($saved == "true") {
                                $query .= " AND id IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
                            } else if ($saved == "false") {
                                $query .= " AND id NOT IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
                            }
                        }
                        if (isset($_GET['type'])) {
                            $type = $_GET['type'];
                            if ($type != "all") {
                                $query .= " AND type = '$type'";
                            }
                        }
                        $selectWordsResult = $mysql->query($query);
                        while ($row = $mysql->getRow($selectWordsResult)) {
                            $word = Word::fromRow($row);
                            ?>
                            <tr>
                                <td class="col-8">
                                    <div class="font-weight-bold">
                                        <a class="text-light" href="word.php?id=<?= $word->getId() ?>"><?= $word->getName() ?></a>
                                    </div>
                                    <div class="font-weight-light">
                                        <?= nl2br($word->getExplanation()) ?>
                                    </div>
                                </td>
                                <td class="col-4">
                                    <b>Type:</b> <?= ucfirst($word->getType()) ?><br>
                                    <b>Use:</b> <?= ucfirst($word->getUse()) ?><br>
                                    <b>Difficulty:</b> <?= ucfirst($word->getDifficulty()) ?><br>
                                    <?php
                                    if (isset($user)) {
                                        $stars = $user->getWordStars($word->getId());
                                        if (isset($stars)) {
                                            switch ($stars) {
                                                case 5:
                                                    $textColor = "text-color-gold";
                                                    break;
                                                case 4:
                                                    $textColor = "text-color-silver";
                                                    break;
                                                case 3:
                                                    $textColor = "text-color-brown";
                                                    break;
                                                default:
                                                    $textColor = "";
                                            }
                                            ?>
                                            <div><b>Your level: </b><span class='<?= $textColor ?>'><?php
                                                    for ($i = 0; $i < 5; $i++) {
                                                        if ($stars > 0) {
                                                            echo "<i class='fas fa-star'></i>";
                                                            $stars--;
                                                        } else {
                                                            echo "<i class='far fa-star'></i>";
                                                        }
                                                    }
                                                    ?></span></div>
                                            <!--  !-->
                                        <?php } else { ?>
                                            <div class="text-center mt-2">
                                                <a class="btn btn-primary" href="?save=<?= $word->getId() ?>">Save</a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="col">
                    <div class="bg-dark p-3 mb-4">
                        <h4 class="text-center text-light">Word finder</h4>
                        <form class="mr-2" action="" method="get">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="Search" value="<?php
                                if (isset($search)) {
                                    echo $search;
                                }
                                ?>">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                            <div class="form-inline mt-2">
                                <div class="mr-2 w-40 mr-2">
                                    <select class="form-control-sm" name="saved">
                                        <option value="all">All</option>
                                        <option value="true" <?= isset($saved) && $saved == "true" ? "selected" : "" ?>>Saved</option>
                                        <option value="false" <?= isset($saved) && $saved == "false" ? "selected" : "" ?>>Not saved</option>
                                    </select>
                                </div>
                                <div class="w-40">
                                    <select class="form-control-sm" name="type">
                                        <option value="all">All types</option>
                                        <option value="noun" <?= isset($type) && $type == "noun" ? "selected" : "" ?>>Noun</option>
                                        <option value="verb" <?= isset($type) && $type == "verb" ? "selected" : "" ?>>Verb</option>
                                        <option value="phrase" <?= isset($type) && $type == "phrase" ? "selected" : "" ?>>Phrase</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php if (!isset($user)) { ?>
                        <div class="bg-dark p-3 mb-4">
                            <h4 class="text-center text-light">Log in</h4>
                            <form action="login.php" method="post">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="text-center">
                                    <button name="login" type="submit" class="btn btn-primary">Log in</button>
                                </div>
                                <div class="text-center text-light mt-1">
                                    Don't have an account? <a href='register.php'>Register here!</a>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                    <?php if (isset($user)) { ?>
                        <div class="bg-dark p-3 mb-4">
                            <h4 class="text-center text-light">Statistics</h4>
                            <div class="text-light">
                                <b>Points:</b> <?= $user->getPoints() ?><br>
                                <b>Lessons:</b> <?= $user->getLessons() ?><br>
                                <b>Saved:</b> <?= $user->getSaved() ?><br>
                                <i class="text-color-gold fas fa-star"></i> <?= $user->getStars(5) ?>
                                <i class="text-color-silver fas fa-star"></i> <?= $user->getStars(4) ?>
                                <i class="text-color-brown fas fa-star"></i> <?= $user->getStars(3) ?>
                                <div class="text-center mt-2">
                                    <a class="btn btn-primary mr-1" href="profile.php">Profile</a>
                                    <a class="btn btn-primary" href="learn.php">Learn</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="bg-dark p-3 mb-4">
                        <h4 class="text-center text-light">Leaderboard</h4>
                        <div class="text-light">
                            <?php
                            $users = User::getLeaderboard();
                            for ($i = 0; $i < sizeof($users); $i++) {
                                if (isset($user) && $user->getUsername() == $users[$i]->getUsername()) {
                                    echo "<b>" . ($i + 1) . ". " . $users[$i]->getUsername() . ": " . $users[$i]->getPoints() . "</b><br>";
                                } else {
                                    echo ($i + 1) . ". " . $users[$i]->getUsername() . ": " . $users[$i]->getPoints() . "<br>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php Loader::loadFooter() ?>
    </body>
    <?php Loader::loadScripts(); ?>
</html>

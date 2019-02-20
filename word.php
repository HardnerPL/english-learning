<!DOCTYPE html>

<?php
require_once 'includes/loader.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if (isset($_GET['save']) && isset($user)) {
    $id = $_GET['save'];
    $user->saveWord($id);
    Loader::url("word.php?id=$id");
}

if (isset($_GET['id']) && $id = $_GET['id']) {
    $word = Word::fromId($id);
} else {
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
                    <div class="bg-dark text-light p-3">
                        <h3 class="font-weight-bold text-center">
                            <?= $word->getName() ?>
                        </h3>
                        <hr class="dark-hr">
                        <div class="font-weight-light">
                            <?= nl2br($word->getExplanation()) ?>
                        </div>
                        <hr class="dark-hr">
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
                                <b>Last trained:</b> <?= $user->getWordLessonDate($word->getId()) ?><br>
                                <b>Streak:</b> <?= $user->getWordStreak($word->getId()) ?><br>
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
                                <div class="mt-2">
                                    <a class="btn btn-primary" href="?save=<?= $word->getId() ?>">Save</a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <hr class="dark-hr">
                        <b>Type:</b> <?= ucfirst($word->getType()) ?><br>
                        <b>Acceptable:</b> <?= ucfirst($word->getAcceptable()) ?><br>
                        <b>Difficulty:</b> <?= ucfirst($word->getDifficulty()) ?><br>
                        <hr class="dark-hr">
                        <b>Synonyms: </b>
                        <?php
                        $synonyms = explode(",", $word->getSynonyms());
                        $i = 0;
                        $size = sizeof($synonyms);
                        foreach ($synonyms as $name) {
                            $synonym = Word::fromName(trim($name));
                            if (isset($synonym)) {
                                echo "<a href=word.php?id={$synonym->getId()}>$name</a>";
                            } else {
                                echo "<a href=contribute.php?name=$name></a>";
                            }
                        }
                        if (empty($name)) {
                            echo "None";
                        }
                        ?>
                        <br>
                        <b>Related: </b>
                        <?php
                        $related = explode(",", $word->getRelated());
                        $i = 0;
                        $size = sizeof($related);
                        foreach ($related as $name) {
                            $rel = Word::fromName(trim($name));
                            if (isset($rel)) {
                                echo "<a href=word.php?id={$rel->getId()}>$name</a>";
                            } else {
                                echo "<a href=contribute.php?name=$name></a>";
                            }
                        }
                        if (empty($name)) {
                            echo "None";
                        }
                        ?>
                        <br>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-dark p-3 mb-4">
                        <h4 class="text-center text-light">Word finder</h4>
                        <form class="mr-2" action="index.php" method="get">
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
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" value="t" name="saved" <?php
                                if (isset($_GET['saved'])) {
                                    echo "checked";
                                }
                                ?>>
                                <label class="form-check-label text-light" for="saved">Saved</label>
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
    </div>
    <?php Loader::loadFooter() ?>
</body>
<?php Loader::loadScripts(); ?>
</html>

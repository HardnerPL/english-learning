<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
<div class="col">
    <div class="bg-dark p-3 mb-4">
        <h4 class="text-center text-light">Word finder</h4>
        <div class="mr-2">
            <div class="input-group">
                <input class="form-control" type="text" id="searchWord" placeholder="Search" value="<?php
                if (isset($search)) {
                    echo $search;
                }
                ?>">
                <span class="input-group-append">
                    <button onclick="search()" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </span>
            </div>
            <div class="form-inline mt-2">
                <div class="mr-2 w-40 mr-2">
                    <select class="form-control-sm" id="searchSaved">
                        <option value="all">All</option>
                        <option value="true" <?= isset($saved) && $saved == "true" ? "selected" : "" ?>>Saved</option>
                        <option value="false" <?= isset($saved) && $saved == "false" ? "selected" : "" ?>>Not saved</option>
                    </select>
                </div>
                <div class="w-40">
                    <select class="form-control-sm" id="searchType">
                        <option value="all">All types</option>
                        <option value="noun" <?= isset($type) && $type == "noun" ? "selected" : "" ?>>Noun</option>
                        <option value="verb" <?= isset($type) && $type == "verb" ? "selected" : "" ?>>Verb</option>
                        <option value="phrase" <?= isset($type) && $type == "phrase" ? "selected" : "" ?>>Phrase</option>
                    </select>
                </div>
            </div>
        </div>
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
<?php
global $word;
global $user;
?>
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
            <a onclick="save(<?= $word->getId() ?>, $(this))" class="btn btn-primary">Save</a>
        </div>
        <?php
    }
    ?>
    <hr class="dark-hr">
    <b>Type:</b> <?= ucfirst($word->getType()) ?><br>
    <b>Acceptable:</b> <?= ucfirst($word->getUse()) ?><br>
    <b>Difficulty:</b> <?= ucfirst($word->getDifficulty()) ?><br>
    <hr class="dark-hr">
    <b>Synonyms: </b>
    <?php
    $synonyms = explode(",", $word->getSynonyms());
    $i = 0;
    $size = sizeof($synonyms);
    foreach ($synonyms as $name) {
        $name = trim($name);
        $synonym = Word::fromName($name);
        if (isset($synonym)) {
            echo "<a href=word.php?id={$synonym->getId()}>$name</a>";
        } else {
            echo "<a href=contribute.php?name=$name>$name</a>";
        }
        echo " ";
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
        $name = trim($name);
        $rel = Word::fromName($name);
        echo $name;
    }
    if (empty($name)) {
        echo "None";
    }
    ?>
    <br>
</div>
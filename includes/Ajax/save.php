<?php

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    die("NO SESSION");
}
if (isset($_GET['save']) && isset($user)) {
    $saveId = $_GET['save'];
    $user->saveWord($saveId);
    $word = Word::fromId($saveId);
} else {
    die("SHIT");
}
?>
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
    <?php } ?>
</td>

<?php

if (isset($user)) {
    $stars = $user->getWordStars($word->getId());
    switch ($stars) {
        case 5:
            $starColor = "text-color-gold";
            break;
        case 4:
            $starColor = "text-color-silver";
            break;
        case 3:
            $starColor = "text-color-brown";
            break;
        default:
            $starColor = "";
    }
}
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
        if (isset($user) && $user->getWordSaved($word->getId())) {
        ?>
        <div>
            <b>Your level: </b>
            <span class='<?= $starColor ?>'>
                <?php
                for ($i = 0; $i < 5; $i++) {
                    if ($stars > 0) {
                        echo "<i class='fas fa-star'></i>";
                        $stars--;
                    } else {
                        echo "<i class='far fa-star'></i>";
                    }
                }
                ?></span>
        </div>
        <?php } ?>
    </td>
</tr>
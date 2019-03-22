<?php
global $word;
global $user;
?>

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

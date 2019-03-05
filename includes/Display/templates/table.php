<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>

<div id="table" class="col-9">
    <div class="p-2 bg-dark text-light font-weight-bold text-center border-left border-right">
        Dictionary
    </div>
    <table class="table bg-dark text-light table-bordered">
        <?php
        $query = "SELECT * FROM words WHERE status = 'accepted'";
        if (isset($_POST['search'])) {
            $search = Database::escape($_POST['search']);
            $query .= " AND name LIKE '%$search%'";
        }
        if (isset($_POST['saved']) && isset($user)) {
            $saved = $_POST['saved'];
            if ($saved == "true") {
                $query .= " AND id IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
            } else if ($saved == "false") {
                $query .= " AND id NOT IN (SELECT wordId FROM user_words WHERE userId = '{$user->getId()}')";
            }
        }
        if (isset($_POST['type'])) {
            $type = $_POST['type'];
            if ($type != "all") {
                $query .= " AND type = '$type'";
            }
        }
        $selectWordsResult = Database::query($query);
        while ($row = Database::getRow($selectWordsResult)) {
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
                                <a onclick="save(<?= $word->getId() ?>, $(this))" class="btn btn-primary">Save</a>
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

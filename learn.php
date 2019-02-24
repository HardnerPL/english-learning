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
} else {
    Loader::url("index.php");
}
?>

<html>
    <?php Loader::loadHeader() ?>
    <body>
        <?php Loader::loadNavbar() ?>
        <div class="container mt-4">
            <script>
                function Word(name, explanation, synonyms) {
                    this.name = name;
                    this.explanation = explanation;
                    this.synonyms = synonyms;
                }
                
                var words = new Array();
            </script>
            <?php
            if (isset($_GET['learn'])) {
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
                while ($row = $mysql->getRow($result)) {
                    $word = Word::fromRow($row);
                    ?>
                    <script>
                        var name = '<?= $word->getName() ?>';
                        var explanation = "<?= $mysql->escape($word->getExplanation()) ?>";
                        words.push(new Word(name, explanation, ""));
                    </script>
                    <?php
                }
            } else {
                ?>
                <form id="learn-form" class="mx-auto" action="" method="get">
                    <div>
                        <select class="form-control mb-2" name="saved">
                            <option value="all">Saved & Not saved</option>
                            <option value="true">Saved</option>
                            <option value="false">Not saved</option>
                        </select>
                    </div>
                    <div>
                        <select class="form-control mb-2" name="count">
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" name="learn">Learn</button>
                    </div>
                </form>
        <?php } ?>
        </div>
    <?php Loader::loadFooter() ?>
    </body>
<?php Loader::loadScripts(); ?>
</html>


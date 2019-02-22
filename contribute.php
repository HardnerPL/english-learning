<!DOCTYPE html>

<?php
require_once 'includes/loader.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    Loader::url("index.php");
}

if (isset($_POST['contribute'])) {
    $name = $_POST['name'];
    $explanation = issetor($_POST['explanation'], "explanation");
    $type = $_POST['type'];
    $use = $_POST['use'];
    $difficulty = $_POST['difficulty'];
    $synonyms = issetor($_POST['synonyms'], "synonyms");
    $related = issetor($_POST['related'], "related");
    
    if (!Word::isWordCreated($name)) {
        $word = new Word(0, $name, $explanation, $type, $use, $difficulty, "draft", $user->getId(), $synonyms, $related);
        Word::add($word);
    }
}
?>

<html>
    <?php Loader::loadHeader() ?>
    <body>
        <?php Loader::loadNavbar() ?>
        <div class="container mt-4">
            <!-- TO DO: Display information based on register result -->
            <div class="mx-auto w-50">
                <form action="" method="post">
                    <p class="text-muted">Only word name is required. You can leave the rest empty or default, but try to fill as much as you can!</p>
                    <hr>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" placeholder="eg. rougly" name="name" required value="<?= isset($_GET['name']) ? $_GET['name'] : "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="explanation">Explanation</label>
                        <textarea class="form-control" type="text" name="explanation"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type">
                            <option>Noun</option>
                            <option>Verb</option>
                            <option>Adjective</option>
                            <option>Adverb</option>
                            <option>Phrase</option>
                            <option>Saying</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="use">Use</label>
                        <select class="form-control" name="use">
                            <option>Everyday</option>
                            <option>Informal</option>
                            <option>Formal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="difficulty">Difficulty</label>
                        <select class="form-control" name="difficulty">
                            <option>Beginner</option>
                            <option>Intermidiate</option>
                            <option>Advanced</option>
                            <option>Professional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="synonyms">Synonyms</label>
                        <input class="form-control" type="text" placeholder="eg. violently, forcibly, abruptly, harshly" name="synonyms">
                    </div>
                    <div class="form-group">
                        <label for="related">Related</label>
                        <input class="form-control" type="text" placeholder="eg. rough, fireplace" name="related">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" name="contribute">Add word</button>
                    </div>
                </form>
                <div class="text-center mt-2">
                </div>
            </div>
        </div>
    </div>
    <?php Loader::loadFooter() ?>
</body>
<?php Loader::loadScripts(); ?>
</html>

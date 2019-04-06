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
<?php
global $words;
global $current;
?>
<div class="bg-dark text-light p-3 w-50 mx-auto">
    <div class="mx-auto w-50">
        <input class="form-control" id="answer" type="text" placeholder="Your answer"></input>
    </div>
    <hr class="dark-hr">
    <div class="font-weight-light">
        <?= $words[$current]->getDefinition() ?>
    </div>
    <div class="text-center mt-1">
        <button onclick="learn('answer')" id="confirm" class="btn btn-primary">Answer</button>
    </div>
</div>


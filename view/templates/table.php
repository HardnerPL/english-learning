<?php
$user = $data['user'];
$words = $data['words'];
?>

<div class="row">
    <div id="table" class="col-9">
        <div class="p-2 bg-dark text-light font-weight-bold text-center border-left border-right">
            Dictionary
        </div>
        <table class="table bg-dark text-light table-bordered">
            <?php
            foreach ($words as $word) {
                $data['word'] = $word;
                $data['user'] = $user;
                include 'tableRow';
            }
            ?>
        </table>
    </div>

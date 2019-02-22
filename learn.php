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

if (isset($_GET['save']) && isset($user)) {
    $saveId = $_GET['save'];
    $user->saveWord($saveId);
    Loader::url("index.php");
}
?>

<html>
    <?php Loader::loadHeader() ?>
    <body>
        <?php Loader::loadNavbar() ?>
        <div class="container mt-4">
            <form id="learn-form" class="mx-auto" action="" method="post">
                <div>
                    <select class="form-control mb-2" name="range">
                        <option value="all">Saved & Not saved</option>
                        <option value="saved">Saved only</option>
                        <option value="not-saved">Not saved only</option>
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
            </form>
        </div>
        <?php Loader::loadFooter() ?>
    </body>
    <?php Loader::loadScripts(); ?>
</html>


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
    <script>
        var words = new Array();
        var current = 0;
    </script>
    <body>
        <?php Loader::loadNavbar() ?>
        <div id="cont" class="container mt-4">
            <div class="w-50 mx-auto">
                <div>
                    <select id="saved" class="form-control mb-2">
                        <option value="all">Saved & Not saved</option>
                        <option value="true">Saved</option>
                        <option value="false">Not saved</option>
                    </select>
                </div>
                <div>
                    <select id="count" class="form-control mb-2" >
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
                <div class="text-center">
                    <button onclick="learn('start')" class="btn btn-primary" type="submit" name="learn">Learn</button>
                </div>
            </div>
        </div>
        <?php Loader::loadFooter() ?>
    </body>
    <?php Loader::loadScripts(); ?>
    <script>
        $(function () {
            $("#explanation").html(words[current].explanation);
        })

        $("#confirm").click(function () {
            var answear = $("#answear").val();
            if (answear == words[current].name) {
                alert("CORRECT!");
            } else {
                alert("INCORRECT! Answear was " + words[current].name);
            }
        })
    </script>
</html>


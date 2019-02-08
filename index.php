<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once 'includes/loader.php';
?>

<html>
    <?php Loader::loadHeader() ?>
    <body>
        <?php Loader::loadNavbar() ?>
        <div class="container">
            <div class="row mt-2">
                <div class="col-md-9">
                    <div class="p-2 bg-dark text-light font-weight-bold text-center border-left border-right">
                        Words
                    </div>
                    <table class="table bg-dark text-light table-bordered">
                        <?php
                        if (isset($_GET['search'])) {
                            $search = $mysql->escape($_GET['search']);
                            $query = "SELECT * FROM words WHERE word LIKE '$search' OR translation LIKE '$search'";
                        } else {
                            $query = "SELECT * FROM words";
                        }
                        $result = $mysql->query($query);
                        while ($row = $mysql->getRow($result)) {
                            ?>
                            <tr>
                                <td>
                                    <div class="font-weight-bold">
                                        <?= $row['word']; ?> - <?= $row['translation']; ?>
                                    </div>
                                    <div class="font-weight-light">
                                        <?= nl2br($row['explanation']); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="col-md-3">
                    <div class="bg-dark p-3">
                        <h4 class="text-center text-light">Word finder</h4>
                        <form class="input-group" action="" method="get">
                            <input class="form-control" type="text" name="search" placeholder="Search">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php Loader::loadFooter() ?>
    </body>
    <?php Loader::loadScripts(); ?>
</html>

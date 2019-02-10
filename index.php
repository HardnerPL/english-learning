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
        <div class="container mt-4">
            <div class="p-2 bg-dark text-light font-weight-bold text-center border-left border-right">
                Words
            </div>
            <table class="table bg-dark text-light table-bordered">
                <?php for ($i = 0; $i < 50; $i++) { ?>
                    <tr>
                        <td class="col-9">
                            <div class="font-weight-bold">
                                english - polish
                            </div>
                            <div class="font-weight-light">
                                explanation in a few words <br>
                                "example for example no example"
                            </div>
                            <br>
                            <small class="text-muted">
                                <a href="">related,</a>
                                <a href="">related,</a>
                                <a href="">related,</a>
                                <a href="">related</a>
                            </small>
                        </td>
                        <td class="col-3">
                            <b>Type:</b> Noun<br>
                            <b>Use:</b> Everyday<br>
                            <b>Difficulty:</b> Begginer<br>
                            <b>Your level:</b> <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><br>
                            <div class="text-center mt-2">
                                <a class="btn btn-primary" href="">Save</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <!--                    <div class="bg-dark p-3 mb-2">
                                <h4 class="text-center text-light">Profile</h4>
                                <div class="text-light">
                                    <b>Username:</b> HardnerPL<br>
                                    <b>Level:</b> 7<br>
                                    <b>XP:</b> 1080 / 1920<br>
                                    <div class="text-center mt-2">
                                        <a class="btn btn-primary mr-1" href="">Profile</a>
                                        <a class="btn btn-primary" href="">Learn</a>
                                    </div>
                                </div>
                            </div>-->
    </div>
    <?php Loader::loadFooter() ?>
</body>
<?php Loader::loadScripts(); ?>
</html>

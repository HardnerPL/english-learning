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
            <div class="row">
                <div class="col-9">
                    <div class="p-2 bg-dark text-light font-weight-bold text-center border-left border-right">
                        Words
                    </div>
                    <table class="table bg-dark text-light table-bordered">
                        <?php for ($i = 0; $i < 10; $i++) { ?>
                            <tr>
                                <td class="col-8">
                                    <div class="font-weight-bold">
                                        english - polish
                                    </div>
                                    <div class="font-weight-light">
                                        explanation in a few words <br>
                                        "example for example no example"
                                    </div>
                                    <hr class="dark-hr">
                                    <small>
                                        <a href="">related,</a>
                                        <a href="">related,</a>
                                        <a href="">related,</a>
                                        <a href="">related</a>
                                    </small>
                                </td>
                                <td class="col-4">
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
                <div class="col">
                    <div class="bg-dark p-3 mb-4">
                        <h4 class="text-center text-light">Word finder</h4>
                        <form class="mr-2" action="" method="get">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="Search" required>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" value="true" name="saved">
                                <label class="form-check-label text-light" for="saved">Saved</label>
                            </div>
                        </form>
                    </div>
                    <div class="bg-dark p-3 mb-4">
                        <h4 class="text-center text-light">Log in</h4>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="login" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="login" placeholder="Password">
                            </div>
                            <div class="text-center">
                                <button name="login" type="submit" class="btn btn-primary">Log in</button>
                            </div>
                            <div class="text-center text-light mt-1">
                                Don't have an account? <a href='register.php'>Register here!</a>
                            </div>
                        </form>
                    </div>
                    <div class="bg-dark p-3 mb-4">
                        <h4 class="text-center text-light">Statistics</h4>
                        <div class="text-light">
                            <b>Points:</b> 720<br>
                            <b>Lessons:</b> 12<br>
                            <b>Saved:</b> 80<br>
                            <i class="text-color-gold fas fa-star"></i> 11
                            <i class="text-color-silver fas fa-star"></i> 22
                            <i class="text-color-brown fas fa-star"></i> 33
                            <div class="text-center mt-2">
                                <a class="btn btn-primary mr-1" href="profile.php">Profile</a>
                                <a class="btn btn-primary" href="learn.php">Learn</a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-dark p-3 mb-4">
                        <h4 class="text-center text-light">Leaderboard</h4>
                        <div class="text-light">
                            <b>1. HardnerPL: 720</b><br>
                            2. Rzeju: 420<br>
                            3. klaud_ysia: 60<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php Loader::loadFooter() ?>
</body>
<?php Loader::loadScripts(); ?>
</html>

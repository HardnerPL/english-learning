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
            <div id="login-form" class="mx-auto">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Repeat password</label>
                        <input class="form-control" type="password" placeholder="Repeat password" name="password" required>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" name="login">Log in</button>
                    </div>
                </form>
                <div class="text-center mt-2">
                Already have an account? <a href='login.php'>Log in here!</a>
                </div>
            </div>
        </div>
    </div>
    <?php Loader::loadFooter() ?>
</body>
<?php Loader::loadScripts(); ?>
</html>

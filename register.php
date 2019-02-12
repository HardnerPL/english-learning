<!DOCTYPE html>

<?php
require_once 'includes/loader.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    if (strlen($password) < 8) {
        $registerResult = "PASSWORD_TOO_SHORT";
    } else if (strlen($username) > 32) {
        $registerResult = "USERNAME_TOO_LONG";
    } else if (User::isUsernameFree($username)) {
        $registerResult = "USERNAME_IN_USE";
    }
    // TO DO: INCLUDES_ILLEGAL_CHARACTERS
    else if ($password != $repeatPassword) {
        $registerResult = "DIFFERENT_PASSWORDS";
    } else {
        $user = new User(0, $username, $password, 'user');
        User::add($user);
        $registerResult = "SUCCESS";
    }
}
?>

<html>
<?php Loader::loadHeader() ?>
    <body>
    <?php Loader::loadNavbar() ?>
        <div class="container mt-4">
            <!-- TO DO: Display information based on register result -->
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
                        <input class="form-control" type="password" placeholder="Repeat password" name="repeatPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" name="register">Register</button>
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

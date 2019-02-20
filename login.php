<!DOCTYPE html>

<?php
require_once 'includes/loader.php';

$loginResult = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = User::fromUsername($username);
    if (empty($user)) {
        $loginResult = "NO_USER";
    } else if (!$user->verifyPassword($password)) {
        $loginResult = "WRONG_PASSWORD";
    } else {
        $_SESSION['user'] = $user;
        $loginResult = "SUCCESS";
        header("Location: index.php");
    }
} else if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header("Location: index.php");
}
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
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" name="login">Log in</button>
                    </div>
                </form>
                <div class="text-center mt-2">
                Don't have an account? <a href='register.php'>Register here!</a>
                </div>
            </div>
        </div>
    </div>
    <?php Loader::loadFooter() ?>
</body>
<?php Loader::loadScripts(); ?>
</html>

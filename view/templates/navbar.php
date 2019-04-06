<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar navbar-nav">
            <a class="navbar-brand" href="index.php"><i class="fab fa-github fa-lg mr-3"></i>English Learning</a>
        </div>
        <div class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user'])) { ?>
            <a class="nav-item nav-link" href="learn.php">Learn</a>
            <a class="nav-item nav-link" href="contribute.php">Contribute</a>
            <a class="nav-item nav-link" href="profile.php">Profile</a>
            <a onclick="logout()" class="nav-item nav-link" href="">Log out</a>
            <?php } else { ?>
            <a class="nav-item nav-link" href="login.php">Log in</a>
            <?php } ?>
        </div>
    </div>
</div>
</nav>
<div class="container mt-4">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><i class="fab fa-github fa-lg"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user'])) { ?>
                <a class="nav-item nav-link" href="#"></a>
                <a class="nav-item nav-link" href="#"></a>
            <?php } ?>
            <a class="nav-item nav-link" href="#">Log in</a>
        </div>
    </div>
</nav>


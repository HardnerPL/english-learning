<html>
    <?php require 'header.php' ?>
    <body>
        <?php require 'navbar.php' ?>
        <div class="container mt-4">
            <div class="row">
                <?php
                foreach ($content as $template) {
                    $template->load();
                }
                ?>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
</body>
<?php
foreach ($scripts as $script) {
    $script->load();
}
?>
</html>
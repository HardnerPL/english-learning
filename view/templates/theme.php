<html>
    <?php require 'header.php' ?>
    <body>
        <?php require 'navbar.php' ?>
        <div class="container mt-4">
            <div class="row">
                <?php
                foreach ($templates as $template) {
                    $template->load();
                }
                ?>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
</body>
<?php
(new Script('coreScripts'))->load();
foreach ($scripts as $script) {
    $script->load();
}
?>
</html>
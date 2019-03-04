<html>
    <?php require 'header.php' ?>
    <body>
        <?php require 'navbar.php' ?>
        <div class="container mt-4">
            <?php
            foreach($content as $template) {
                $template->load();
            }
            ?>
        </div>
    </div>
    <?php require 'footer.php' ?>
</body>
<?php require 'includes/Display/templates/scripts.php' ?>
</html>
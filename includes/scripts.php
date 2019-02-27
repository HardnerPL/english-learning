<script src="dependencies/jquery.js"></script>
<script src="styles/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    function logout() {
        $.get("login.php?logout").done(function () {
            location.reload();
        });
    }
    function save(id, btn) {
        var row = btn.parent().parent().parent();
        row.load("includes/save.php?save=" + id);
    }
</script>


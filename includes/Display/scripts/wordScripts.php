<script>
    function save(id, btn) {
        var cont = btn.parent();
        $.ajax({
            url: "includes/Ajax/learnSave.php",
            type: "post",
            data: {
                "save": id,
            }
        }).done(function (data) {
            cont.html(data);
        });
    }
</script>
<script>
    function save(id, btn) {
        var cont = btn.parent().parent().parent();
        $.ajax({
                url: "includes/Ajax/save.php",
                type: "post",
                data: {
                    "save": id,
                }
            }).done(function(data) {
                cont.html(data);
            });
    }
</script>
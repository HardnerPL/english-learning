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
    function search() {
        var word = $("#searchWord").val();
        var saved = $("#searchSaved").val();
        var type = $("#searchType").val();
        var table = $("#table");
        $.ajax({
                url: "includes/Ajax/search.php",
                type: "post",
                data: {
                    "search": word,
                    "saved": saved,
                    "type": type
                }
            }).done(function(data) {
                table.replaceWith(data);
            });
    }
</script>
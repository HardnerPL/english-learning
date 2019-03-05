<script src="dependencies/jquery.js"></script>
<script src="styles/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    function logout() {
        $.ajax({
                url: "includes/Ajax/logout.php"
            }).done(function() {
                location.reload();
            });
    }
    function save(id, btn) {
        var row = btn.parent().parent().parent();
        row.load("includes/Ajax/save.php?save=" + id);
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
    
    function learn(mode) {
        if (mode === "start") {
            var cont = $("#cont");
            var count = $("#count").val();
            var saved = $("#saved").val();
            $.ajax({
                url: "includes/learnControler.php",
                type: "get",
                data: {
                    "function": mode,
                    "count": count,
                    "saved": saved
                }
            }).done(function(data) {
                cont.html(data);
            });
        } else if (mode === "answear") {
            var cont = $("#cont");
            var answear = $("#answear").val();
            $.ajax({
                url: "includes/learnControler.php",
                type: "get",
                data: {
                    "function": mode,
                    "answear": answear
                }
            }).done(function(data) {
                cont.html(data);
            });
        } else if (mode === "load") {
            var cont = $("#cont");
            $.ajax({
                url: "includes/learnControler.php",
                type: "get",
                data: {
                    "function": mode
                }
            }).done(function(data) {
                cont.html(data);
            });
        }
    }
</script>


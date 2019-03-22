<script>
    function save(id, btn) {
        var cont = btn.parent();
        $.ajax({
                url: "includes/Ajax/learnSave.php",
                type: "post",
                data: {
                    "save": id,
                }
            }).done(function(data) {
                cont.html(data);
            });
    }
    
    function learn(mode) {
        if (mode === "start") {
            var cont = $("#cont");
            var count = $("#count").val();
            var saved = $("#saved").val();
            
            cont.empty();
            $.ajax({
                url: "includes/Ajax/learnControler.php",
                type: "post",
                data: {
                    "function": mode,
                    "count": count,
                    "saved": saved
                }
            }).done(function(data) {
                cont.html(data);
            });
        } else if (mode === "answer") {
            var cont = $("#cont");
            var answer = $("#answer").val();
            
            cont.empty();
            $.ajax({
                url: "includes/Ajax/learnControler.php",
                type: "post",
                data: {
                    "function": mode,
                    "answer": answer
                }
            }).done(function(data) {
                cont.html(data);
            });
        } else if (mode === "load") {
            var cont = $("#cont");
            
            cont.empty();
            $.ajax({
                url: "includes/Ajax/learnControler.php",
                type: "post",
                data: {
                    "function": mode
                }
            }).done(function(data) {
                cont.html(data);
            });
        }
    }
</script>
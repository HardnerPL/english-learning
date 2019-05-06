<script src="dependencies/jquery.js"></script>
<script src="styles/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    function logout() {
        $.ajax({
            url: "includes/Ajax/logout.php",
            type: "post",
            data: {
                "logout": true,
            }
            }).success(function() {
                location.reload();
            });
    }
    function save(id, btn, mode) {
        switch(mode) {
            case 'table':
                var cont = btn.parents("tr");
                break;
            case 'word':
                var cont = btn.parent();
                break;
        }
        $.ajax({
                url: "includes/Ajax/save.php",
                type: "post",
                data: {
                    "save": id,
                    "mode": mode
                }
            }).done(function(data) {
                cont.html(data);
            });
    }
</script>


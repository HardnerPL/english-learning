<script>
    $(function () {
        $("#explanation").html(words[current].explanation);
    })

    $("#confirm").click(function () {
        var answear = $("#answear").val();
        if (answear == words[current].name) {
            alert("CORRECT!");
        } else {
            alert("INCORRECT! Answear was " + words[current].name);
        }
    })
</script>
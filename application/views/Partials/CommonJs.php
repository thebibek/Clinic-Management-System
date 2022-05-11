<script>
    function alpha(inputtxt) {
        var letters = /^[A-Za-z]+$/;
        if (inputtxt.match(letters)) {
            return true;
        } else {
            return false;
        }
    }

    function numeric(inputtxt) {
        var numbers = /^[0-9]+$/;
        if (inputtxt.match(numbers)) {
            return true;
        } else {
            return false;
        }
    }
</script>
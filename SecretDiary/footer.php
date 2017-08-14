
<script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

<script type="text/javascript">

    $("#showLoginForm").click(function() {
        $("#loginForm").toggleClass("hide");
        $("#signupForm").toggleClass("hide");
        $("#showLoginForm").toggleClass("hide");
        $("#showSignupForm").toggleClass("hide");
    });

    $("#showSignupForm").click(function() {
        $("#loginForm").toggleClass("hide");
        $("#signupForm").toggleClass("hide");
        $("#showLoginForm").toggleClass("hide");
        $("#showSignupForm").toggleClass("hide");
    });

    $("#inputArea").on('input propertychange', function() {

        $.ajax({
            type: "POST",
            url: "update.php",
            data: {contents: $("#inputArea").val()}

        });


//        $.ajax({
//            method: "POST",
//            url: "update.php",
//            data: { content: $("#diary").val() }
//            success: function(done) {
//                alert(done);
//            }
//        });

    });

</script>

</body>
</html>
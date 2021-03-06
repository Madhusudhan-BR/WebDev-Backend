<?php

session_start();

$error = "";

if (array_key_exists("logout", $_GET)) {

    unset($_SESSION);
    setcookie("id", "", time() - 60*60);
    $_COOKIE["id"] = "";

} else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

    header("Location: page1.php");

}

if (array_key_exists("submit", $_POST)) {

    $link = mysqli_connect("shareddb1d.hosting.stackcp.net","secretdiary-3231ca46","cK+Wpq2gfNvJ","secretdiary-3231ca46");

    if (mysqli_connect_error()) {

        die ("Database Connection Error");

    }



    if (!$_POST['email']) {

        $error .= "An email address is required<br>";

    }

    if (!$_POST['password']) {

        $error .= "A password is required<br>";

    }

    if ($error != "") {

        $error = "<p>There were error(s) in your form:</p>".$error;

    } else {

        if ($_POST['signUp'] == '1') {

            $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) {

                $error = "That email address is taken.";

            } else {

                $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                if (!mysqli_query($link, $query)) {

                    $error = "<p>Could not sign you up - please try again later.</p>";

                } else {
                    $_SESSION['id'] = mysqli_insert_id($link);

                    //echo mysqli_insert_id($link);

                    $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                    mysqli_query($link, $query);



                    if ($_POST['stayLoggedIn'] == '1') {

                        setcookie("id", $_SESSION['id'], time() + 60*60*24*365);

                    }
                    //echo mysqli_insert_id($link);


                    header("Location: page1.php");

                }

            }

        } else {

            $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

            $result = mysqli_query($link, $query);

            $row = mysqli_fetch_array($result);

            if (isset($row)) {

                $hashedPassword = md5(md5($row['id']).$_POST['password']);

                if ($hashedPassword == $row['password']) {



                    $_SESSION['id'] = $row['id'];

                    if ($_POST['stayLoggedIn'] == '1') {

                        setcookie("id", $row['id'], time() + 60*60*24*365);

                    }

                    header("Location: page1.php");


                } else {

                    $error = "That email/password combination could not be found.";

                }

            } else {

                $error = "That email/password combination could not be found.";

            }

        }

    }


}


?>

<?php include ("header.php"); ?>


<body>
    <div class="container">
        <h1>Welcome to the secret diary.</h1>
        <div id="error"><?php echo $error; ?></div>

        <form method="post" id="signupForm">
            <div class="form-group">
                <p><input type="email" class="form-control" name="email" placeholder="Your Email"></p>
            </div>
            <div class="form-group">
                <p><input type="password" class="form-control" name="password" placeholder="Password"></p>
            </div>
            <div class="checkbox">
                <label>
                 <input type="checkbox" class="form-check-input" name="stayLoggedIn" value=1>
                    Stay logged in
                </label>
            </div>
            <div class="form-group">
                    <input type="hidden" name="signUp" value="1">
            </div>
            <div class="form-group">
                    <p><input type="submit" name="submit" class="btn btn-primary" value="Sign Up!"></p>
            </div>
            <p id="showLoginForm">Show Login </p>
        </form>

        <form method="post" id="loginForm" class="hide">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="checkbox">
                <label>
                <input type="checkbox" name="stayLoggedIn" class="form-check-input" value=1>
                    Stay logged in
                </label>
            </div>
            <div class="form-group">
                <input type="hidden" name="signUp" value="0">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Log In!">
            </div>
            <p id="showSignupForm" class="hide">Show SignUP </p>
        </form>

    </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->

<?php include "footer.php"; ?>




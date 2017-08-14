<?php

session_start();

if (array_key_exists("id", $_COOKIE)) {

    $_SESSION['id'] = $_COOKIE['id'];

}

if (array_key_exists("id", $_SESSION)) {

   // echo "<p>Logged In! <a href='index.php?logout=1'>Log out</a></p>";

    $link = mysqli_connect("shareddb1d.hosting.stackcp.net","secretdiary-3231ca46","cK+Wpq2gfNvJ","secretdiary-3231ca46");

    if (mysqli_connect_error()) {

        die ("Database Connection Error");

    }

    $query = "SELECT diary FROM users where id='".$_SESSION["id"]."'";
    $row = mysqli_fetch_array(mysqli_query($link,$query));
    $diarycontent = $row['diary'];

} else {

    header("Location: index.php");

}

include ("header.php");
?>

    <a class="navbar-brand" href="#">Secret Diary</a>

    <div class="pull-xs-right">
        <a href ='index.php?logout=1'>
            <button class="btn btn-success-outline" type="submit">Logout</button></a>
    </div>



    <div id="container-fluid">
        <textarea id="inputArea" ><?php echo $diarycontent; ?></textarea>
    </div>


<?php

include "footer.php";

?>
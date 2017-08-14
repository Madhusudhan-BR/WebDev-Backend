<?php

    session_start();

if(array_key_exists("contents",$_POST))

    $link = mysqli_connect("shareddb1d.hosting.stackcp.net","secretdiary-3231ca46","cK+Wpq2gfNvJ","secretdiary-3231ca46");

if (mysqli_connect_error()) {

    die ("Database Connection Error");

}
    echo  $_SESSION["id"];
    $query = "UPDATE users SET diary ='". $_POST["contents"] . "' WHERE id='". $_SESSION["id"] . "' ";
    echo $query;

    if(mysqli_query($link,$query)){
        echo "success";
    }
    else {
        echo "failure";
    }


?>
<?php
session_start(); 

if (isset($_POST["search"]))
{
    $_SESSION["join_from"]=$_POST["from_location"];
    $_SESSION["join_to"]=$_POST["towhere"];
    $_SESSION["join_time"]=$_POST["time"];
    $_SESSION["join_type"]=$_POST["cartype"];
    header("location: trip_listing.php");
}
else
{
    echo "An error occured";
}
?>
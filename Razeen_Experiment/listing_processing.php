<?php
session_start();
include "../backend/db_connection.php";
print_r($_POST);
if (isset($_POST['but_val']))
{   
    echo "he";
    if ($_POST['criteria']=="")
    {
        header("location: trip_listing.php");
    }
    else
    {
        $_SESSION["sort_flag"]=TRUE;
        $_SESSION["order_criteria_flag"]=$_POST['criteria'];
        $_SESSION["order_flag"]=$_POST['order'];
        header("location: trip_listing.php");
    }

}

?>
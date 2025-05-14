<?php
session_start();
include "../backend/db_connection.php";


    $updateQuery="UPDATE Trips SET trip_status='Pending'  WHERE Trip_ID=\"".$_SESSION["Trip_Create_Flag"]."\"";
    $result2=mysqli_query($conn, $updateQuery);
    header("location : host_preview.php");


?>



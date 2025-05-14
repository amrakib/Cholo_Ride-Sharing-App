<?php
session_start();
include "../backend/db_connection.php";

if (isset($_POST["Trip_ID"]))
{
    $TripInfoQuery="SELECT* FROM Trips where Trip_ID=\"".$_POST["Trip_ID"]."\"";
    $fetched_data=mysqli_query($conn, $TripInfoQuery);
    $count=mysqli_num_rows( $fetched_data );
    $data = $fetched_data->fetch_all(MYSQLI_ASSOC);
    $Trip_data=$data[0];


    $TripJoinerQuery="SELECT * FROM Trip_Joiners where Trip_ID=\"".$_POST["Trip_ID"]."\"";
    $fetched_data1=mysqli_query($conn, $TripJoinerQuery);
    $count1=mysqli_num_rows( $fetched_data1 );
    $data2 = $fetched_data1->fetch_all(MYSQLI_ASSOC);


    $delete_query="DELETE FROM Trip_Joiners WHERE Student_ID='".$_SESSION["User_ID"]."' and Trip_Leader_ID='".$_POST["Leader_ID"]."' and Trip_ID='".$_POST["Trip_ID"]."'";
    $result=mysqli_query($conn, $delete_query);

    $updateQuery="UPDATE User SET UserStatus='Available'  WHERE Student_ID=\"".$_SESSION["User_ID"]."\"";
    $result2=mysqli_query($conn, $updateQuery);

    $updateQuery2="UPDATE Trips SET Used_capacity= Used_capacity-1  WHERE Trip_ID=\"".$_POST["Trip_ID"]."\"";
    $result3=mysqli_query($conn, $updateQuery2);
    header('location: leave_success.php');
    unset($_SESSION["Joined_Trip_ID"]);
}
?>


<?php
session_start();
include "../backend/db_connection.php"
?>


<?php
$UserInfo="SELECT * FROM User where Student_ID=\"".$_SESSION["User_ID"]."\"";
$Ufetched_data=mysqli_query($conn, $UserInfo);
$UserData = $Ufetched_data->fetch_all(MYSQLI_ASSOC);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
      crossorigin="anonymous"
    />
     <style>
    body {
  background-image: linear-gradient(220deg, #fbe4d6 0%, #8fd3f4);
  background-attachment: fixed;
}
  </style>
</head>
<body>
     <!-- navbar -->
     <div class=" ps-3 pe-3">
     <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand fw-bolder fs-3" href="../backend/landing_page.php" style="color:white; margin-left: 4rem;">CHOLO</a>
          <button
            class="navbar-toggler bg-light"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon rounded"></span>
          </button>
          <div class="collapse navbar-collapse me-3" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto  ">
              <li class="nav-item pe-4 fs-5 fw-bold ">
                <a class="nav-link " aria-current="page" href="../backend/landing_page.php">Home</a>
              </li>
              <li class="nav-item pe-4 fs-5 fw-bold">
                <a class="nav-link " href="../backend/logout.php">Log Out</a>
              </li>
              <li class="nav-item pe-4 fs-5 fw-bold">
                <a class="nav-link " href="../backend/profile.php">Profile</a>
              </li>
            </ul>
          </div>
        </nav>
        </div>
<?php
$TripInfoQuery="SELECT* FROM Trips AS T INNER JOIN User AS U ON T.Student_ID=U.Student_ID where T.Trip_ID=\"".$_SESSION["Trip_Create_Flag"]."\"";
$fetched_data=mysqli_query($conn, $TripInfoQuery);
$count=mysqli_num_rows( $fetched_data );
$data = $fetched_data->fetch_all(MYSQLI_ASSOC);

?>

    <div class="container mt-5 ">
        <div class="row">
            <div class="col bg-light rounded-3 shadow-sm p-4 m-2">
                <h2 class="text-center">Trip Information</h2>
                    <p class="card-text fw-bold">Trip Leader: <?php echo $data[0]["Name"] ?></p>
                    <p class="card-text fw-bold">Leader Phone: <?php echo $data[0]["Phone_Number"]; ?></p>
                    <p class="card-text fw-bold">Route: <?php echo $data[0]["where_loc"];  ?> -> <?php echo $data[0]["to_loc"];  ?></p>
                    <p class="card-text fw-bold">Date: <?php echo $data[0]["Date"]; ?></p>
                    <p class="card-text fw-bold">Time: <?php echo $data[0]["Time"]; ?></p>
                    <p class="card-text fw-bold">Fare: <?php echo $data[0]["Fare"]; ?> BDT</p>
                    <p class="card-text fw-bold">Meetup Location: <?php echo $data[0]["Meet_up_location"]; ?></p>
                    <p class="card-text fw-bold">Capacity Status: <?php echo $data[0]["Used_capacity"]; ?>/<?php echo $data[0]["Capacity"]; ?></p>
                    <p class="card-text fw-bold">Vehicle Type: <?php echo $data[0]["Mode_of_Commute"]; ?></p>
            </div>
    <div class="col bg-light rounded-3 shadow-sm p-4 m-2">
<?php
$TripJoinerQuery="SELECT * FROM Trip_Joiners AS T INNER JOIN User AS U ON T.Student_ID=U.Student_ID where Trip_ID=\"".$_SESSION["Trip_Create_Flag"]."\"";
$fetched_data1=mysqli_query($conn, $TripJoinerQuery);
$count1=mysqli_num_rows( $fetched_data1 );
$data2 = $fetched_data1->fetch_all(MYSQLI_ASSOC);
$thisTripFlag=False;
?>

      <h2 class="text-center" >Trip Joiners</h2>
<?php 
if ($count1==0)
{
 echo "<p>No One has joined Your Trip</p>";
}
else
{     
      for ($i=0;$i<$count1;$i++)
      {
        echo "<p class=\"card-text fw-bold\">".$data2[$i]["Name"]." (".$data2[$i]["Student_ID"].")</p>";
        if ($data2[$i]["Student_ID"]==$_SESSION["User_ID"])
        {
          $thisTripFlag=True;
        }
      }
}

?>
    </div>
    
  </div>
</div>

<?php if ($leaveableFlag==True) { ?>
        <form action="leave_processing.php" method="POST">
<?php
        echo "<input type=\"hidden\" name=\"Trip_ID\" value=\"".$_SESSION["Trip_Create_Flag"]."\">";
        echo "<input type=\"hidden\" name=\"Leader_ID\" value=\"".$data[0]["Student_ID"]."\">";
?>
        <div class="d-flex d-flex justify-content-center  flex-row mt-3 ">
        <button type="Submit" id="myButton" class="btn btn-outline-danger ">Leave Trip</button>
        </a>
        </div>
        </form>

<?php } ?>

      

</a>
</div>
</form>
        
            
    
        
    
</body>
</html>



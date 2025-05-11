<?php
session_start();
include "../backend/db_connection.php";
if (!isset($_SESSION["User_ID"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip info</title>
    <link rel="stylesheet" href="css\trip_info.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

<h1><i class="fas fa-route"></i> Select From Available Trips</h1>

<div class="filters">
    <form method="post" action="listing_processing.php">
        Sort by: 
        <select name="criteria">
            <option value="">Sort Criteria</option>
            <option value="Fare">Fare</option>
            <option value="Capacity">Available Capacity</option>
        </select>
        <select name="order">
            <option value="undeclared">Order</option>
            <option value="high">High to Low</option>
            <option value="low">Low to High</option>
        </select>
        <button type="submit" name="but_val" value="submitted"><i class="fas fa-filter"></i> Filter</button>
    </form>
</div>

<?php
            
        $fetch_query="SELECT * FROM Trips WHERE trip_status='Available'";
        $where_criteria=" AND where_loc='".$_SESSION["join_from"]."'";
        $to_criteria=" AND to_loc='".$_SESSION["join_to"]."'";
        if ($_SESSION["join_type"]!="Any")
        {
            $type_criteria=" AND Mode_of_Commute='".$_SESSION["join_type"]."'";
            $fetch_query=$fetch_query.$type_criteria;
        }


        $date_time=explode("T",$_SESSION["join_time"]);

        $date=$date_time[0];

        $time=$date_time[1];

        $date_criteria=" AND Date='".$date."'";
        $time_criteria=" AND Time >= \"".$time."\" AND Time <= ADDTIME(\"".$time."\", '00:30:00')";
        $order_addon="";
        if ($_SESSION["sort_flag"])
        {   
            $order_addon=" ORDER BY";
            $_SESSION["sort_flag"]=FALSE;
            if ($_SESSION["order_criteria_flag"]=="Fare")
            {
                $order_addon=$order_addon." Fare";

            }
            else if ($_SESSION["order_criteria_flag"]=="Capacity")
            {
                $order_addon=$order_addon." Used_capacity";
            }

            if ($_SESSION["order_flag"]=="high")
            {
                $order_addon=$order_addon." DESC";
            }
            else if ($_SESSION["order_flag"]=="low")
            {
                $order_addon=$order_addon." ASC";
            }
            else
            {
                $order_addon=$order_addon." ASC";
            }
            
        }

        $fetch_query=$fetch_query.$where_criteria.$to_criteria.$date_criteria.$time_criteria.$order_addon;
        $fetched_data=mysqli_query($conn, $fetch_query);
        $count=mysqli_num_rows( $fetched_data );
        $data = $fetched_data->fetch_all(MYSQLI_NUM);
            
        if ( $count== 0)
        {
            echo "No trips available";
        }

        for ($i=0;$i<$count;$i++) 
        {   
            $trip_id = $data[$i][0];
            $student_id = $data[$i][1];
            $thana = $data[$i][2];
            $capacity = $data[$i][3];
            $time = $data[$i][4];
            $date = $data[$i][5];
            $fare = $data[$i][6];
            $meetup = $data[$i][7];
            $recurring = $data[$i][8];
            $trip_mode = $data[$i][8];
            $trip_status = $data[$i][10];
            $trip_fill= $data[$i][11];

            echo "<div class='history_button'>";
            echo "<div class='history-container'>";
            echo "<div class='history-card'>";
            echo "<strong>Trip ID: ".$trip_id."</strong><br>";
            echo "<strong>Trip Route: ".$_SESSION["join_from"]."-->".$_SESSION["join_to"]."</strong><br>";
            echo "<strong>Trip Date: ".$date."</strong><br>";
            echo "<strong>Trip Time: ".$time."</strong><br>";
            echo "<strong>Fare: ".$fare."</strong> BDT<br>";
            echo "<strong>Available Space: ".$trip_fill."/".$capacity."</strong><br>";
            echo "<strong>Mode of Transport: ".$trip_mode."</strong><br>";
            echo "</div>";
            echo "</div>";
            echo "<div class='button_div'><form action='trip_info.php' method='post'><button class = \"choice_button\" type='submit' name='trip_choice' value=\"".$trip_id."\">Details</button> </form></div>";
            echo "</div>";
        }

        $_SESSION["sort_flag"]=FALSE;
?>
 <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
      crossorigin="anonymous"
    ></script>
    
</body>
</html


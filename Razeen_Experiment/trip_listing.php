<?php
session_start();
include '../frontend/connection.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>10x3 Grid Layout</title>
    <style>
        body {
            height: 100vh;
            margin: 0;
        }

        .container {
            display: grid;
            grid-template-rows: repeat(5, 120px);
            /* Changed the column widths here */
            grid-template-columns: 45% 45% 10%;
            height: auto;
            padding: 0;
            max-width: 100%;
        }

        .cell {
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: space-around;
            font-size: 16px;
            color: #333;
            word-wrap: break-word;
        }

        .cell.divided {
            display: flex; /* Keep display flex, but change direction */
            flex-direction: column; /* Make it a column layout */
            justify-content: space-around; /* Space the divs vertically */
            align-items: stretch; /* Make items stretch to the cell width */
            width: 100%;
        }

        .cell.divided > div {
            padding: 0;
            width: 100%; /* Inner divs take full width of the cell */
            height: 50%;
            box-sizing: border-box;
            text-align: center; /* You can adjust text alignment as needed */
        }
        .cell.divided > div:first-child{
             border-bottom: 1px solid #ccc;
        }

        .row-1 {
            font-weight: bold;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cell row-1">Trip Owner</div>
        <div class="cell row-1">Trip locations</div>
        <div class="cell row-1">buttons</div>

        <?php
            
            $where_criteria=" AND where_loc='".$_SESSION["join_from"]."'";
            $to_criteria=" AND to_loc='".$_SESSION["join_to"]."'";
            $type_criteria=" AND Mode_of_Commute='".$_SESSION["join_type"]."'";

            $date_time=explode("T",$_SESSION["join_time"]);

            $date=$date_time[0];

            $time=$date_time[1];

            $date_criteria=" AND Date='".$date."'";
            $time_criteria=" AND Time >= \"".$time."\" AND Time <= ADDTIME(\"".$time."\", '00:30:00')";

            $fetch_query="SELECT * FROM Trips WHERE trip_status='Available'".$where_criteria.$to_criteria.$date_criteria.$time_criteria;
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
                $trip_mode = $data[$i][9];
                $trip_status = $data[$i][10];
                $trip_fill= $data[$i][11];

                echo "<div class=\"cell divided\"><div>Trip ID: ".$trip_id."</div><div>Fare: ".$fare."</div></div>";
                echo "<div class=\"cell\">Available Space: ".$trip_fill."/".$capacity."</div>";
                echo "<div class=\"cell\"> <button class = \"button-in-cell\">Click</button> </div>";
            }
        ?>
    </div>
</body>
</html>



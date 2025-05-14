<?php
session_start();
include "../backend/db_connection.php";

    $UserInfo="SELECT * FROM User where Student_ID=\"".$_SESSION["User_ID"]."\"";
    $Ufetched_data=mysqli_query($conn, $UserInfo);
    $UserData = $Ufetched_data->fetch_all(MYSQLI_ASSOC);

    $updateQuery="UPDATE Trips SET trip_status='Pending'  WHERE Trip_ID=\"".$UserData[0]["Created"]."\"";
    $result2=mysqli_query($conn, $updateQuery);

    $TripJoinerQuery="SELECT * FROM Trip_Joiners AS T INNER JOIN User AS U ON T.Student_ID=U.Student_ID where Trip_ID=\"".$UserData[0]["Created"]."\"";
    $fetched_data1=mysqli_query($conn, $TripJoinerQuery);
    $count1=mysqli_num_rows( $fetched_data1 );
    $data2 = $fetched_data1->fetch_all(MYSQLI_ASSOC);
    echo $count1;

    $TripLeaderQuery="SELECT * FROM Trips where Trip_ID=\"".$UserData[0]["Created"]."\"";
    $fetched_data2=mysqli_query($conn, $TripLeaderQuery);
    $count5=mysqli_num_rows( $fetched_data2 );
    $data5 = $fetched_data2->fetch_all(MYSQLI_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trip Joined</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="background-image: linear-gradient(220deg, #fbe4d6 0%, #8fd3f4); background-attachment: fixed;">
    

<div class="container py-5">
    <!-- Success Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            <?php echo "Success"; ?>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <h3 class="text-success">✅Trip Has Started</h3>
      <a href="../Razeen_Experiment\host_preview.php" >
        <button type="button"class="btn btn btn-outline-success mt-4">Check Status</button></a>
    </div>



</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const toastLiveExample = document.getElementById('successToast');
  if (toastLiveExample) {
    const toast = new bootstrap.Toast(toastLiveExample);
    toast.show();
  }
</script>

</body>
</html>




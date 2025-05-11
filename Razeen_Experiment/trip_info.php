<?php
session_start();
include "../backend/db_connection.php"
?>

<?php
// echo $_POST["trip_choice"];
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


    <div class="container mt-5 ">
        <div class="row">
            <div class="col bg-light rounded-3 shadow-sm p-4 m-2">
                <h2 class="text-center">Trip Information</h2>
                    <p class="card-text fw-bold">Trip ID: <?php echo $_POST["trip_choice"]; ?></p>
                   

            </div>
    <div class="col bg-light rounded-3 shadow-sm p-4 m-2">
        
      <h2 class="text-center" >Trip Joiners</h2>
      <p class="card-text fw-bold">Trip ID: <?php echo $_POST["trip_choice"]; ?></p>
     
    </div>
    
  </div>
</div>
<form action="#" method="POST">
<div class="d-flex d-flex justify-content-center  flex-row mt-3 ">
<button type="Submit" class="btn btn-outline-danger ">Join Trip</button>
</a>
</div>
</form>
        
            
    
        
    
</body>
</html>



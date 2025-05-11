<!DOCTYPE html>

<?php
include '../frontend/connection.php';
$location_value_fetch = "SELECT * FROM Locations";

$all_locs = $conn->query($location_value_fetch);

?>

<html>


  <head>
    <title>Cholo-Posting Trip</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="css/join_trip.css" />
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
    <div class="container-fluid  mt-5 form-container p-4 ">
      <div class="text-center mb-3">
       
      <h1 class=" mt-3 fw-bold">Join a Trip</h1>
      <p class="mb-4 ">
        Search Your preferrable Trips
      </p>
      </div>
      <form method="post" action="search_processing.php">
        <!-- From Where -->
        
        <div class=" field ">
          <select class="form-select text-center selection-field" aria-label="Default select example" name="from_location">
            <option selected>Where From</option>
            <?php
            if ($all_locs->num_rows > 0) {
                while ($row2 = $all_locs->fetch_assoc()) {
                    $temp= "<option value=\"".$row2["area_locations"]."\"".">".$row2["area_locations"]."</option>";
                    echo $temp;
                }       
            } else {
            echo "<option value=\""."NoData"."\"".">"."No data"."</option>";
            }
            ?>
          </select>
        </div>

        <!-- To Where -->
        <div class=" field mt-3 ">
          <select class="form-select text-center selection-field" aria-label="Default select example" name="towhere">
            <option selected>Where To</option>
            <?php
            $all_locs = $conn->query($location_value_fetch);
            if ($all_locs->num_rows > 0) {
                while ($row2 = $all_locs->fetch_assoc()) {
                    $temp= "<option value=\"".$row2["area_locations"]."\"".">".$row2["area_locations"]."</option>";
                    echo $temp;
                }       
            
            } else {
                echo "<option value=\""."NoData"."\"".">"."No data"."</option>";
            }
            ?>
          </select>
        </div>

        <!-- Time -->
        <div class=" field text-center mt-3 ">
          <label for="starting time">Trip Starting Time</label>
          <input
            type="datetime-local"
            class="form-control mt-1 text-center selection-field"
            id="floatingInput"
            placeholder="Time"
            name="time"
            placeholder="Starting Time"  
          />
        </div>
 
         <!-- Vehicle Type Selection -->
        <div class="mt-3 mb-3 field">
          <select class="form-select selection-field text-center" name="cartype">    <!-- This variable is not being passed (NEED FIXING) -->
            <option value="Any">Select Vehicle Type</option>
            <option value="Private">Private</option>
            <option value="Public">Public</option>
          </select>
        </div>



    <!-- Submit button -->
         <div class="d-flex flex-row justify-content-center mt-3">
         <button type="submit" name="search" value="Search" class="btn btn-outline-info ">Search</button> <!-- This button sends variables to search_processing.php -->
        </div>
        
      </form>
    </div>
  </body>
</html>

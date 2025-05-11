<?php
include 'connection.php';
session_start();
 // Start the session to store temporary success message
 if (!isset($_SESSION["User_ID"])) {
    header("Location: ../backend/index.php");
    exit();
  }
?>
<!DOCTYPE html>
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

    <link rel="stylesheet" href="css/post_trip.css" />
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
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-4">
    <img src="svg_for_posting_trip.svg" alt="posting trip svg" height="200px"/>
    </div>
    <div class="col-8 ">
      <h1 class=" mt-3 fw-bold">Posting a Ride</h1>
      <p class="mb-4 ">
        Please fill this for successfully posting a Ride.
      </p>
      </div>
      </div>
      <form method="post" action="post_trip_backend.php">
        <!-- From Where -->
        
        <div class=" field ">
          <select class="form-select text-center selection-field" aria-label="Default select example" name="from_location">
            <option selected>Where From</option>
            <option value="Gulshan">Gulshan</option>
            <option value="Dhanmondi">Dhanmondi</option>
            <option value="Lalmatia">Lalmatia</option>
          </select>
        </div>

        <!-- To Where -->
        <div class=" field mt-3 ">
          <select class="form-select text-center selection-field" aria-label="Default select example" name="towhere">
            <option selected>Where To</option>
            <option value="Gulshan">Gulshan</option>
            <option value="Dhanmondi">Dhanmondi</option>
            <option value="Lalmatia">Lalmatia</option>
          </select>
        </div>

        <!-- Time -->
        <div class=" field text-center mt-3 ">
          <label for="starting time">Starting Time</label>
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
      <select class="form-select selection-field text-center" id="vehicleType" name="mode_commute" onchange="toggleInputs()">
        <option value="">Select Vehicle Type</option>
        <option value="Private">Private</option>
        <option value="Public">Public</option>
      </select>
    </div>

    <!-- Private Vehicle Inputs -->
    <div id="privateInputs" class="hidden field text-center">

       <!-- This is where vehicle select or Add button will be inserted -->
      <div id="vehicleOptionsContainer" class=" mt-3 text-center "></div>
      
      <!-- Capacity field -->
   
    </div>

    <!-- Public Vehicle Inputs -->
    <div id="publicInputs" class="hidden text-center">
       
    <div class=" field mt-3 text-center">
      <label for="public vehicle form-label">Select Vehicle</label>
          <select class="form-select text-center selection-field mb-3" aria-label="Default select example" name="vehicle">
            
            <option value="1">Bus</option>
            <option value="2">CNG</option>
            <option value="3">UBER</option>
          </select>
        </div>
      <div class=" field mb-3">
      
        <input type="number" class="form-control selection-field text-center" id="routeName" placeholder="Maxium Capacity" name="capacity">
      </div>
    </div>

    <!-- fare -->
    <div class=" field mb-3 text-center">
        
        <input type="text" class="form-control selection-field text-center"  placeholder="Fare Amount in BDT" name="fare">
      </div>
    
      <!-- Meet up location -->
      <div class=" field mb-3 text-center">
        
        <input type="text" class="form-control selection-field text-center"  placeholder="Meet-Up Location(In-Short)" name="Meet_up_location">
      </div>

      <!-- repeatition  -->
      <!-- <div class=" field mb-3 text-center">
        
        <select class="form-select text-center selection-field mb-3" aria-label="Default select example" name="Recurring_Trip">
          <option selected >Recurring of this Trip</option>
            <option value="1">NO</option>
            <option value="2">YES</option>    
          </select>
      </div> -->

    <!-- Submit button -->
         <div class="d-flex flex-row justify-content-center mt-3">
         <button type="submit" class="btn btn-outline-success">Post Trip

         </button>
        </div>
        
      </form>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!-- JavaScript to handle form toggle -->
<script>
  function toggleInputs() {
    var type = document.getElementById('vehicleType').value;
    var privateInputs = document.getElementById('privateInputs');
    var publicInputs = document.getElementById('publicInputs');

    if (type === 'Private') {
      
      privateInputs.classList.remove('hidden');
      publicInputs.classList.add('hidden');
      fetch('fetch_vehicle.php') 
      .then(response => response.text())
      .then(html => {
          // Insert vehicle options into a container inside privateInputs
          document.getElementById('vehicleOptionsContainer').innerHTML = html;
        })
        .catch(err => {
          console.error('Failed to load vehicle data:', err);
        });


    } else if (type === 'Public') {
      publicInputs.classList.remove('hidden');
      privateInputs.classList.add('hidden');
    } else {
      // Hide all if no selection
      privateInputs.classList.add('hidden');
      publicInputs.classList.add('hidden');
    }
  }
</script>
<script>
function setCapacity() {
  var select = document.getElementById("vehicleSelect");
  var selectedOption = select.options[select.selectedIndex];
  var capacity = selectedOption.getAttribute("data-capacity");

  if (capacity) {
    document.getElementById("capacity").value = capacity;
  } else {
    document.getElementById("capacity").value = "";
  }
}
</script>
  </body>
</html>

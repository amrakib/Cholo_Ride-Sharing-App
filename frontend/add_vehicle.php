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
    
    <div class="container-fluid  mt-5 form-container p-4 ">
      
        
    <div class="text-center">
      <h1 class=" mt-3 fw-bold">Adding a Personal Vehicle</h1>
      <p class="mb-4 ">
        Please fill this for successfully adding a personal vehicle.
      </p>
      </div>
      
      <form method="post" action="vehicle_add_backend.php">

        <!-- Vehicle Type Selection -->
        <div class=" field mb-3 ">
          <select class="form-select text-center selection-field" aria-label="Default select example" name="vehicle_type">
            <option selected>Vehicle Type</option>
            <option value="Car">Car</option>
            <option value="Bike">Bike</option>
            
          </select>
        </div>
   
    <!-- Model Name -->
    <div class=" field mb-3 text-center">
        
        <input type="text" class="form-control selection-field text-center"  placeholder="Model Name" name="model_name">
      </div>

    <!-- number Plate -->
      <div class=" field mb-3 text-center">
        
        <input type="text" class="form-control selection-field text-center"  placeholder="Vehicle Number" name="vehicle_number">
      </div>

    <!-- license number -->
      <div class=" field mb-3 text-center">
        
        <input type="text" class="form-control selection-field text-center"  placeholder="Driving License Number" name="license_number">
      </div>

    <!-- Capacity -->
    <div class=" field mb-3 text-center">
        
        <input type="number" class="form-control selection-field text-center"  placeholder="Capacity(Excluding You)" name="capacity">
      </div>

      <!-- student_id -->
      <!-- <div class=" field mb-3 text-center">
        
        <input type="text" class="form-control selection-field text-center"  placeholder="Your Studnet ID" name="owner_id">
      </div> -->
      
    <!-- Submit button -->
         <div class="d-flex flex-row justify-content-center mt-3">
         <button type="submit" class="btn btn-outline-success">Add Vehicle

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

  </body>
</html>

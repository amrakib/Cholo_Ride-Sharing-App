<!DOCTYPE html>
<html lang="en">
  <head>
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

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/template_style.css" />
  </head>
  <body>
    <h1 class="text-center">Trip join Menu</h1>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
      crossorigin="anonymous"
    ></script>

    <!-- Nav Bar
     
    
    -->
    
        <?php 
        $string_val="<option selected>meow</option>";
        ?>
        <!-- Name input fields -->
        <div class="mb-3">
            <label for="options">From:</label>
            <select class="form-select" aria-label="Default select example">
            <option selected>Department</option>
            <option value="cse">CSE</option>
            <option value="bba">BBA</option>
            <option value="architecture">Architecture</option>
            <option value="eee">EEE</option>
            <option value="law">Law</option>
            <option value="pharmacy">Pharmacy</option>
            <option value="economics">Economics</option>
            <?php echo $string_val; ?>
          </select>
        </div>

        <div class="mb-3">
            <label for="options">Where to:</label>
            <select class="form-select" aria-label="Default select example">
            <option selected>Department</option>
            <option value="cse">CSE</option>
            <option value="bba">BBA</option>
            <option value="architecture">Architecture</option>
            <option value="eee">EEE</option>
            <option value="law">Law</option>
            <option value="pharmacy">Pharmacy</option>
            <option value="economics">Economics</option>
            <?php echo $string_val; ?>
          </select>
        </div>

        <div class="mb-3">
            <label for="options">Mode of transport:</label>
            <select class="form-select" aria-label="Default select example">
            <option selected>Department</option>
            <option value="cse">CSE</option>
            <option value="bba">BBA</option>
            <option value="architecture">Architecture</option>
            <option value="eee">EEE</option>
            <option value="law">Law</option>
            <option value="pharmacy">Pharmacy</option>
            <option value="economics">Economics</option>
            <?php echo $string_val; ?>
          </select>
        </div>

    </form>
  </body>
</html>

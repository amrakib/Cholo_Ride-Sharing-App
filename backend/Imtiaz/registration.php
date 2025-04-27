<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(120deg, #fbe4d6 0%, #8fd3f4);
        background-attachment: fixed;
      }
      .form-container {
        background-color: rgb(230, 238, 245);
      }
      .custom-width {
        width: 90%;
        margin: auto;
      }
    </style>
  </head>
  <body>
    <div class="container mt-5 form-container p-4 rounded shadow custom-width">
      <h1 class="text-center mt-3 fw-bold">Registration Form</h1>
      <p class="mb-4 text-center">
        Please fill in this form to register for our service.
      </p>

      <form action="register.php" method="POST" enctype="multipart/form-data"> 
        
        <!-- Name input fields -->
        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="floatingInput"
            placeholder="Your Full Name"
          />
          <label for="floatingInput">Name</label>
        </div>

        <!-- Email input -->
        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control"
            id="floatingInput"
            placeholder="name@example.com"
          />
          <label for="floatingInput">Email Address</label>
        </div>

        <!-- Student ID -->
        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="floatingInput"
            placeholder="123456"
          />
          <label for="floatingInput">Student ID</label>
        </div>
        <!-- Department -->
        <div class="mb-3">
          <select class="form-select" aria-label="Default select example">
            <option selected>Department</option>
            <option value="cse">CSE</option>
            <option value="bba">BBA</option>
            <option value="architecture">Architecture</option>
            <option value="eee">EEE</option>
            <option value="law">Law</option>
            <option value="pharmacy">Pharmacy</option>
            <option value="economics">Economics</option>
          </select>
        </div>
        <!-- semester -->
        <div class="form-floating mb-3">
          <input
            type="number"
            class="form-control"
            id="floatingInput"
            placeholder="1st Semester"
          />
          <label for="floatingInput">Semester</label>
        </div>
        <!-- Gender -->
        <fieldset class="mb-3">
          <legend>Gender</legend>
          <div>
            <input
              type="radio"
              id="male"
              name="gender"
              class="form-check-input"
            />
            <label for="membershipStandard" class="form-label">Male</label>
          </div>
          <div>
            <input
              type="radio"
              id="female"
              name="gender"
              class="form-check-input"
            />
            <label for="membershipPremium" class="form-label">Female</label>
          </div>
        </fieldset>
        <!-- Address -->

        <div class="form-floating mb-3">
          <input
            type="address"
            class="form-control"
            id="floatingInput"
            placeholder="123 Main St, City, Country"
          />
          <label for="floatingInput">Address</label>
        </div>
        <!-- Phone number -->
        <div class="form-floating mb-3">
          <input
            type="tel"
            class="form-control"
            id="floatingInput"
            placeholder="+8801234567890"
          />
          <label for="floatingInput">Phone Number</label>
        </div>

        <!-- Password input -->
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control"
            id="floatingPassword"
            placeholder="Password"
          />
          <label for="floatingPassword">Password</label>
        </div>

        <!-- File input -->
        <div class="mb-3">
          <label class="form-label" for="profilePicture">Profile Picture</label>
          <input class="form-control" type="file" id="profilePicture" />
        </div>

        <!-- Submit button -->
        <button class="btn btn-primary mb-3" type="submit">Register</button>
      </form>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

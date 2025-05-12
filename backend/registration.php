<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #c3ecf8, #f8d3d3);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      max-width: 700px;
      margin: 4rem auto;
    }

    .form-title {
      font-weight: 700;
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }

    .form-floating label {
      color: #666;
    }

    .form-control, .form-select {
      border-radius: 10px;
    }

    .form-check-input {
      margin-top: 0.3rem;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="form-container">
      <h2 class="form-title">User Registration</h2>
      <form action="register.php" method="POST" enctype="multipart/form-data">

        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" required>
              <label for="name">Full Name</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
              <label for="email">Email Address</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Student ID" required>
              <label for="student_id">Student ID</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
              <label for="phone">Phone Number</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="address" id="address" placeholder="Your Address" required>
              <label for="address">Address</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="semester" id="semester" placeholder="Semester" required>
              <label for="semester">Semester</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" name="department" id="department" required>
                <option value="" disabled selected>Select Department</option>
                <option value="CSE">CSE</option>
                <option value="BBA">BBA</option>
                <option value="EEE">EEE</option>
                <option value="Law">Law</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Architecture">Architecture</option>
                <option value="Economics">Economics</option>
              </select>
              <label for="department">Department</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="thana" id="thana" placeholder="Your Thana" required>
              <label for="thana">Thana</label>
            </div>
          </div>

          <div></div>
          
          <div class="col-md-6">
            <label class="form-label d-block">Gender</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
              <label class="form-check-label" for="female">Female</label>
            </div>
          </div>

          <div></div>
          
          <div class="col-md-6">
            <label for="profile_pic" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" name="profile_pic" id="profile_pic" accept="image/*" required>
          </div>

          <div class="col-md-6">
            <label for="scanned_id" class="form-label">Scanned ID</label>
            <input type="file" class="form-control" name="scanned_id" id="scanned_id" accept="image/*,application/pdf" required>
          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2">Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute query safely
    $stmt = $conn->prepare("SELECT * FROM User WHERE Gsuite_Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // For demo purposes only: plaintext check. You should use password_verify() for hashed passwords.
        if ($password === $user['Password']) {
            $_SESSION["User_ID"] = $user["Student_ID"];
            $_SESSION["Student_Name"] = $user["Name"];
            $_SESSION["User_Role"] = $user["Role"];

            // Redirect based on role
            if ($user["Role"] === "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: landing_page.php");
            }
            exit();
        }
    }

    // Invalid login
    $error = "Invalid email or password.";
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Cholo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="col-md-6 offset-md-3">
    <div class="card p-4 shadow-sm">
      <h3 class="mb-4 text-center">Login</h3>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <form method="post" action="">
        <div class="mb-3">
          <label for="email" class="form-label">Gsuite Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
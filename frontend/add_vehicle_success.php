<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vehicle Insertion</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="background-image: linear-gradient(220deg, #fbe4d6 0%, #8fd3f4); background-attachment: fixed;">
    

<div class="container py-5">

<?php if (isset($_SESSION['success'])): ?>
    <!-- Success Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            <?php echo $_SESSION['success']; ?>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <h3 class="text-success">✅ <?php echo $_SESSION['success']; ?></h3>
      <a href="../backend/landing_page.php" >
        <button type="button"class="btn btn btn-outline-success mt-4">Go Back Home</button></a>
    </div>

<?php elseif (isset($_SESSION['error'])): ?>
    <!-- Failure Alert -->
    <div class="alert alert-danger" role="alert">
      <?php echo $_SESSION['error']; ?>
    </div>
    <div class="text-center mt-3">
      <a href="add_vehicle.php" class="btn btn-secondary">Try Again</a>
    </div>
<?php endif; ?>

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

<?php
// Step 4: Clear session messages after showing once
unset($_SESSION['success']);
unset($_SESSION['error']);
?>
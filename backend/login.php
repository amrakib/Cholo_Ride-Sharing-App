<?php
session_start();
include 'db_connection.php';

// ===== Hardcoded Users for Testing =====
$hardcoded_users = [
    'tawfiq@gmail.com' => ['password' => '123tawfiq', 'name' => 'Tawfiq', 'student_id' => '23101125', 'thana' => 'Mirpur', 'UserStatus' => 'Available' ],
    'Imtiaz@gmail.com' => ['password' => '123tawfiq', 'name' => 'Imtiaz', 'student_id' => '23101137', 'thana' => 'Mirpur', 'UserStatus' => 'Available'],
    'Ezio@gmail.com' => ['password' => '123tawfiq', 'name' => 'Ezio', 'student_id' => '23102352', 'thana' => 'Mirpur', 'UserStatus' => 'Available'],
    'Geralt@gmail.com' => ['password' => '123tawfiq', 'name' => 'Geralt', 'student_id' => '23102621', 'thana' => 'Mirpur', 'UserStatus' => 'Available'],
    'Desmond@gmail.com' => ['password' => '123tawfiq', 'name' => 'Desmond', 'student_id' => '23101621', 'thana' => 'Mirpur', 'UserStatus' => 'Available'],
    'Razor@gmail.com' => ['password' => '123tawfiq', 'name' => 'Razor', 'student_id' => '23109200', 'thana' => 'Mirpur', 'UserStatus' => 'Available'],
    'razeen@gmail.com' => ['password' => '123razeen', 'name' => 'Razeen', 'student_id' => '23101126', 'thana' => 'Banani', 'UserStatus' => 'Available']
];


if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ===== Hardcoded Login for Testing =====
    if (array_key_exists($email, $hardcoded_users)){
        $user = $hardcoded_users[$email];
        if ($password === $user['password']) {
            $_SESSION["User_ID"] = $user['student_id'];
            $_SESSION["Student_Name"] = $user['name'];
            $_SESSION["User_Default_Location"] = $user['thana'];
            header("Location: landing_page.php");
            exit();
        }
    }

    // ===== Admin Login (Plaintext password) =====
    $admin_sql = "SELECT * FROM Admin WHERE Gsuite_Email = ?";
    $stmt = mysqli_prepare($conn, $admin_sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $admin_result = mysqli_stmt_get_result($stmt);

    if ($admin_result && mysqli_num_rows($admin_result) === 1){
        $row = mysqli_fetch_assoc($admin_result);
        if ($password === $row['Password']) { 
            $_SESSION['admin'] = $row['Gsuite_Email'];
            $_SESSION['admin_key'] = $row['Admin_Key'];
            header("Location: admin_index.php");
            exit();
        }
    }

    // ===== User Login (Hashed password) =====
    $user_sql = "SELECT * FROM User WHERE Gsuite_Email = ?";
    $stmt = mysqli_prepare($conn, $user_sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $user_result = mysqli_stmt_get_result($stmt);

    if ($user_result && mysqli_num_rows($user_result) === 1) {
        $row = mysqli_fetch_assoc($user_result);
        if (password_verify($password, $row['Password'])){
            $_SESSION["User_ID"] = $row["Student_ID"];
            $_SESSION["Student_Name"] = $row["Name"];
            $_SESSION["User_Default_Location"] = $row["Thana"];

            header("Location: landing_page.php");
            exit();
        }
    }

    echo '<script>
        alert("Invalid email or password.");
        window.location.href = "index.php";
    </script>';
}
?>
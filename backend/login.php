<?php
session_start();
include 'db_connection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $admin_sql = "SELECT * FROM Admin WHERE Gsuite_Email = '$email' AND Password = '$password'";
    $admin_result = mysqli_query($conn, $admin_sql);

    if (mysqli_num_rows($admin_result) === 1) {
        $row = mysqli_fetch_assoc($admin_result);
        $_SESSION['admin'] = $row['Gsuite_Email'];
        $_SESSION['admin_key'] = $row['Admin_Key'];
        header("Location: admin_index.php");
        exit();
    }

    $user_sql = "SELECT * FROM User WHERE Gsuite_Email = '$email' AND Password = '$password'";
    $user_result = mysqli_query($conn, $user_sql);

    if (mysqli_num_rows($user_result) === 1){
        $row = mysqli_fetch_assoc($user_result);

        $_SESSION["User_ID"] = $row["Student_ID"];
        $_SESSION["Student_Name"] = $row["Name"];
        $_SESSION["User_Default_Location"] = $row["Thana"];

        header("Location: landing_page.php");
        exit();
    } 
    
    else{
        echo '<script>
            alert("Invalid email or password.");
            window.location.href = "index.php";
        </script>';
    }
}
?>
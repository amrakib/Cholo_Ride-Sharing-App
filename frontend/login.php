<?php
include 'connection.php';
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE Gsuite_Email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count=mysqli_num_rows($result);
    if($count==1)
    {
        header("Location:landing_page.php"); 
        
        // Redirect to another page or perform other actions
    }
    else
    {
        echo '<script>
        window.location.href="index.php";
        alert("Invalid email or password.");
        </script>';
    }
    if(mysqli_num_rows($result) > 0){
        echo "Login successful!";
        // Redirect to another page or perform other actions
    } else {
        echo "Invalid email or password.";
    }
}

?>
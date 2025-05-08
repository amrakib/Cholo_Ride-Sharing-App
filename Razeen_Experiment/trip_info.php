<?php
session_start();

if (isset($_POST['trip_choice']))
{
    echo $_POST['trip_choice'];
}
?>
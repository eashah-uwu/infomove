<?php
session_start();
include('C:/xampp/htdocs/infomove/includes/connect.php');

if(isset($_POST['submit']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM admin WHERE email = '$email' AND password ='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            // Admin credentials found in the 'admin' table
            header("Location: admin/admin.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Invalid Admin Credentials.";
            header("Location: login.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "All fields are mandatory";
        header("Location: login.php");
        exit(0);
    }
}
?>

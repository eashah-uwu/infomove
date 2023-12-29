<?php
session_start();
include('C:/xampp/htdocs/infomove/includes/connect.php');

if (isset($_POST['submit'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if ($login_query_run) {
            $row = mysqli_fetch_assoc($login_query_run);
            if ($row) {
                $hash = $row['password']; // Retrieve hashed password from the database
                if (password_verify($password, $hash)) {
                    if ($row['verify_status'] == "1") {
                        header("Location: user/user.php");
                        exit(0);
                    } else {
                        $_SESSION['status'] = "Please verify your email address to login.";
                        header("Location: login.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Invalid Email or Password.";
                    header("Location: login.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid Email or Password.";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Error occurred. Please try again.";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All fields are mandatory";
        header("Location: login.php");
        exit(0);
    }
}
?>

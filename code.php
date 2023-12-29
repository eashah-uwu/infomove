<?php
session_start();
include('C:/xampp/htdocs/infomove/includes/connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/infomove/Composer/vendor/autoload.php';
function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "shanzaali4123@gmail.com";
    $mail->Password = "pllv tmxw jhqg oizq";

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("shanzaali4123@gmail.com",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Email Verification from InfoMove";

    $email_template = "
    <h2> You have signed up on InfoMove </h2>
    <h5> Verify your email address to login with the link given below</h5>
    <br/><br/> 
    <a href = 'http://localhost/infomove/verify-email.php?token=$verify_token' > Verify";

    $mail->Body = $email_template;
    $mail->send();

}

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $verify_token = md5(rand());

    
     //Email exists or not
     $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
     $check_email_query_run = mysqli_query($con, $check_email_query);
 
     if ($check_email_query_run) {
         // Check the number of rows in the result set
         if (mysqli_num_rows($check_email_query_run) > 0) {
             $_SESSION['status'] = "Email id already exists";
             header("Location: signup.php");
             exit(); // Terminate further execution after redirection
         } else {
             // Proceed with inserting the new user data into the database
             $query = "INSERT INTO users (username,email,password,name,verify_token) 
                       VALUES ('$username','$email','$hash','$name','$verify_token')";
             $query_run = mysqli_query($con, $query);
 
             if ($query_run) {
                 sendemail_verify("$name", "$email", "$verify_token");
                 $_SESSION['status'] = "Signup Successful. Please verify your email.";
                 header("Location: signup.php");
                 exit(); // Terminate further execution after redirection
             } else {
                 $_SESSION['status'] = "Signup Failed";
                 header("Location: signup.php");
                 exit(); // Terminate further execution after redirection
             }
         }
     } else {
         // Handle query execution error
         echo "Error: " . mysqli_error($con); // Output the MySQL error for debugging purposes
         // Optionally, you can redirect the user to an error page
         // header("Location: error.php");
         exit(); // Terminate further execution
     }
}
?>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

// if(!filter_var($_POST['to'],FILTER_VALIDATE_EMAIL)){
//    echo "";
//    exit();
// }

$email="sahithkumarrko@gmail.com";
require("./phpmailer/SMTP.php");
require("./phpmailer/Exception.php");
require("./phpmailer/PHPMailer.php");
require('./versions/2/wizard/clientZone/connection.php');
// use phpmailer\PHPMailer\PHPMailer\SMTP;
date_default_timezone_set("Asia/Calcutta");
// use phpmailer\PHPMailer\PHPMailer\PHPMailer;
// use phpmailer\PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();
// print_r($mail);
$em=md5($email);
$date=date("H:i:s");
mysqli_query($con,"delete from resendPassword where email='$email'");
mysqli_query($con,"insert into resendPassword(hash,email,dateSent) values('$em','$email','$date')");
mysqli_commit($con);
try {
    //Server settings
   //  $mail->SMTPDebug = 4;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'wasche.services@gmail.com';                     // SMTP username
    $mail->Password   = 'kpanhdgzakdemdsg';                                     // SMTP password
    $mail->SMTPSecure = 'ssl';                               
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('wasche.services@gmail.com','Wasche Services');
    $mail->addAddress("sahithkumarrko@gmail.com");     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);     
   
    $msg="<style>@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');</style>";       
    $msg=$msg."<div style=\"font-family:'Open Sans',Arial,sans-serif;\"><div style='min-height:4rem;width:100%;display:block;border-bottom:1px solid #c5c5c5;margin-bottom:10px;'><div style='width:fit-content;height:fit-content;margin:auto;display:flex;justify-content:center;align-content:center;'><a href='https://wasche-services.herokuapp.com' style='color:black;font-size:1.6rem;text-decoration:none;text-transform:uppercase;letter-spacing:2px;font-weight:bold;padding:0;margin:0;text-shadow:1px 1px 1px rgba(0,0,0,0.1);'>Wasche</a></div></div>";
   //  $msg=$msg."<h3 style='margin-bottom:5px;padding:5px;'>Thank you for subscribing to your website.</h3><h5> We are happy to see you here. You will recieve all the latest updates including amazing vouchers and discounts.</h5></div> ";                      // Set email format to HTML
    $msg=$msg."<div style='width:fit-content;margin:auto;'><p style='font-size:14px;'><b><span style='font-size:18px'>Hello,</span></b><br><br>We recieved a request to reset your password.<br><br>Click on the below link in order to reset your password<br><div style='display:block;width:fit-content;margin-top:20px;'><a href='https://wasche-services.herokuapp.com/resendP.php#'$em' style='padding:10px;text-transform:uppercase;font-size:14px;color:white;background:#019875;outline:none;border-radius:5px;border:1px solid #019875;text-decoration:none;'><span>Reset Password</sapn></a></p></div></div><br><br><p style='font-size:15px;margin:auto;width:fit-content;'>Than you, <b>Wasche Services.</b></p></div> ";
    $mail->Subject = 'Password Reset';
    $mail->Body    = $msg;
    $mail->AltBody = "Wasche\n\nHello,\n>We recieved a request to reset your password.\n\nClick or paste the link in order to reset your password\n\nhttps://wasche-services.herokuapp.com/resendP.php#'$em'\n\n\nThank you. Wasche Services.";
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "success";
     }
} catch (Exception $e) {
    echo "Error";
}
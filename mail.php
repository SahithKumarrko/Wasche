<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

require("./phpmailer/SMTP.php");
require("./phpmailer/Exception.php");
require("./phpmailer/PHPMailer.php");
// use phpmailer\PHPMailer\PHPMailer\SMTP;

// use phpmailer\PHPMailer\PHPMailer\PHPMailer;
// use phpmailer\PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();
// print_r($mail);

try {
    //Server settings
    $mail->SMTPDebug = 4;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'wasche.services@gmail.com';                     // SMTP username
    $mail->Password   = 'kpanhdgzakdemdsg';                                     // SMTP password
    $mail->SMTPSecure = 'ssl';                               
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('wasche.services@gmail.com');
    $mail->addAddress("sahithkumarrko@gmail.com");     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: ";
}
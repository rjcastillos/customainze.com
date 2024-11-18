<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';


require '../emails/src/Exception.php';
require '../emails/src/PHPMailer.php';
require '../emails/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$fileToEmail = 'IMG_2424.jpeg';
$passfilename = $_GET['fileToEmail'];
echo "Passed name = $passfilename </br>";


try {
     //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
     $mail->isSMTP();                                            //Send using SMTP
     $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
     $mail->Username   = 'user@example.com';                     //SMTP username
     $mail->Password   = 'secret';                               //SMTP password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
 
     //Recipients
     $mail->setFrom('from@example.com', 'Mailer');
     $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
     $mail->addAddress('ellen@example.com');               //Name is optional
     $mail->addReplyTo('info@example.com', 'Information');
     $mail->addCC('cc@example.com');
     $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Uploaded picture to process by Customainze';
    $mail->Body    = 'Please proces file  <b>Thanks from MDM team!</b>';
    $mail->AltBody = 'In case your email client do not support html , thanks from MDM team';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
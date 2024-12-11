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
$refinvoice = $_GET['proofp'];
$item1 = $_GET['crystal1'];
$item2 = $_GET['crystal2'];
$item3 = $_GET['crystal3'];
$item4 = $_GET['crystal4'];
echo "Passed name = $passfilename </br>";


try {
    //Server settings
 //   $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'XXXXX';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'XXXXXX';                     //SMTP username
    $mail->Password   = 'XXXXXX';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('xxx@xxx.com', 'MDM IT Support');
    $mail->addAddress('@hotmail.com', 'K');     //Add a recipient RECEIVER
    $mail->addAddress('@gmail.com', 'Process Customainze');     //Add a recipient RECEIVER
    //$mail->addAddress('ramonjoseph.c@gmail.com', 'Process Customainze');     //Add a recipient RECEIVER
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    $mail->addBCC('@protonmail.com');

    //Attachments
    //$mail->addAttachment('../../public_ftp/incoming/IMG_2424.jpeg');         //Add attachments --working line
    $mail->addAttachment("$passfilename");
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Uploaded picture to process by Customainze';
    $mail->Body    = "Please process file  <b>Thanks from MDM team!</b><br/> Ref : $refinvoice items : $item1 , $item2 , $item3 , $item4";
    $mail->AltBody = 'In case your email client do not support html , thanks from MDM team';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
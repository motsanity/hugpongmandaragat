<?php

require_once ('phpmailer/PHPMailerAutoload.php');
 require_once('phpmailer/class.smtp.php');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$file = $_FILES['file'];


 

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'mail.fosconship.com';
$mail->port= '465';
$mail->isHTML();
$mail->Username = 'noreply@fosconship.com';
$mail->Password = 'F05C0N@F05C0N';
$mail->SetFrom('inquiry@foscon.com.ph');
$mail->Subject = 'Foscon - Crew Management';
$mail->Body = "From:\n $email<br><br><br> Name:$name <br><br> phone number: $phone <br><br><br> Message:<br><br> $message";
$mail->AddAddress('foscon@foscon.com.ph');
$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);


$mail->Send();
die(header("Location: ../thankyou-fsmi.php"));
?>
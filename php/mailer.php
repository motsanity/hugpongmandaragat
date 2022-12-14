<?php

require_once ('PHPMailer/PHPMailerAutoload.php');
 require_once('PHPMailer/class.smtp.php');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];


 

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = '465';
$mail->Host = 'mail.hugpongmandaragat.com';
$mail->port= 'tls';
$mail->isHTML();
$mail->Username = 'send@hugpongmandaragat.com';
$mail->Password = '28Nov.2019';
$mail->SetFrom('send@hugpongmandaragat.com');
$mail->Subject = 'inquiry';
$mail->Body = "From:\n $email<br><br><br> Name:$firstname " " $lastname <br><br> phone number: $phone <br><br><br> Message:<br><br> $message";

$mail->AddAddress('inquiry@hugpongmandaragat.com');



$mail->Send();
die(header("Location: ../redirect.php"));
?>
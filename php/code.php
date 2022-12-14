<?php

require_once ('phpmailer/phpmailerautoload.php');
 require_once('phpmailer/class.smtp.php');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$file = $_FILES['file'];


 

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tsl';
$mail->Host = 'smtp.gmail.com';
$mail->port= '465';
$mail->isHTML();
$mail->Username = 'ayokopakita@gmail.com';
$mail->Password = 'ayokopakita';
$mail->SetFrom('nani@gmail.com');
$mail->Subject = 'hehe';
$mail->Body = "From:\n $email<br><br><br> Name:$name <br><br> phone number: $phone <br><br><br> Message:<br><br> $message";
$mail->AddAddress('ops@gmail.com');
$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);


$mail->Send();
die(header("Location: ../thankyou.php"));
?>
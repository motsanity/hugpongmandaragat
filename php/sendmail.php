<?php

   require('PHPMailer/class.phpmailer.php');

   if(isset($_POST['email'])) {

   // EDIT THE 2 LINES BELOW AS REQUIRED
   //$email_to = "hidden";
   //$email_subject = "Request for Portfolio check up from ".$first_name." ".$last_name;

  $title = array('Title', 'Mr.', 'Ms.', 'Mrs.');
  $selected_key = $_POST['title'];
  $selected_val = $title[$_POST['title']]; 

  $first_name = $_POST['first_name']; // required
  $last_name = $_POST['last_name']; // required
  $email_from = $_POST['email']; // required
  $telephone = $_POST['telephone']; // not required
  $comments = $_POST['comments']; // required

   if(($selected_key==0))
     echo "<script> alert('Please enter your title')</script>";
      function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
      }
    

     $allowedExts = array("doc", "docx", "xls", "xlsx", "pdf");
     $temp = explode(".", $_FILES["file"]["name"]);
     $extension = end($temp);
       if ((($_FILES["file"]["type"] == "application/pdf")
        || ($_FILES["file"]["type"] == "application/msword")
        || ($_FILES["file"]["type"] == "application/excel")
        || ($_FILES["file"]["type"] == "application/vnd.ms-excel")
        || ($_FILES["file"]["type"] == "application/x-excel")
        || ($_FILES["file"]["type"] == "application/x-msexcel")
        || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
        || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))

          && in_array($extension, $allowedExts))
       {
        if ($_FILES["file"]["error"] > 0)
         {
          echo "<script>alert('Error: " . $_FILES["file"]["error"]."')</script>";
         }
          else
         {
       $d='upload/';
       $de=$d . basename($_FILES['file']['name']);
          move_uploaded_file($_FILES["file"]["tmp_name"], $de);
       $fileName = $_FILES['file']['name'];
       $filePath = $_FILES['file']['tmp_name'];
          //add only if the file is an upload
        }
       }
       else
       {
        echo "<script>alert('Invalid file')</script>";
       }
             
    $mail = new PHPMailer();
    
    $mail->IsSMTP();
    
    $mail->SMTPDebug  = 0;
    $mail->Debugoutput = 'html';
    $mail->Host       = 'smtp.gmail.com';
    $mail->Port       = 465;
    $mail->SMTPAuth   = true;
    $mail->Username   = 'timothybasalo1@gmail.com';
    $mail->Password   = 'Sparkling23';
    $mail->SetFrom('no-reply@foscon.com');
    
    $mail->AddAddress('timothybasalo1@gmail.com');
     $mail->Subject = 'Foscon';
	 $mail->body($email_message);
     $mail->AltBody = 'This is a plain-text message body';
     
    $mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
	
         if(!$mail->Send()) {
          echo "<script>alert('Mailer Error: " . $mail->ErrorInfo."')</script>";
        } else {
          echo "<script>alert('Your request has been submitted. We will contact you soon.')</script>";
          Header('Location: main.php');
        }
    }
 ?>
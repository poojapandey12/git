<?php
error_reporting(E_ALL | E_STRICT);  
ini_set('display_startup_errors',1);  
ini_set('display_errors',1);
require("PHPMailer_5.2.0/class.phpmailer.php");

function send_email($name,$age, $email, $phone){
			$mail = new PHPMailer();

			$mail->IsSMTP();                                      // set mailer to use SMTP
			$mail->Host = "mail.24livehost.com";  // specify main and backup server
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username = 'wwwsmtp@24livehost.com';  // SMTP username
			$mail->Password =  'dsmtp909#'; // SMTP password




			$mail->From = "wwwsmtp@24livehost.com";
			$mail->FromName = "Mailer";
			$mail->AddAddress("pooja.pandey@dotsquares.com", "Josh Adams");
			//$mail->AddAddress("shashank.kumrawat@dotsquares.com");                  // name is optional
			$mail->AddReplyTo("pooja.pandey@dotsquares.com", "Information");


			$mail->IsHTML(true);                                  

			$mail->Subject = "successfullly registered";
			$mail->Body    = "<p style='font:bold;'> Hi".$name."</p> <br>You are now registered with us with email ".$email."please check following details
			     <html>
				<head>
				<title>HTML email</title>
				</head>
				<body>
				
				<table>
				<tr>
				<th>Firstname</th>
                <td>$name</td>
				
				
				
				</tr>
				<tr>
				<th>Age</th>
				
				<td>$age</td>
				
				
				</tr>
				<tr>
				<th>Email</th>
                <td>$email</td>

				</tr>
				<tr>
				<th>Phone no</th>
				<td>$phone</td>
				</tr>
				</table>
				</body>
				</html>
				";
			$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

			if(!$mail->Send())
			{

			   echo "Message could not be sent. 
			";
			   echo "Mailer Error: " . $mail->ErrorInfo;
			   exit;
			}

			echo "Message has been sent";
		}

?>


<?php

class Email {

	public function sendmail($email, $code)
	{
		$emailBody = "Click here to finish account creation: " . BASE_URL . "incomer/confirm/" . $code;

		if ( isset(ini_get_all()['sendmail_path']['global_value']) ) {

			$to = $email;
			$subject = "Verification Email";
			$txt = $emailBody;
			$headers = "From: noreply@gmail.com" . "\r\n" .
			"CC: steppe.ego@gmail.com" .
		    'Reply-To: webmaster@example.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();

			mail($to,$subject,$txt,$headers);

		} else {

			//require 'PHPMailer/PHPMailerAutoload.php';
			
			$mail = new PHPMailer;
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->SMTPDebug  = 2;     // enables SMTP debug information (for testing) 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier	
			$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
			$mail->Username   = MAIL_SERVER;  // GMAIL username
			$mail->Password   = MAIL_PASSWORD;            // GMAIL password
			$mail->setFrom("noreply@gmail.com", 'Registerer');
			$mail->addAddress($email, 'Registerer');
			$mail->isHTML(true);
			$mail->Subject = "Verification Email";
			$mail->Body = $emailBody;
			if (!$mail->send()) {
				echo "Cannot send Confirmation link to your e-mail address";
			} else {
				echo "Your Confirmation link Has Been Sent To Your Email Address";			
			}	
			
		}
	}

}

?>
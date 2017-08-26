<?php
class Mailer{
	public function sendMail($to,$subject,$body){
		
		
		$mail = new PHPMailer();
		$mail->IsSMTP(); // we are going to use SMTP
		$mail->SMTPAuth   = true; // enabled SMTP authentication
		$mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		$mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
		$mail->Port       = 465;                   // SMTP port to connect to GMail
		$mail->Username   = "amrith.ds.gowda@gmail.com";  // user email address
		$mail->Password   = "ka21175902";            // password in GMail
		$mail->SetFrom('amrith.ds.gowda@gmail.com', 'Firstname Lastname');  //Who is sending the email
		//$mail->AddReplyTo("amrith.ds.gowda@gmail.com","Firstname Lastname");  //email address that receives the response
		$mail->Subject    = $subject;
		$mail->Body      = $body;
		$mail->isHTML(true);
		//$mail->AltBody    = "Plain text message";
		$mail->AddAddress($to);
		
		$status = true;
		if(!$mail->Send()) {
			$status = false;
		} 
		return $status;
	}
}
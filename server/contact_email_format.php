<?php
require_once('PHPMailer/PHPMailerAutoload.php');

function sendMail($email_from, $subject, $content){
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = "tls";
	$mail->Port     = 587;
	$mail->Username = "rrsalesvadodara@gmail.com";
	$mail->Password = "rrsalesvadodara123";
	$mail->Host     = "smtp.gmail.com";
	$mail->Mailer   = "smtp";

	$mail->SetFrom($email_from, $email_from);

	$mail->AddReplyTo($email_from, $email_from);
	$mail->AddAddress("rrsalesvadodara@gmail.com");

	$mail->Subject = $subject;

	$mail->WordWrap   = 500;

	$mail->MsgHTML($content);

	$mail->IsHTML(true);

	if($mail->Send()){
		return json_encode("true");
	}
	else{
		return json_encode("false"); //. $mail->ErrorInfo
	}
}

?>
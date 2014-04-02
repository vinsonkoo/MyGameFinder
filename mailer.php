<?php
	if(isset($_POST["name"]))
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		$message = "$name\n$email\n" . $_POST["message"];
		
		$to = "redwaveapps@gmail.com";
		$subject = "MyGameFinder Feedback/Suggestions";
		$headers = "From: $name" . "\r\n" .
		"Reply-To: $email" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();

		mail($to, $subject, $message, $headers);
		
		header ("Location: contact.php");
	}
	
?>
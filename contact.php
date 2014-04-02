<!DOCTYPE html>
<!-- autoload function -->
<?php include('autoload.php'); ?>
<!-- header -->
<?php include('header.php'); ?>

<div class="container contact_us">
	<div class="row">
		<div class="contact_us_content">
			<h3>Please feel free to send us feedback and suggestions. We are open to improving the site to create the best possible experience for you.</h3>
			<form method="post" action="mailer.php">
				<input class="nameinput contact_us_input" type="text" name="name" placeholder="Your Name" required>
				<input class="emailinput contact_us_input" type="text" name="email" placeholder="Your Email" required>
				<textarea class="messageinput contact_us_input" rows="10" name="message" placeholder="Your message"></textarea>
				<input class="send-message" type="submit" value="Send Message">

			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validate()
	{
		if(document.getElementById('nameinput').value == "")
		{
			alert("Please enter your name.");
			return false;
		}
		if(document.getElementById('emailinput').value == "")
		{
			alert("Please enter your e-mail address.");
			return false;
		}
		if(document.getElementById('messageinput').value == "")
		{
			alert("Please enter a message.");
			return false;
		}
		return true;
	}
</script>


<?php include('footer.php'); ?>
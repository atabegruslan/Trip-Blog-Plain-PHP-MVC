<div class="container">

	<h2>Register</h2>

	<form class="form" method="POST" action="<?php echo BASE_URL; ?>incomer/register">
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="name" class="form-control" id="name" name="name" placeholder="Enter name">
		</div>

		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
		</div>

		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
		</div>

		<div class="form-group">
			<label for="confirm_password">Confirm Password:</label>
			<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
		</div>

		<img src="<?php echo SYS_IMAGES_URL; ?>captcha.php" id="captcha" />

		<div class="form-group">
			<label for="captcha">Captcha:</label> 
			<input name="captcha" id="captcha" class="form-control" placeholder="Enter captcha" />	
		</div>

		<button type="submit" class="btn btn-default">Submit</button>
	</form>

	<?php include(VIEWS_DIR."_parts/social.php"); ?>
</div>

<div class="container">

	<h2>Login</h2>

	<form class="form" method="POST" action="<?php echo BASE_URL; ?>user/login">
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
		</div>

		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
		</div>

		<button type="submit" class="btn btn-default">Submit</button>
	</form>

	<?php include(VIEWS_DIR."_parts/social.php"); ?>
</div>
